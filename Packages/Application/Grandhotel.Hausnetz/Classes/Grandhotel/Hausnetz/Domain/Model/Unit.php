<?php
namespace Grandhotel\Hausnetz\Domain\Model;

/*                                                  
 * This script belongs to the TYPO3 Flow package GHC
 *                                                  
 */

use Grandhotel\Hausnetz\Domain\Model\Super\AbstractModel;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\ValueObject
 */
class Unit extends AbstractModel {

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $description;

    
    public function __construct($title, $description=NULL) {
        $this->title = $title;
        $this->description = $description;
        
    }

    
}
