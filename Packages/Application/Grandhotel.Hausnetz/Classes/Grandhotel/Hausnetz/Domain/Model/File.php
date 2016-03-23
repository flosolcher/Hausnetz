<?php
namespace Grandhotel\Hausnetz\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Domain\Model\Super\AbstractModel;
//use Grandhotel\Hausnetz\Domain\Model\User;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class File extends AbstractModel {


    /**
     * @var string
     */
    protected $title;


    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\User
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $user;

    
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

     /*
     /**
     * @return \Grandhotel\Hausnetz\Domain\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

     /**
     * @param \Grandhotel\Hausnetz\Domain\Model\User
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user; 
    }

    
    
}
