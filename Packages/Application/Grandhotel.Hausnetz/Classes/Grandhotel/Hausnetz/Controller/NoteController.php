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
     */
    public function indexAction() {
//        $notes = $this->notesRepository->listNotes();
      $notes = $this->notesRepository->findByCreateUser('florian.konnertz');
      $this->view->assign('notes', $notes);
    }
}