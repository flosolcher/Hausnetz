<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Container as Container;


class ContainerController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContainerRepository
     */
    protected $containerRepository;
    
    /**
     */
    public function indexAction() {
      $containers = $this->containerRepository->listItems('title', \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, NULL, array(), TRUE); //, $limit = 20, $offset = 0);
      $this->view->assign('items', $containers);
      
      $fields2show = array(
        'title','color','description'  
      );
      
      $fields = array();
      
      $fields_src = $this->containerRepository->getFields();
      
      foreach ($fields_src as $f) {
         if (in_array($f['property'], $fields2show)) { 
            $fields[] = $f;
         } 
      }
      
      $this->view->assign('fields', $fields);
    }
    
    /**
     */
    public function newAction() {
      $fields = $this->containerRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('action', 'create');
    }

    /**
     * @param Container $item
     */
    public function editAction(Container $item) {
      $fields = $this->containerRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('item', $item);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Container $item
     */
    public function deleteAction(Container $item) {
        // TODO "deactivate" instead of deletion, last but not least because
        // container are assigned to many other entity objects
        $title = $item->getTitle();
        $this->containerRepository->remove($item);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Der Container $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Container $item
    */
    public function createAction(Container $item) {
        $title = $item->getTitle();
        $item->setActive = TRUE;
        $this->containerRepository->add($item);
        $this->addFlashMessage("Der neue Container $title wurde gespeichert.");
        $this->redirect('index');
    }    
    
    /**
    * @param Container $item
    */
    public function updateAction(Container $item) {
        $title = $item->getTitle();
        $this->containerRepository->update($item);
        $this->addFlashMessage("Die Änderungen an Container $title wurden gespeichert.");
        $this->redirect('index');
    }
}
