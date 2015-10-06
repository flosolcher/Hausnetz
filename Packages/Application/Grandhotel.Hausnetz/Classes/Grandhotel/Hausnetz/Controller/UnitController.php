<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Unit as Unit;


class UnitController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\UnitRepository
     */
    protected $unitRepository;
    
    
    /**
     */
    public function indexAction() {
       $items = $this->unitRepository->listItems('title', \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, NULL, array(), TRUE);

      $this->view->assign('items', $items);
      
      $fields_src = $this->unitRepository->getFields();
      
      $this->view->assign('fields', $fields_src);
    }
    
    /**
     */
    public function newAction() {
      $fields_src = $this->unitRepository->getFields();
      
      $this->view->assign('fields', $fields_src);
      $this->view->assign('action', 'create');
    }

   
    /**
     * @param Unit $item
     */
    public function deleteAction(Unit $item) {
        $title = $item->getTitle();
        $this->unitRepository->remove($item);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Unit $item
    */
    public function createAction(Unit $item) {
        $title = $item->getTitle();
        $item->setActive = TRUE;
        $this->unitRepository->add($item);
        $this->addFlashMessage("Die neue Unit $title wurde gespeichert.");
        $this->redirect('index');
    }    
    
}
