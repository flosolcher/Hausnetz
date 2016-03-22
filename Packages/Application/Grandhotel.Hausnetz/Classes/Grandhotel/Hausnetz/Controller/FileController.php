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
      $items = $this->fileService->getFiles()['files'];
      
      $ci = count($items);
      
      $test = $this->fileRepository->getTest();
      $this->view->assign('user', $user->getUserName());
      $this->view->assign('items', $items);
      $this->view->assign('ci', $ci);
    }
    
    /**
     */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

    public function getACtion() {
       
       
    }
    
    
}
