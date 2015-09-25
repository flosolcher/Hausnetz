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

class AnnouncementController extends AbstractController {
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\AnnouncementRepository
     */
    protected $announcementRepository;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContainerRepository
     */
    protected $containerRepository;


    /**
     * @param Container $container
     */
    public function indexAction(Container $container = NULL) {
        $announcements = $this->announcementRepository->listAnnouncements(30, $container);
        $this->view->assign('announcements', $announcements);
        $containers = $this->containerRepository->listItems('title');
        $this->view->assign('containers', $containers);
        $this->view->assign('container', $container);
    }

    /**
     * @param Announcement $announcement
     */
    public function createAction(Announcement $announcement) {
        $announcement->setActive(TRUE);
        $announcement->setSortDate(new \DateTime());
        if (trim($announcement->getMessage())!= '') {
            if ($announcement->getAnnouncement() != NULL) {
                $_announcement = $announcement->getAnnouncement();
                $_announcement->setSortDate(new \DateTime());
                $this->announcementRepository->update($_announcement);
            }
            $this->announcementRepository->add($announcement);
        }
        $this->redirect('index');
    }
}