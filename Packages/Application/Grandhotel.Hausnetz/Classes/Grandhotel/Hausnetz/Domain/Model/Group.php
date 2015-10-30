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
class Group extends AbstractModel
{


    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $name;


    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $permissions;


    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $deny;

    /**
     * @var int
     * @ORM\Column(nullable=true)
     */
    protected $referenceId;


    /**
     * @var \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\User>
     * @ORM\ManyToMany(inversedBy="groups",cascade={"persist"})
     */
    protected $users;


    public function __construct() {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param string $permissions
     * @return void
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getDeny()
    {
        return $this->deny;
    }

    /**
     * @param string $deny
     * @return void
     */
    public function setDeny($deny)
    {
        $this->deny = $deny;
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
     * @return \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\User>
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\User> $users
     */
    public function setUsers(\Doctrine\Common\Collections\Collection $users) {
        $this->users = $users;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user) {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user) {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }
    }
}