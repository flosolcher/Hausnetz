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
class ScheduleTemplate extends AbstractModel {


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
     * @var int
     */
    protected $day;

    /**
     * @var int
     */
    protected $begin;

    /**
     * @var int
     */
    protected $end;


    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @param string $content
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
    public function getDay()
    {
        return $this->day;
    }


    /**
     * @param int $day
     * @return void
     */
    public function setDay($day)
    {
        $this->day = $day;
    }


    /**
     * @return int
     */
    public function getBegin()
    {
        return $this->begin;
    }


    /**
     * @param int $begin
     * @return void
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    }

    /**
     * @return int
     */
    public function getEnd()
    {
        return $this->end;
    }


    /**
     * @param int $end
     * @return void
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }
}
