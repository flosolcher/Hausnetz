<?php
namespace Grandhotel\Hausnetz\Domain\Repository\Super;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Monacofriends.SDL".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
abstract class AbstractRepository extends Repository {
    /**
     * @var \Grandhotel\Hausnetz\Service\AuthService
     * @Flow\Inject
     */
    protected $authService;

    /**
     * @Flow\Inject
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;


    /**
     * @param object $object
     */
    public function add($object) {
        if ($this->authService->getCurrentUser()) $object->setChangeUser($this->authService->getCurrentUser());
        if ($this->authService->getCurrentUser()) $object->setCreateUser($this->authService->getCurrentUser());
        if (!$object->getChangeDate()) $object->setChangeDate(new \DateTime());
        if (!$object->getCreateDate()) $object->setCreateDate(new \DateTime());
        $object->setDeleted(false);
        if (!$object->getActive()) $object->setActive(false);
        parent::add($object);
    }

    /**
     * @param object $object
     * @param bool $setDate
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function update($object, $setDate = TRUE) {
        if ($this->authService->getCurrentUser()) $object->setChangeUser($this->authService->getCurrentUser());
        if ($setDate) $object->setChangeDate(new \DateTime());
        parent::update($object);
    }

    /**
     * @param string $order
     * @param string $direction
     * @param \TYPO3\Flow\Persistence\QueryInterface $query
     * @param array $constraints
     * @param bool $showInactive
     * @param bool $showDeleted
     * @param int $limit
     * @param int $offset
     * @return \TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listItems($order = '', $direction = \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, \TYPO3\Flow\Persistence\QueryInterface $query = NULL, $constraints = array(), $showInactive = false, $showDeleted = false, $limit = NULL, $offset = NULL) {
        if ($direction == '') {
            $direction = \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING;
        }
        if ($query === NULL) {
            $query = $this->createQuery();
        }
        $orderings =    array(
            $order => $direction,
            'changeDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING

        );
        $query->setOrderings(
            $orderings
        );
        if (!$showInactive) {
            $constraints[] = $query->equals('active', TRUE);
        } else {

        }
        if (!$showDeleted) {
            $constraints[] = $query->logicalOr(
                $query->equals('deleted', FALSE),
                $query->equals('deleted', NULL)
            );
        }
        if ($limit != NULL) {
            $query->setLimit($limit);
        }
        $result = $query->matching($query->logicalAnd($constraints))->execute();
        return $result;
    }

    /**
     * @param string $order
     * @param string $direction
     * @param \TYPO3\Flow\Persistence\QueryInterface $query
     * @param array $constraints
     * @param bool $showInactive
     * @param bool $showDeleted
     * @return object
     */
    public function getFirst($order = '', $direction = \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING, \TYPO3\Flow\Persistence\QueryInterface $query = NULL, $constraints = array(), $showInactive = false, $showDeleted = false) {
        $result = $this->listItems($order, $direction, $query, $constraints, $showInactive, $showDeleted, 1);
        if ($result->count() > 0) {
            return $result->getFirst();
        } else {
            return null;
        }
    }

    /**
     * @return \TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listActive() {
        $query = $this->createQuery();
        $constraints[] = $query->equals('active', TRUE);
        $result = $query->matching($query->logicalAnd($constraints))->execute();
        return $result;
    }
    
    
    public function completeFields($fields) {
        // default values, TODO: in settings
        $defaults = array(
          'type'  => 'string',
          'crop'  => '20',
          'format'=> 'default',
          );
      

        // set default values where no default given above
        $keys = array('type', 'format', 'crop');
        foreach($fields as $dk => $items) {
            foreach ($keys as $key) {
                if (! array_key_exists($key, $items)) {
                    $fields[$dk][$key] = $defaults[$key];
                }
            }
        }

        return $fields;
    }
}