<?php
namespace Grandhotel\Hausnetz\Domain\Model\Super;

use Grandhotel\Hausnetz\Domain\Model\User;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;


abstract class AbstractModel {

    //---------------- PROPERTIES --------------------//

    /**
     * @var boolean
     * @ORM\Column(nullable=true)
     */
    protected $active;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $changeDate;

    /**
     * @var User
     * @ORM\ManyToOne
     * @ORM\Column(nullable=true)
     */
    protected $changeUser;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createDate;

    /**
     * @var User
     * @ORM\ManyToOne
     * @ORM\Column(nullable=true)
     */
    protected $createUser;

    /**
     * @var boolean
     * @ORM\Column(nullable=true)
     */
    protected $deleted;

    //---------------- GETTER --------------------//

    /**
     * @return boolean
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * @return \DateTime
     */
    public function getChangeDate()
    {
        return $this->changeDate;
    }

    /**
     * @return User
     */
    public function getChangeUser()
    {
        return $this->changeUser;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return User
     */
    public function getCreateUser()
    {
        return $this->createUser;
    }

    /**
     * @return boolean
     */
    public function getDeleted() {
        return $this->deleted;
    }

    //---------------- SETTER --------------------//

    /**
     * @param boolean $active
     * @return void
     */
    public function setActive($active) {
        $this->active = $active;
    }

    /**
     * @param \DateTime $changeDate
     * @return void
     */
    public function setChangeDate($changeDate)
    {
        $this->changeDate = $changeDate;
    }

    /**
     * @param User $changeUser
     * @return void
     */
    public function setChangeUser(User $changeUser = NULL)
    {
        $this->changeUser = $changeUser;
    }

    /**
     * @param \DateTime $createDate
     * @return void
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @param Member $createUser
     * @return void
     */
    public function setCreateUser(User $createUser = NULL)
    {
        $this->createUser = $createUser;
    }

    /**
     * @param boolean $deleted
     * @return void
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }
}