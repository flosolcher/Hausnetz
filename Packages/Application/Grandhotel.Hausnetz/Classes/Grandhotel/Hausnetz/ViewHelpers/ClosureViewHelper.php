<?php

namespace Grandhotel\Hausnetz\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("prototype")
 */
class ClosureViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param mixed $subject
     * @return mixed
     */
    public function render($subject) {
        return $subject();
    }

}
