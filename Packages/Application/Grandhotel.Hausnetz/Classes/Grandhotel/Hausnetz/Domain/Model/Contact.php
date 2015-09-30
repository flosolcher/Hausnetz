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



    /** @var string */
    protected $NameNamePrefix;
    /** @var string */
    protected $NameFirstName;
    /** @var string */
    protected $NameMiddleName;
    /** @var string */
    protected $NameLastName;
   /** @var string */
    protected $NameOtherName;

    /** @var string */
    protected $OrganisationName;
    /** @var string */
    protected $OrganisationType;

    /** @var string */
    protected $ContactCellphone;
    /** @var string */
    protected $ContactFax;
    /** @var string */
    protected $ContactTelephone;
    
    /** @var string */
    protected $ContactEmail;
    /** @var string */
    protected $ContactFacebook;
    /** @var string */
    protected $ContactTwitter;
    /** @var string */
    protected $ContactWebsite;

    /** @var string */
    protected $AddressLocality;
    /** @var string */
    protected $AddressCountry;
    /** @var string */
    protected $AddressFreeTextAddress;
    /** @var string */
    protected $AddressAdministrativeArea;
    /** @var string */
    protected $AddressThoroughfare;
    /** @var string */
    protected $AddressPremises;
    /** @var string */
    protected $AddressPostCode;
    /** @var string */
    protected $AddressLocationByCoordinates;

    /** @var string */
    protected $Comment;

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
    public function getNameFirstName()
    {
        return $this->NameFirstName;
    }
    
    /**
     * @param string $NameFirstName
     */
    public function setNameFirstName($NameFirstName)
    {
        $this->NameFirstName = $NameFirstName;
    }

    
    /**
     * @return string
     */
    public function getNameOtherName()
    {
        return $this->NameOtherName;
    }
    
    /**
     * @param string $NameOtherName
     */
    public function setNameOtherName($NameOtherName)
    {
        $this->NameOtherName = $NameOtherName;
    }

    /**
     * @return string
     */
    public function getNameNamePrefix()
    {
        return $this->NameNamePrefix;
    }
    
    /**
     * @param string $NameNamePrefix
     */
    public function setNameNamePrefix($NameNamePrefix)
    {
        $this->NameNamePrefix = $NameNamePrefix;
    }

    /**
     * @return string
     */
    public function getNameMiddleName()
    {
        return $this->NameMiddleName;
    }
    
    /**
     * @param string $NameMiddleName
     */
    public function setNameMiddleName($NameMiddleName)
    {
        $this->NameMiddleName = $NameMiddleName;
    }
   
    /**
     * @return string
     */
    public function getContactCellphone()
    {
        return $this->ContactCellphone;
    }
    
    /**
     * @param string $ContactCellphone
     */
    public function setContactCellphone($ContactCellphone)
    {
        $this->ContactCellphone = $ContactCellphone;
    }
   
    /**
     * @return string
     */
    public function getContactFax()
    {
        return $this->ContactFax;
    }
    
    /**
     * @param string $ContactFax
     */
    public function setContactFax($ContactFax)
    {
        $this->ContactFax = $ContactFax;
    }
   
    /**
     * @return string
     */
    public function getContactEmail()
    {
        return $this->ContactEmail;
    }
    
    /**
     * @param string $ContactEmail
     */
    public function setContactEmail($ContactEmail)
    {
        $this->ContactEmail = $ContactEmail;
    }
   
    /**
     * @return string
     */
    public function getContactFacebook()
    {
        return $this->ContactFacebook;
    }
    
    /**
     * @param string $ContactFacebook
     */
    public function setContactFacebook($ContactFacebook)
    {
        $this->ContactFacebook = $ContactFacebook;
    }
   
    /**
     * @return string
     */
    public function getContactTwitter()
    {
        return $this->ContactTwitter;
    }
    
    /**
     * @param string $ContactTwitter
     */
    public function setContactTwitter($ContactTwitter)
    {
        $this->ContactTwitter = $ContactTwitter;
    }
   
    /**
     * @return string
     */
    public function getContactWebsite()
    {
        return $this->ContactWebsite;
    }
    
    /**
     * @param string $ContactWebsite
     */
    public function setContactWebsite($ContactWebsite)
    {
        $this->ContactWebsite = $ContactWebsite;
    }
   
    /**
     * @return string
     */
    public function getContactTelephone()
    {
        return $this->ContactTelephone;
    }
    
    /**
     * @param string $ContactTelephone
     */
    public function setContactTelephone($ContactTelephone)
    {
        $this->ContactTelephone = $ContactTelephone;
    }
   
         
    /**
     * @return string $AddressAdministrativeArea
     */
    public function getAddressAdministrativeArea()
    {
        return $this->AddressAdministrativeArea;
    }

     /**
     * @param string $AddressAdministrativeArea
     */
    public function setAddressAdministrativeArea($AddressAdministrativeArea)
    {
        $this->AddressAdministrativeArea = $AddressAdministrativeArea;
    }

     
    /**
     * @return string $AddressCountry
     */
    public function getAddressCountry()
    {
        return $this->AddressCountry;
    }

     /**
     * @param string $AddressCountry
     */
    public function setAddressCountry($AddressCountry)
    {
        $this->AddresCountry = $AddressCountry;
    }

 
    /**
     * @return string AddressLocality
     */
    public function getAddressLocality()
    {
        return $this->AddressLocality;
    }

     /**
     * @param string $AddressLocality
     */
    public function setAddressLocality($AddressLocality)
    {
        $this->AddresLocality = $AddressLocality;
    }

 
    
    /**
     * @return string $AddressThoroughfare
     */
    public function getAddressThoroughfare()
    {
        return $this->AddressThoroughfare;
    }

     /**
     * @param string $AddressThoroughfare
     */
    public function setAddressThoroughfare($AddressThoroughfare)
    {
        $this->AddresThoroughfare = $AddressThoroughfare;
    }

    
    /**
     * @return string $AddressPostCode
     */
    public function getAddressPostCode()
    {
        return $this->AddressPostCode;
    }

     /**
     * @param string $AddressPostCode
     */
    public function setAddressPostCode($AddressPostCode)
    {
        $this->AddresPostCode = $AddressPostCode;
    }

 
    
    /**
     * @return string $AddressPremises
     */
    public function getAddressPremises()
    {
        return $this->AddressPremises;
    }

     /**
     * @param string $AddressPremises
     */
    public function setAddressPremises($AddressPremises)
    {
        $this->AddresPremises = $AddressPremises;
    }

    /**
     * @return string $AddressLocationByCoordinates
     */
    public function getAddressLocationByCoordinates()
    {
        return $this->AddressLocationByCoordinates;
    }

     /**
     * @param string $AddressLocationByCoordinates
     */
    public function setAddressLocationByCoordinates($AddressLocationByCoordinates)
    {
        $this->AddresLocationByCoordinates = $AddressLocationByCoordinates;
    }

    
    /**
     * @return string $OrganisationName
     */
    public function getOrganisationName()
    {
        return $this->OrganisationName;
    }

     /**
     * @param string $OrganisationName
     */
    public function setOrganisationName($OrganisationName)
    {
        $this->OrganisationName = $OrganisationName;
    }

    /**
     * @return string $OrganisationType
     */
    public function getOrganisationType()
    {
        return $this->OrganisationType;
    }

     /**
     * @param string $OrganisationType
     */
    public function setOrganisationType($OrganisationType)
    {
        $this->OrganisationType = $OrganisationType;
    }

    /**
     * @return string $Comment
     */
    public function getComment()
    {
        return $this->Comment;
    }

     /**
     * @param string $Comment
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;
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
