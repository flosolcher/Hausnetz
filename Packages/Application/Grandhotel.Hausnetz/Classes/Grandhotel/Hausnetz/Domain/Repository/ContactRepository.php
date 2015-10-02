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
       // default values, TODO: in settings
      $defaults = array(
          'type'  => 'string',
          'crop'  => '20',
          'format'=> 'default',
          );
      
      // TODO move to yaml format
      $fields = array(
         array(
          'name'     => 'Nachname',
          'property' => 'lastname'),
         array(
          'name'     => 'Vorname',
          'property' => 'firstname',
             ),
         array(
          'name'     => 'Telefon',
          'property' => 'phone',
             ),
         array(
          'name'     => 'Mobil',
          'property' => 'cellphone',
          'crop'     => false,
             ),
         array(
          'name'     => 'Strasse',
          'property' => 'str1',
          'type'     => 'string'
             ),
         array(
          'name'     => 'PLZ',
          'property' => 'zip',
          'type'     => 'string'
             ),
         array(
          'name'     => 'City',
          'property' => 'city',
          'type'     => 'string'
             ),
         array(
          'name'     => 'Email',
          'property' => 'email',
          'type'     => 'string',
          'format'   => 'link.email'
             ),
         array(
          'name'     => 'Website',
          'property' => 'website',
          'format'   => 'link.action'
             ),
         array(
          'name'     => 'Fax',
          'property' => 'fax',
             ),
          array(
              'name' => 'Facebook',
              'property'=>'facebook'
          ),
          array(
              'property' => 'comment', 
              'name'   => 'Bemerkung',
          )
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