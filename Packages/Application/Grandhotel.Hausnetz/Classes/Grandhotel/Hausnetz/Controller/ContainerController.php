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
      $this->view->assign('action', 'create');
    }

    /**
     * @param Container $container
     */
    public function editAction(Container $container) {
      $this->view->assign('container', $container);
      $this->view->assign('action', 'update');
    }

    /**
     * @param Container $container
     */
    public function deleteAction(Container $container) {
        $title = $container->getTitle();
        $this->containerRepository->remove($container);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Der Container $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param Container $container
    */
    public function createAction(Container $container) {
        $title = $container->getTitle();
        $container->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $container->setUser($user);
        $this->containerRepository->add($container);
        $this->addFlashMessage("Der neue Container $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param Container $container
    */
    public function updateAction(Note $container) {
        $title = $container->getTitle();
        $this->containerRepository->update($container);
        $this->addFlashMessage("Die Änderungen an Container $title wurden gespeichert.");
        $this->redirect('index');
    }
}
