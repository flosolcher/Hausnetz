<?php

namespace Grandhotel\Hausnetz\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("prototype")
 */
class ColorViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $color
     * @return string
     */
    public function render($color = 'fff') {
        return "<span style=\"background: #$color; display:block;\">&nbsp;</span>";
    }

}
