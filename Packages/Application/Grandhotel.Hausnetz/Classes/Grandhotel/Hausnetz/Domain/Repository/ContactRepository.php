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
 * 
 */
class ContactRepository extends AbstractRepository {

    /**
     * @var array
     * // @Flow\InjectConfiguration(setting="fields")
     */
    //protected $fields;
    
    /**
     * @param $user
     * @return \Grandhotel\Hausnetz\Domain\Model\Contakt
     */
    public function findByUser($user) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('active', 1);
        $result = $query->matching($query->logicalAnd($constraints))
            ->execute();

        if ($result->count() > 0) {
            return $result->getFirst();
        } else {
            return null;
        }
    }


    public function getFields() {
      //return $this->fields;
      
      $fields = array();
      $fields[] = array(
          'name'     => 'Nachname',
          'property' => 'lastname',
          'type'     => 'string');
      $fields[] = array(
          'name'     => 'Vorname',
          'property' => 'firstname',
          'type'     => 'string');
      
      return $fields;
       
      
    }
}