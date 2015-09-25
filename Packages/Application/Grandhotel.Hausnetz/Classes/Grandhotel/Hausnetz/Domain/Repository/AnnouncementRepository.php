<?php
namespace Grandhotel\Hausnetz\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Domain\Model\Container;
use Grandhotel\Hausnetz\Domain\Repository\Super\AbstractRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryInterface;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class AnnouncementRepository extends AbstractRepository {

    public function listAnnouncements($limit, Container $container = NULL) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('announcement', NULL);
        if ($container != NULL) {
            $constraints[] = $query->equals('container', $container);
        }
        return $this->listItems('createDate', \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING, $query, $constraints, FALSE, FALSE, $limit);
    }
}