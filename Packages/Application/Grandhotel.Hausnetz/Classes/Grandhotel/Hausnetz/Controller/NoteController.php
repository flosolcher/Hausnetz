<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;

class NoteController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\AnnouncementRepository
     */
    protected $noteRepository;
    
    /**
     */
    public function indexAction() {
//        $notes = $this->notesRepository->listNotes();
      $notes = $this->noteRepository->findByCreateUser('florian.konnertz');
      $this->view->assign('notes', $notes);
    }
    
    /**
     */
    public function addAction() {
    }
    
    
   /**
     * @param Note $note
     */
    public function createAction(Note $note) {
        $note->setActive = TRUE;
        if (trim($announcement->getContent())!= '') {
            $this->noteRepository->update($note);
        }
        $this->noteRepository->add($note);
        $this->redirect('index');
    }    
    
}