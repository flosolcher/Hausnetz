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
class Note extends AbstractModel {


    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $content;

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
    public function getContent()
    {
        return $this->content;
    }

    
    /**
     * @param string content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
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
