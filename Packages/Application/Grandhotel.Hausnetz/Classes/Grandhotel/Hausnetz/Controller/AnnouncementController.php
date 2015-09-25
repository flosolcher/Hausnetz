<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
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

}