<?php

namespace Grandhotel\Hausnetz\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("prototype")
 */
class IndexlinksViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    public function render($from, $to) {
       $from = 'A';
       $to = 'Z';
    
       $f = ord($from);
       $t = ord($to);
       $line = '';
       for($i = $f; $i<$t; $i++) {
          $line .= ' ';
          $line .= '<a href="#'.chr($i).'">'.chr($i).'</a>';
       }
        return $line;
    }
}
