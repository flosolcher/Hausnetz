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
class Note extends AbstractModel {


    /**
     * @var string
     */
    protected $content;


    /**
     * //@var \Doctrine\Common\Collections\Collection<\Grandhotel\Hausnetz\Domain\Model\User>
     * //@ORM\ManyToOne(mappedBy="notes",cascade={"persist"})
     */
    //protected $user;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


}