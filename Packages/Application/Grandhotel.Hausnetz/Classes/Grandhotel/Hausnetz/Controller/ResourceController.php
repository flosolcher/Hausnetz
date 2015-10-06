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
      $fields_src = $this->resourceRepository->getFields();
      
      $this->view->assign('fields', $fields_src);
      $this->view->assign('action', 'create');
    }

    /**
     * @param Resource $item
     */
    public function editAction(Resource $item) {
      $this->view->assign('item', $resource);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Resource $item
     */
    public function deleteAction(Resource $item) {
        $title = $item->getTitle();
        $this->resourceRepository->remove($item);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Resource $item
    */
    public function createAction(Resource $item) {
        $title = $item->getTitle();
        $item->setActive = TRUE;
        $this->resourceRepository->add($item);
        $this->addFlashMessage("Die neue Resource $title wurde gespeichert.");
        $this->redirect('index');
    }    
    
    
    /**
    * @param Resource $item
    */
    public function updateAction(Resource $item) {
        $title = $item->getTitle();
        $this->resourceRepository->update($item);
        $this->addFlashMessage("Die Änderungen an Resource $title wurden gespeichert.");
        $this->redirect('index');
    }
}
