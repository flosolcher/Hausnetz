<?php
namespace Grandhotel\Hausnetz\Controller\Super;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

abstract class AbstractController extends \TYPO3\Flow\Mvc\Controller\ActionController {


    /**
     * @var \Grandhotel\Hausnetz\Service\AuthService
     * @Flow\Inject
     */
    protected $authService;

    /**
     * @var \TYPO3\Flow\Core\Bootstrap
     * @Flow\Inject
     */
    protected $bootstrapService;

    /**
     * @Flow\Session(autoStart = TRUE)
     */
    public function initializeAction() {

        if ($this->bootstrapService->getContext() == 'Development') {

        }
        if (!$this->authService->isLoggedIn()) {
            if ($this->request->getControllerName() != 'User') {
                $this->redirect('login', 'User');
            }
        } else {
            // Handle other access checks
        }
        parent::initializeAction();
    }
}