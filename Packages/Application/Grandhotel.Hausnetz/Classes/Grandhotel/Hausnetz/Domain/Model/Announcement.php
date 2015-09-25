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
class Announcement extends AbstractModel {

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $message;

    /**
     * @var int
     * @ORM\Column(nullable=true)
     */
    protected $referenceId;


    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\Container
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $container;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $sortDate;


    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\Announcement
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $announcement;

    /**
     * @var \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\Announcement>
     * @ORM\OneToMany(mappedBy="announcement",cascade={"persist"})
     * @ORM\OrderBy({"createDate" = "ASC"})
     */
    protected $announcements;



    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
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
     * @return Container
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container = NULL) {
        $this->container = $container;
    }

    /**
     * @return \DateTime
     */
    public function getSortDate()
    {
        return $this->sortDate;
    }

    /**
     * @param \DateTime $sortDate
     * @return void
     */
    public function setSortDate($sortDate)
    {
        $this->sortDate = $sortDate;
    }

    /**
     * @return Announcement
     */
    public function getAnnouncement() {
        return $this->announcement;
    }

    /**
     * @param Announcement $announcement
     */
    public function setAnnouncement(Announcement $announcement = NULL) {
        $this->announcement = $announcement;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnouncements() {
        return $this->announcements;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\Announcement> $announcements
     */
    public function setAnnouncements(\Doctrine\Common\Collections\Collection $announcements) {
        $this->announcements = $announcements;
    }
}