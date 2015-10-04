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


    private $fields;
    
    public function getFields() {
        $fields = array(
         array(
          'name'     => 'Titel',
          'property' => 'title',
          'crop' => 40,
          'linked'  => true,
          ),
         array(
          'name'     => 'Beschreibung',
          'property' => 'description',
          'format'  => 'text',
          'crop'    => 40,   
             ),
         array(
          'name'     => 'Öffentlich',
          'property' => 'public_audience',
          'type'    => 'bool',
           'format' => 'bool'  
             ),
         array(
          'name'     => 'Anfangsdatum',
          'property' => 'startDate',
             'type' => 'datetime',
           'format' => 'datetime',
             ),
         array(
          'name'     => 'Enddatum',
          'property' => 'endDate',
             'type' => 'datetime',
           'format' => 'datetime'
             ),
        );
        
        return $this->completeFields($fields);
    }
    
    
    
    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return \TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listPublicTimeRangeEvents(\DateTime $startDate, \DateTime $endDate) {

        return $this->listItems(
            'startDate',
            \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING,
            ($query = $this->createQuery()),
            array( $query->equals('public_audience', 1) ),
            $limit=100
            );
    }
    
    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return \TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listTimeRangeEvents(\DateTime $startDate, \DateTime $endDate) {

        return $this->listItems(
            'startDate',
            \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING,
            ($query = $this->createQuery()),
            array(
                $query->logicalOr(

                    /* Regular Events */
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
                    ),

                    /* Recurring Events */
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('recurringStartDate', $startDate),
                        $query->lessThanOrEqual('recurringStartDate', $endDate)
                    ),
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('recurringEndDate', $startDate),
                        $query->lessThanOrEqual('recurringEndDate', $endDate)
                    ),
                    $query->logicalAnd(
                        $query->greaterThanOrEqual('recurringStartDate', $startDate),
                        $query->lessThanOrEqual('recurringEndDate', $endDate),
                        $query->logicalNot($query->equals('recurringEndDate', NULL))
                    )
                )
            )
        );

    }

}