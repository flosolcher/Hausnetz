<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Note as Note;


class NoteController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\NoteRepository
     */
    protected $noteRepository;
    
    /**
     */
    public function indexAction() {
      $user = $this->authService->getCurrentUser();
//      $notes = $this->noteRepository->findByCreateUser($user);
      $this->view->assign('user', $user);
      $this->view->assign('notes', $user->getNotes());
    }
    
    /**
     */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

    /**
     * @param Note $note
     */
    public function editAction(Note $note) {
      $this->view->assign('note', $note);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Note $note
     */
    public function deleteAction(Note $note) {
        $title = $note->getTitle();
        $this->noteRepository->remove($note);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Notiz $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Note $note
    */
    public function createAction(Note $note) {
        $title = $note->getTitle();
        $note->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $note->setUser($user);
        $this->noteRepository->add($note);
        $this->addFlashMessage("Die neue Notiz $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param Note $note
    */
    public function updateAction(Note $note) {
        $title = $note->getTitle();
        $this->noteRepository->update($note);
        $this->addFlashMessage("Die Änderungen an Notiz $title wurden gespeichert.");
        $this->redirect('index');
    }
}
