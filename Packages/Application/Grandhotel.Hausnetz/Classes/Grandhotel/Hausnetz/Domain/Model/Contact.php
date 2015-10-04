<?php
namespace Grandhotel\Hausnetz\Domain\Model;

/*                                                                        
 * This script belongs to the TYPO3 Flow package Grandhotel.Hausnetz      
 * A Contact is a natural person or an organisation
 * a contact might correspond to a user
 * a contact can have one container assigned                                                                         *
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
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthdate;

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
    protected $comment;


    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\User
     * @ORM\OneToOne(cascade={"persist"})
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
     * @param string lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    
    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * @param string company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }


    /**
     * @return string
     */
    public function getStr1()
    {
        return $this->str1;
    }
    
    /**
     * @param string str1
     */
    public function setStr1($str1)
    {
        $this->str1 = $str1;
    }

    /**
     * @return string $str2
     */
    public function getStr2()
    {
        return $this->str2;
    }
    
    /**
     * @param string $str2
     */
    public function setStr2($str2)
    {
        $this->str2 = $str2;
    }


    /**
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }
    
    /**
     * @param string $zip 
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }


    /**
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }


    /**
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    /**
     * @return string $fax
     */
    public function getFax()
    {
        return $this->fax;
    }
    
    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }


    /**
     * @return string $cellphone
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }
    
    /**
     * @param string $cellphone
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }


    /**
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }
    
    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }


    /**
     * @return string $facebook
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
    
    /**
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }


    /**
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
    
    /**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
