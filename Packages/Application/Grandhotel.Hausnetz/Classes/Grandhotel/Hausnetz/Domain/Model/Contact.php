<?php
namespace Grandhotel\Hausnetz\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Domain\Model\Super\AbstractModel;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Contact extends AbstractModel {


    /**
     * @var string
     */
    protected $chr_name;

    /**
     * @var string
     */
    protected $fam_name;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $str1;

    /**
     * @var string
     */
    protected $str2;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $fax;

    /**
     * @var string
     */
    protected $cellphone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var string
     */
    protected $facebook;

    /**
     * @var string
     */
    protected $twitter;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $memo;

    /**
     * @var integer
     */
    protected $lastuser;

    /**
     * @var integer
     */
    protected $vis;



    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\User
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $user;

    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\Container
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $container;
    
    
    /**
     * @return string
     */
    public function getChr_name()
    {
        return $this->chr_name;
    }
    
    /**
     */
    public function setChr_name($chr_name)
    {
        $this->chr_name = $chr_name
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
