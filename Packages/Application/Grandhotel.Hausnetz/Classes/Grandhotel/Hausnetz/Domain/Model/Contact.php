<?php
namespace Grandhotel\Hausnetz\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Domain\Model\Super\AbstractModel;
//use Grandhotel\Hausnetz\Domain\Model\Address;
//use CommerceGuys\Addressing\Model\Address;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Contact extends AbstractModel {


    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     * 
     */
    private $address;

    /**
     * //@var \Grandhotel\Hausnetz\Domain\Model\User
     * //@ORM\OneToOne(cascade={"persist"})
     */
    //protected $user;

    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\Container
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $container;
    
    /**
     * @var int
     * @ORM\Column(nullable=true)
     */
    protected $referenceId;
    
    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    
     
    /**
     * @return Address $adress
     */
    public function getAddress()
    {
        return $this->address;
    }

     /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address; 
    }

    
     
    /**
     * @return \Grandhotel\Hausnetz\Domain\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

     /**
     * @param \Grandhotel\Hausnetz\Domain\Model\User $user
     */
    public function setUser($user)
    {
        $this->user = $user; 
    }

    /**
     * @return \Grandhotel\Hausnetz\Domain\Model\Container $container
     */
    public function getContainer()
    {
        return $this->container;
    }

     /**
     * @param \Grandhotel\Hausnetz\Domain\Model\Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container; 
    }

    
    /**
     * @return int
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param int $referenceId
     * @return void
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }

    
}
