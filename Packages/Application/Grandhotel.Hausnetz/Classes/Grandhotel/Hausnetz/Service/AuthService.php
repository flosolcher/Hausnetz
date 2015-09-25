<?php
namespace Grandhotel\Hausnetz\Service;

use Grandhotel\Hausnetz\Domain\Model\User;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("session")
 */
class AuthService {
    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * var boolean
     */
    protected $loggedIn = false;

    /**
     * var boolean
     */
    protected $passwordChanged = true;

    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\User
     */
    protected $currentUser;

    /**
     * @var string
     */
    protected $returnUrl = '';

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\UserRepository
     */
    protected $userRepository;

    /**
     * @var string
     * @Flow\Inject(setting="User.Salt")
     */
    protected $frontendSalt;

    /**
     * @param User $user
     */
    public function setCurrentUser(User $user = NULL) {
        $this->currentUser = $user;
    }

    /**
     * @return \Grandhotel\Hausnetz\Domain\Model\User
     */
    public function getCurrentUser() {
        return $this->currentUser;
    }


    /**
     * @param bool $changed
     * @return bool
     */
    public function setPasswordChanged($changed = true) {
        return $this->passwordChanged = $changed;
    }

    /**
     * @return bool
     */
    public function getPasswordChanged() {
        return $this->passwordChanged;
    }

    /**
     * @param boolean $value
     * @return void
     */
    public function setLoggedIn($value) {
        $this->loggedIn = $value;
    }

    /**
     * @return bool
     */
    public function isLoggedIn() {
        return $this->loggedIn;
    }

    /**
     * @param string $string
     * @return string
     */
    public function saltIt($string) {
        return sha1(md5($string) . '-' . md5($this->frontendSalt));
    }

    /**
     * @param $url
     */
    public function setReturnUrl($url) {
        $this->returnUrl = $url;
    }

    /**
     * @return string
     */
    public function getReturnUrl() {
        return $this->returnUrl;
    }

    /**
     *
     */
    public function logout() {
        $this->setLoggedIn(false);
        $this->setCurrentUser(NULL);
    }

    public function login($userName, $password) {
        $saltedPassword = $this->saltIt($password);
        $user = $this->userRepository->findLoginUser($userName, $saltedPassword);
        if(!empty($user) && $user->getRole() != 'none') {
            $loggedIn = ($this->saltIt($password) == $user->getPassword());
            $this->setLoggedIn($loggedIn);
            if($loggedIn) {
                $this->setCurrentUser($user);
            }
        } else { /* MD5 FALLBACK! */
            $user = $this->userRepository->findLoginUser($userName, md5($password));
            if (!empty($user) && $user->getRole() != 'none') {
                $loggedIn = (md5($password) == $user->getPassword());
                $this->setLoggedIn($loggedIn);
                if ($loggedIn) {
                    $user->setPassword($saltedPassword);
                    $this->userRepository->update($user);
                    $this->persistenceManager->persistAll();
                    $this->setCurrentUser($user);
                }

            }
        }
        return $this->isLoggedIn();
    }


    public function generatePassword() {
        $length     = 8;
        $rangeMin   = pow(36, $length-1); //smallest number to give length digits in base 36
        $rangeMax   = pow(36, $length)-1; //largest number to give length digits in base 36
        $base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number
        $newRand    = base_convert($base10Rand, 10, 36); //convert it
        return $newRand;
    }

}
