<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use Grandhotel\Hausnetz\Domain\Model\File as File;


class FileController extends AbstractController {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\FileRepository
     */
    protected $fileRepository;
    
     /**
     * @var \Grandhotel\Hausnetz\Service\FileService
     * @Flow\Inject
     */
    protected $fileService;
    
    /**
     */
    public function indexAction() {
      $user = $this->authService->getCurrentUser();
      $items = $this->fileService->getFiles()['files'];
      $ci = count($items);
      
      $test = $this->fileRepository->getTest();
      $this->view->assign('user', $user->getUserName());
      $this->view->assign('items', $items);
      $this->view->assign('ci', $ci);
    }
    
    
    // downloadAction in F.service
    public function downloadAction($id) {
       $this->fileService->inlineAction($file=$id);
    }
    
    public function getAction($file) {
       $this->fileService->downloadAction($file=$name);
    }

    /**
    */
    public function newAction() {
      $this->view->assign('action', 'create');
    }

    /**
     * @param File $file
     */
    public function editAction(File $file) {
      $this->view->assign('file', $file);
      $this->view->assign('action', 'update');
    }

    /**
     * @param File $file
     */
    public function deleteAction(File $file) {
        $title = $file->getTitle();
        $this->fileRepository->remove($file);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage("Die Datei $title wurde gelöscht.");
        $this->redirect('index');
    }

    
    /**
    * @param File $file
    */
    public function createAction(File $file) {
        $title = $file->getTitle();
        $file->setActive = TRUE;
        $user = $this->authService->getCurrentUser();
        $file->setUser($user);
        $this->fileRepository->add($file);
        $this->addFlashMessage("Die neue Datei $title wurde gespeichert.");
        $this->redirect('index');
    }    
    /**
    * @param File $file
    */
    public function updateAction(File $file) {
        $title = $file->getTitle();
        $this->fileRepository->update($file);
        $this->addFlashMessage("Die Änderungen an Datei $title wurden gespeichert.");
        $this->redirect('index');
    }
    
    
   public function dropzoneUploadAction() {
        $path = $directory = $this->encryptionService->decrypt(base64_decode(urldecode($_POST['folder'])));
        if (isset($_FILES) && is_array($_FILES) && isset($_FILES['file']) && is_array($_FILES['file'])) {
            if (isset($_FILES['file']['name']) && is_array($_FILES['file']['name'])) {
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    if ($_FILES['file']['error'][$i] == 0) {
                        $folder = $path;
                        if (!is_dir($folder)) {
                            mkdir($folder, 0770, TRUE);
                        }
                        $fileName = $_FILES['file']['name'][$i];
                        $tmpName = $_FILES['file']['tmp_name'][$i];
                        $fileName = $this->fileService->getTempFileName($fileName, $folder . '/');
                        move_uploaded_file($tmpName, $folder . '/' . $fileName);
                    }
                }
            }
        }
   }
}
