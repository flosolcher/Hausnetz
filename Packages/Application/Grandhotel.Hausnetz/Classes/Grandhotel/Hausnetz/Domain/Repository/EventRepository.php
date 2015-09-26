<?php
namespace Grandhotel\Hausnetz\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use Grandhotel\Hausnetz\Domain\Repository\Super\AbstractRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryInterface;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class EventRepository extends AbstractRepository {

    /**
     * @param \DateTime $date
     * @return \TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listMonthEvents(\DateTime $date) {


        $startDate = clone $date;
        $endDate = clone $date;

        $startDate->modify('first day of this month');
        $endDate->modify('last day of this month');


        return $this->listItems(
            'startDate',
            \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING,
            ($query = $this->createQuery()),
            array(
                $query->logicalOr(
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('startDate', $startDate),
                        $query->lessThanOrEqual('startDate', $endDate)
                    ),
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('endDate', $startDate),
                        $query->lessThanOrEqual('endDate', $endDate)
                    ),
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('startDate', $startDate),
                        $query->lessThanOrEqual('endDate', $endDate),
                        $query->logicalNot($query->equals('endDate', NULL))
                    )
                )
            )
        );

    }

}