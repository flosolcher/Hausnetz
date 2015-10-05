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
 * @Flow\Entity
 */
class Resource extends AbstractModel {


    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $description;

   
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    
    /**
     * @param string description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    
    /**
     * @param string title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}
