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
//use TYPO3\Flow\Log;

/**
 * @Flow\Scope("singleton")
 */
class ContactRepository extends AbstractRepository {


    /**
     *
     * @param $user
     * @return \Grandhotel\Hausnetz\Domain\Model\Contakt
     */
    public function findByCreateUser($user) {
        $query = $this->createQuery();
        $constraints = array();
//        $constraints[] = $query->equals('user', $user);
        $constraints[] = $query->equals('active', 1);
        $result = $query->matching($query->logicalAnd($constraints))
            ->execute();

        if ($result->count() > 0) {
            return $result->getFirst();
        } else {
            return null;
        }
    }


    /**
     * @return TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listContacts(){
        return $this->listItems(
            'content',
            QueryInterface::ORDER_ASCENDING
        );
    }

}