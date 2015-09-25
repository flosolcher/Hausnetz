<?php
namespace Grandhotel\Hausnetz\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Controller\Super\AbstractController;
use TYPO3\Flow\Annotations as Flow;

class UserController extends AbstractController {

    /**
     * @param array $loginObject
     * @Flow\Validate(argumentName="loginObject", type="Grandhotel.Hausnetz:Login")
     * @return void
     */
    public function loginAction($loginObject = null) {
        $this->flashMessageContainer->flush();
        if($this->authService->isLoggedIn()) {
            $this->redirect('index', 'Standard');
        } else {
            // Login Fail -> do nothing

        }
    }

}