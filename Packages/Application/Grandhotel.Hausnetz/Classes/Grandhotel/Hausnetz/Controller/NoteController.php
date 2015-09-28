<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Note;


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

    
    public function editAction(Note $note) {
      $this->view->assign('note', $note);
      $this->view->assign('action', 'update');
    }

    
    public function deleteAction(Note $note) {
        $this->noteRepository->delete($note);
        $this->redirect('index');
    }

    
   /**
     * @param Note $note
     */
    public function createAction(Note $note) {
        $note->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $note->setUser($user);
 
 //       if (trim($note->getContent())!= '') {
 //           $this->noteRepository->update($note);
 //       }
        $this->noteRepository->add($note);
        $this->redirect('index');
  
 
    }    
    
}