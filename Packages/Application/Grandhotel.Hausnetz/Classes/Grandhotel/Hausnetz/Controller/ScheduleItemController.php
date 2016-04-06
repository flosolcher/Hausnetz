<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\ScheduleItem as ScheduleItem;


class ScheduleItemController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ScheduleItemRepository
     */
    protected $scheduleItemRepository;
    
    /**
     */
    public function indexAction() {
      $items = $this->scheduleItemRepository->listActive();
      $fields = $this->scheduleItemRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('items', $items);
    }
    
    /**
     */
    public function newAction() {
      $fields = $this->scheduleItemRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('action', 'create');
    }

    /**
     * @param ScheduleItem $item
     */
    public function editAction(ScheduleItem $item) {
      $this->view->assign('item', $item);
      $fields = $this->scheduleItemRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('action', 'update');
    }

    /**
     * @param ScheduleItem $item
     */
    public function deleteAction(ScheduleItem $item) {
        $title = $item->getTitle();
        $this->scheduleItemRepository->remove($item);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param ScheduleItem $item
    */
    public function createAction(ScheduleItem $item) {
        $title = $item->getTitle();
        $item->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $item->setUser($user);
        $this->scheduleItemRepository->add($item);
        $this->addFlashMessage("Die neue Notiz $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param ScheduleItem $item
    */
    public function updateAction(ScheduleItem $item) {
        $title = $item->getTitle();
        $this->itemRepository->update($item);
        $this->addFlashMessage("Die Änderungen an Notiz $title wurden gespeichert.");
        $this->redirect('index');
    }
}
