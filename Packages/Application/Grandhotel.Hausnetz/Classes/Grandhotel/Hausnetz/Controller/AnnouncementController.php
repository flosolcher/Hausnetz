<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;

class AnnouncementController extends AbstractController {
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\AnnouncementRepository
     */
    protected $announcementRepository;

    /**
     * @return void
     */
    public function indexAction(Container $container = NULL) {
        $announcements = $this->announcementRepository->listAnnouncements(30, $container);
        $this->view->assign('announcements', $announcements);
    }

}