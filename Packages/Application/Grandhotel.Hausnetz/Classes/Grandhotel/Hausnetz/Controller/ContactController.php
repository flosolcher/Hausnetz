<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Contact as Contact;


class ContactController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContactRepository
     */
    protected $contactRepository;
    
    /**
     */
    public function indexAction() {
      $user = $this->authService->getCurrentUser();
      $this->view->assign('user', $user);
      $this->view->assign('contacts', $this->contactRepository->listItems());
    }
    
    /**
     */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

    /**
     * @param Contact $contact
     */
    public function editAction(Contact $contact) {
      $this->view->assign('contact', $contact);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Contact $contact
     */
    public function deleteAction(Contact $contact) {
        $title = $contact->getTitle();
        $this->contactRepository->remove($contact);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Der Kontakt $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Contact $contact
    */
    public function createAction(Contact $contact) {
        $title = $contact->getTitle();
        $contact->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $contact->setUser($user);
        $this->contactRepository->add($contact);
        $this->addFlashMessage("Die neue Kontakt $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param Contact $contact
    */
    public function updateAction(Contact $contact) {
        $title = $contact->getTitle();
        $this->contactRepository->update($contact);
        $this->addFlashMessage("Die Änderungen an Kontakt $title wurden gespeichert.");
        $this->redirect('index');
    }
}
