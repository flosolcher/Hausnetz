<?php
namespace Grandhotel\Hausnetz\Validation\Validator;

use TYPO3\Flow\Annotations as Flow;
use  TYPO3\Flow\Validation\Validator\AbstractValidator;

/**
 * Validator for not empty values.
 *
 * @Flow\Scope("singleton")
 */
class LoginValidator extends AbstractValidator {

    /**
     * This validator always needs to be executed even if the given value is empty.
     * See AbstractValidator::validate()
     *
     * @var boolean
     */
    protected $acceptsEmptyValues = FALSE;


    /**
     * @var \Grandhotel\Hausnetz\Service\AuthService
     * @Flow\Inject
     */
    protected $authService;

    protected function isValid($value) {

        if (empty($value['userName'])) {
            $this->addError('Invalid value', 1221560718);
            $this->result->forProperty('userName')->addError(new \TYPO3\Flow\Validation\Error('Bitte Username eingeben', 1, array()));
            return;
        }
        if(empty($value['password'])) {
            $this->addError('Invalid value.', 1221560718);
            $this->result->forProperty('password')->addError(new \TYPO3\Flow\Validation\Error('Bitte Passwort eingeben', 1, array()));
            return;
        }

        $check = $this->authService->login($value['userName'], $value['password']);

        if (!$check) {
            $this->addError('Invalid value.', 1221560718);
            $this->addError('Falsches Passwort und/oder E-mailadresse', 1);
        }
    }


}