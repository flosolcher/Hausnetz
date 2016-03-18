<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;


class FileController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\FileRepository
     */
    protected $fileRepository;
    
     /**
     * @var \Grandhotel\Hausnetz\Service\FileService
     * @Flow\Inject
     */
    protected $fileService;
    
    /**
     */
    public function indexAction() {
      $user = $this->authService->getCurrentUser();
      $test = $this->fileRepository->getTest();
      $t = $this->fileService->getTest();
      $this->view->assign('user', $user);
      $this->view->assign('items', $test);
    }
    
    /**
     */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

}
