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
class User extends AbstractModel {


    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $password;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $firstName;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $lastName;


    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $userName;


    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $phone;


    /**
     * @var int
     * @ORM\Column(nullable=true)
     */
    protected $referenceId;


    /**
     * @var \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\Group>
     * @ORM\ManyToMany(mappedBy="users",cascade={"persist"})
     */
    protected $groups;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return void
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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


    /**
     * @return \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\Group>
     */
    public function getGroups() {
        return $this->groups;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\Group> $groups
     */
    public function setGroups(\Doctrine\Common\Collections\Collection $groups) {
        $this->groups = $groups;
    }

    /**
     * @param Group $group
     */
    public function addUser(Group $group) {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
        }
    }

    /**
     * @param Group $group
     */
    public function removeUser(Group $group) {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
        }
    }

}