<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\ScheduleItem as ScheduleItem;


class ScheduleController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ScheduleItemRepository
     */
    protected $scheduleItemRepository;

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ScheduleTemplateRepository
     */
    protected $scheduleTemplateRepository;

    /**
     * @param string $date
     */
    public function indexAction($date = '')  {
        if ($date == '') $date = date('d.m.Y');
        $date = strtotime('yesterday', strtotime($date));

        $days = array();

        for($i = 0; $i < 6; $i++) {
            $class = '';
            if (date('d.m.Y') == date('d.m.Y', $date)) {
                $class .= ' current';
            }
            $days[] = array(
                'date' => $date
            );
            $date += (60 * 60 * 24);

        }
        $dt = new \DateTime();
        $this->view->assign('date', $dt);
    }

    /**
     * @param string $start
     * @param string $end
     */
    public function feedAction($start = '', $end = '') {
        $format = 'Y-m-d';
        $startDate = \DateTime::createFromFormat($format, $start);
        $endDate = \DateTime::createFromFormat($format, $end);

        $currentDate = $startDate;

        $schedule = array();
        while ($currentDate <= $endDate) {

            $dayOfTheWeek = $currentDate->format('N');

            $templates = $this->scheduleTemplateRepository->listItems(
                'begin',
                \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING,
                    ($query = $this->scheduleTemplateRepository->createQuery()),
                    array($query->equals('day', $dayOfTheWeek)),
                    TRUE
                );
            foreach ($templates as $template) {
                $item = array();
                $item['title'] = $template->getTitle();
                $hours =  floor($template->getBegin() / 60);
                $minutes = $template->getBegin() % 60;
                $item['start']  = $currentDate->format('Y-m-d') . 'T' . $hours . ':' . $minutes . ':00' ;
                $hours =  floor($template->getEnd() / 60);
                $minutes = $template->getEnd() % 60;
                $item['end']    = $currentDate->format('Y-m-d') . 'T' . $hours . ':' . $minutes . ':00' ;
                $schedule[] = $item;
            }
            $currentDate->modify('+1 day');



        }

        echo json_encode($schedule);
        exit;

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
                $item['description'] = nl2br($event->getDescription());
                $item['isRecurring'] = FALSE;
                $item['uuid'] = $this->persistenceManager->getIdentifierByObject($event);

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

                $uriBuilder = $this->controllerContext->getUriBuilder();
                $uriBuilder->reset()
                    ->setSection('')
                    ->setFormat('')
                    ->setCreateAbsoluteUri(TRUE)
                    ->setAddQueryString(FALSE)
                    ->setArgumentsToBeExcludedFromQueryString(array());
                try {
                    $uri = $uriBuilder->uriFor('edit', array('event' => $event, 'recurring' => FALSE), 'Event', NULL, '');
                } catch (\Exception $e) {
                    $uri = '';
                }
                $item['url'] = $uri;

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
                        $item['description'] = nl2br($event->getDescription());
                        $item['isRecurring'] = TRUE;
                        $item['uuid'] = $this->persistenceManager->getIdentifierByObject($event);
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

                        $uriBuilder = $this->controllerContext->getUriBuilder();
                        $uriBuilder->reset()
                            ->setSection('')
                            ->setFormat('')
                            ->setCreateAbsoluteUri(TRUE)
                            ->setAddQueryString(FALSE)
                            ->setArgumentsToBeExcludedFromQueryString(array());
                        try {
                            $uri = $uriBuilder->uriFor('edit', array('event' => $event, 'recurring' => TRUE), 'Event', NULL, '');
                        } catch (\Exception $e) {
                            $uri = '';
                        }
                        $item['url'] = $uri;

                        $eventArray[] = $item;
                    }
                }

            }
        }
        echo json_encode($eventArray);
        exit;
    }
}