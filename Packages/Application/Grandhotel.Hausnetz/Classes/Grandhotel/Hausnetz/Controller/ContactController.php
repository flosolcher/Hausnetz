<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\Contact as Contact;
use Doctrine\ORM\Mapping\ClassMetadataInfo;


class ContactController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContactRepository
     */
    protected $contactRepository;
    
    /**
     */
    public function indexAction() {
      $items = $this->contactRepository->listItems('lastname', \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, NULL, array(), TRUE); //, $limit = 20, $offset = 0);
      
      $this->view->assign('items', $items);
      $this->view->assign('actions', array('edit', 'update'));
      
      $fields2show = array(
        'firstname','lastname','phone','cellphone','email','city','facebook','birthdate'
      );
      
      $fields = array();
      
      $fields_src = $this->contactRepository->getFields();
      
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
      $this->view->assign('action', 'create');
    }

    /**
     * @param Contact $item
     */
    public function editAction(Contact $item) {
      $fields = $this->contactRepository->getFields();
      
      $this->view->assign('fields', $fields);

      $this->view->assign('item', $item);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Contact $item
     */
    public function deleteAction(Contact $item) {
        $title = $item->getTitle();
        $this->contactRepository->remove($item);
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
    * @param Contact $item
    */
    public function updateAction(Contact $item) {
        $title = $item->getTitle();
        $this->contactRepository->update($item);
        $this->addFlashMessage("Die Änderungen an Kontakt $title wurden gespeichert.");
        $this->redirect('index');
    }
}
