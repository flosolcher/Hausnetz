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
class UserRepository extends AbstractRepository {


    /**
     *
     * @param string $userName The Username
     * @param string $password The user password
     * @return \Grandhotel\Hausnetz\Domain\Model\User
     */
    public function findLoginUser($userName, $password) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('userName', $userName);
        $constraints[] = $query->equals('password', $password);
        $constraints[] = $query->equals('active', TRUE);

        $result = $query->matching($query->logicalAnd($constraints))
            ->execute();
        if ($result->count() > 0) {
            return $result->getFirst();
        } else {
            return null;
        }
    }

    /**
     *
     * @param string $email The user email
     * @return \Grandhotel\Hausnetz\Domain\Model\User
     */
    public function findActiveUser($email) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('email', $email);
        $constraints[] = $query->equals('active', TRUE);

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
    public function listUsers(){
        return $this->listItems(
            'surname',
            QueryInterface::ORDER_ASCENDING
        );
    }

    /**
     * @return TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listAdmins(){
        return $this->listItems(
            'surname',
            QueryInterface::ORDER_ASCENDING,
            ($query = $this->createQuery()),
            array($query->equals('role', 'admin'))
        );
    }
}