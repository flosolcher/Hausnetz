<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use Grandhotel\Hausnetz\Domain\Model\Announcement;
use Grandhotel\Hausnetz\Domain\Model\Container;
use Grandhotel\Hausnetz\Domain\Model\Event;
use TYPO3\Flow\Annotations as Flow;

class EventController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\EventRepository
     */
    protected $eventRepository;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContainerRepository
     */
    protected $containerRepository;

    public function indexAction(\DateTime $date = NULL) {
        if ($date === NULL) $date = new \DateTime();
        $this->view->assign('date', $date);

    }

    /**
     * @param string $start
     * @param string $end
     */
    public function feedAction($start = '', $end = '') {
        $format = 'Y-m-d';
        $startDate = \DateTime::createFromFormat($format, $start);
        $endDate = \DateTime::createFromFormat($format, $end);
        $events = $this->eventRepository->listTimeRangeEvents($startDate, $endDate);
        $eventArray = array();
        /** @var  $event \Grandhotel\Hausnetz\Domain\Model\Event  */
        foreach ($events as $event) {
            /* regular events */
            if (
                ($event->getStartDate() >= $startDate && $event->getStartDate() < $endDate) ||
                ($event->getEndDate() >= $endDate && $event->getEndDate() < $endDate) ||
                ($event->getStartDate() <= $startDate && $event->getEndDate() >= $endDate)
            ) {
                $item = array();
                $item['title'] = $event->getTitle();

                if ($event->getWholeDay()) {
                    $item['start'] = $event->getStartDate()->format('Y-m-d');
                    if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                        $item['end'] = $event->getEndDate()->format('Y-m-d');
                    }
                    $item['allDay'] = TRUE;
                } else {
                    $item['start'] = $event->getStartDate()->format('Y-m-d') . 'T' . $event->getStartDate()->format('H:i:s');
                    if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                        $item['end'] = $event->getEndDate()->format('Y-m-d') . 'T' . $event->getEndDate()->format('H:i:s');
                    }
                    $item['allDay'] = FALSE;
                }
                if ($event->getContainer() && $event->getContainer()->getColor()) {
                    $item['color'] = '#' . $event->getContainer()->getColor();
                }
                $eventArray[] = $item;
            }
            /* recurring */
            $intervalString = NULL;
            switch ($event->getRecurringType()) {
                case '2weekly':
                        $intervalString = 'P2W';
                    break;
                case 'weekly':
                    $intervalString = 'P1W';
                    break;
                case 'daily':
                    $intervalString = 'P1D';
                    break;
            }
            if ($intervalString) {
                $interval = new \DateInterval($intervalString);
                $period = new \DatePeriod($event->getStartDate(), $interval, $endDate);
                /** @var \DateTime $dt */
                foreach ($period as $dt) {
                    if ($dt != $event->getStartDate()) {
                        $item = array();
                        $item['title'] = $event->getTitle();

                        if ($event->getWholeDay()) {
                            $item['start'] = $dt->format('Y-m-d');
                            if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                                $diff   = $event->getStartDate()->diff($event->getEndDate());
                                $newEnd = $dt->add($diff);
                                $item['end'] = $newEnd->format('Y-m-d');
                            }
                            $item['allDay'] = TRUE;
                        } else {
                            $item['start'] = $dt->format('Y-m-d') . 'T' . $dt->format('H:i:s');
                            if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                                $diff   = $event->getStartDate()->diff($event->getEndDate());
                                $newEnd = $dt->add($diff);
                                $item['end'] = $newEnd->format('Y-m-d') . 'T' . $newEnd->format('H:i:s');
                            }
                            $item['allDay'] = FALSE;
                        }
                        if ($event->getContainer() && $event->getContainer()->getColor()) {
                            $item['color'] = '#' . $event->getContainer()->getColor();
                        }
                        $eventArray[] = $item;
                    }
                }

            }
        }
        echo json_encode($eventArray);
        exit;
    }

    public function newAction() {
        $containers = $this->containerRepository->listItems('title');
        $this->view->assign('containers', $containers);

    }


    public function initializeCreateAction() {
        $this->arguments['event']
            ->getPropertyMappingConfiguration()
            ->forProperty('startDate')
            ->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\DateTimeConverter', \TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y H:i');

        $this->arguments['event']
            ->getPropertyMappingConfiguration()
            ->forProperty('endDate')
            ->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\DateTimeConverter', \TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd-m-Y H:i');

    }

    /**
     * @param Event $event
     */
    public function createAction(Event $event) {
        $this->eventRepository->add($event);
        $this->redirect('index');
    }

}