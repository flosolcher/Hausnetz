<?php
namespace Grandhotel\Hausnetz\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Grandhotel.Hausnetz".   *
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
class ScheduleTemplateRepository extends AbstractRepository {


    /**
     *
     * @param $user
     * @return \Grandhotel\Hausnetz\Domain\Model\ScheduleTemplate
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
          'name'     => 'Name',
          'property' => 'title'
             ),
         array(
          'name'     => 'Inhalt',
          'property' => 'content',
          'format'   => 'default',
          'crop'     => '20',
             ),
         array(
          'name'     => 'Tag',
          'property' => 'day',
          'type'     => 'int',
          'format'   => 'select',
          'options'  => array(
              1 => 'Montag',
              2 => 'Dienstag',
              3 => 'Mittwoch',
              4 => 'Donnerstag',
              5 => 'Freitag',
              6 => 'Samstag',
              7 => 'Sonntag',
          )
         ),
         array(
          'name'     => 'Anfang',
          'property' => 'begin',
          'type'     => 'int',
          'format'   => 'time',
             ),
         array(
          'name'     => 'Ende',
          'property' => 'end',
          'type'     => 'int',
          'format'   => 'time',
             ),
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