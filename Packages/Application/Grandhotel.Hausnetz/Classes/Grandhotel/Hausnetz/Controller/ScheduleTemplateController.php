<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\ScheduleTemplate as ScheduleTemplate;


class ScheduleTemplateController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ScheduleTemplateRepository
     */
    protected $scheduleTemplateRepository;
    
    /**
     */
    public function indexAction() {
      $user = $this->authService->getCurrentUser();
      $items = $this->scheduleTemplateRepository->listItems();
      $fields = $this->scheduleTemplateRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('items', $items);
    }
    
    /**
     */
    public function newAction() {
      $fields = $this->scheduleTemplateRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('action', 'create');
    }

    /**
     * @param ScheduleTemplate $item
     */
    public function editAction(ScheduleTemplate $item) {
      $this->view->assign('item', $item);
      $fields = $this->scheduleTemplateRepository->getFields();
      $this->view->assign('fields', $fields);
      $this->view->assign('action', 'update');
    }

    /**
     * @param ScheduleTemplate $item
     */
    public function deleteAction(ScheduleTemplate $item) {
        $title = $item->getTitle();
        $this->scheduleTemplateRepository->remove($item);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param ScheduleTemplate $item
    */
    public function createAction(ScheduleTemplate $item) {
        $title = $item->getTitle();
        $item->setActive = TRUE;
        $this->scheduleTemplateRepository->add($item);
        $this->addFlashMessage("Das neue Template $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param ScheduleTemplate $item
    */
    public function updateAction(ScheduleTemplate $item) {
        $title = $item->getTitle();
        $this->itemRepository->update($item);
        $this->addFlashMessage("Die Änderungen am Template $title wurden gespeichert.");
        $this->redirect('index');
    }
}
