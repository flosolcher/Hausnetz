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
class Event extends AbstractModel {

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $title;


    /**
     * @var int
     * @ORM\Column(nullable=true)
     */
    protected $referenceId;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;


    /**
     * @var \Grandhotel\Hausnetz\Domain\Model\Container
     * @ORM\ManyToOne(cascade={"persist"})
     */
    protected $container;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $startDate;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $recurringStartDate;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endDate;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $recurringEndDate;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $location;

    /**
     * @var boolean
     * @ORM\Column(nullable=true)
     */
    protected $wholeDay;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getRecurringStartDate()
    {
        return $this->recurringStartDate;
    }

    /**
     * @param \DateTime $recurringStartDate
     * @return void
     */
    public function setRecurringStartDate($recurringStartDate)
    {
        $this->recurringStartDate = $recurringStartDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }


    /**
     * @return \DateTime
     */
    public function getRecurringEndDate()
    {
        return $this->recurringEndDate;
    }

    /**
     * @param \DateTime $recurringEndDate
     * @return void
     */
    public function setRecurringEndDate($recurringEndDate)
    {
        $this->recurringEndDate = $recurringEndDate;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }


    /**
     * @return boolean
     */
    public function getWholeDay()
    {
        return $this->wholeDay;
    }

    /**
     * @param boolean $wholeDay
     * @return void
     */
    public function setWholeDay($wholeDay)
    {
        $this->wholeDay = $wholeDay;
    }
}