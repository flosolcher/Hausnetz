<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use Grandhotel\Hausnetz\Domain\Model\Announcement;
use Grandhotel\Hausnetz\Domain\Model\Container;
use TYPO3\Flow\Annotations as Flow;

class EventController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\EventRepository
     */
    protected $eventRepository;


    public function indexAction(\DateTime $date = NULL) {
        if ($date === NULL) $date = new \DateTime();
        $this->view->assign('date', $date);

        $events = $this->eventRepository->listMonthEvents($date);

        $eventArray = array();
        /** @var  $event \Grandhotel\Hausnetz\Domain\Model\Event  */
        foreach ($events as $event) {
            $item = array();
            $item['title'] = $event->getTitle();

            if ($event->getWholeDay()) {
                $item['start'] = $event->getStartDate()->format('Y-m-d');
                if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                    $item['end'] =  $event->getEndDate()->format('Y-m-d');
                }
                $item['allDay'] = TRUE;
            } else {
                $item['start'] = $event->getStartDate()->format('Y-m-d') . 'T' . $event->getStartDate()->format('H:i:s');
                if ($event->getEndDate() != NULL && $event->getEndDate() != $event->getStartDate()) {
                    $item['end'] =  $event->getEndDate()->format('Y-m-d') . 'T' . $event->getEndDate()->format('H:i:s');
                }
                $item['allDay'] = FALSE;
            }
            if ($event->getContainer() && $event->getContainer()->getColor()) {
                $item['color'] = '#' . $event->getContainer()->getColor();
            }
            $eventArray[] = $item;
        }

        $this->view->assign('events', $eventArray);

    }

}