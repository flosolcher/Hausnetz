<?php

namespace Grandhotel\Hausnetz\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("prototype")
 */


class GetPropertyViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param object $object
     * @param string $field
     * @return mixed
     */
    public function render($object, $field = '') {
        $getter = 'get' . ucfirst($field);
        return $object->$getter();
    }

}
