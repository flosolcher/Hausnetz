<?php
namespace Grandhotel\Hausnetz\Controller\Super;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\I18n\Locale;
use TYPO3\Flow\Mvc\View\ViewInterface;

abstract class AbstractController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * @var \TYPO3\Flow\I18n\Service
     * @Flow\Inject
     */
    protected $il8nService;

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
            $userLocale =  new Locale($this->authService->getLocale());
            $currentLocale = $this->il8nService->getConfiguration()->getCurrentLocale();

            if ($userLocale != $currentLocale) {

                $this->il8nService->getConfiguration()->setCurrentLocale($userLocale);
            }
        }


        parent::initializeAction();

    }

    public function initializeView(ViewInterface $view) {
        $view->assign('currentUser', $this->authService->getCurrentUser());
        $view->assign('currentController', $this->request->getControllerName());
        $view->assign('currentAction', $this->request->getControllerActionName());
    }
}