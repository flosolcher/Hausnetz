<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Resource as Resource;


class ResourceController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ResourceRepository
     */
    protected $resourceRepository;
    
    /**
     */
    public function indexAction() {
       $items = $this->resourceRepository->listItems('title', \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, NULL, array(), TRUE);

      $this->view->assign('items', $items);
      $this->view->assign('actions', array('edit', 'update'));
      
      $fields_src = $this->resourceRepository->getFields();
      
      $this->view->assign('fields', $fields_src);
    }
    
    /**
     */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

    /**
     * @param Resource $resource
     */
    public function editAction(Resource $resource) {
      $this->view->assign('resource', $resource);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Resource $resource
     */
    public function deleteAction(Resource $resource) {
        $title = $resource->getTitle();
        $this->resourceRepository->remove($resource);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Resource $resource
    */
    public function createAction(Resource $resource) {
        $title = $resource->getTitle();
        $resource->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $resource->setUser($user);
        $this->resourceRepository->add($resource);
        $this->addFlashMessage("Die neue Resource $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param Resource $resource
    */
    public function updateAction(Resource $resource) {
        $title = $resource->getTitle();
        $this->resourceRepository->update($resource);
        $this->addFlashMessage("Die Änderungen an Resource $title wurden gespeichert.");
        $this->redirect('index');
    }
}
