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
class ScheduleItemRepository extends AbstractRepository {

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\UserRepository
     */
    protected $userRepository;

   
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ScheduleTemplateRepository
     */
    protected $scheduleTemplateRepository;
    
    /**
     *
     * @param $user
     * @return \Grandhotel\Hausnetz\Domain\Model\ScheduleItem
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
          'property' => 'title',
          'help'     => ''
             ),
       array(
          'name' => 'User',
           'property' => 'user',
           'type' => 'object',
           'relation' => array(
               'items' => function() {
                   return $this->userRepository->listItems('lastName', 'ASC');
                },
               'type'            => 'n-1',
               'display'         => 'fullName',
           ),
           'format' => 'select',
           'help'   => 'Wer die Schicht belegt.'        
          ),
/*                        
        array(
          'name' => 'Template',
           'property' => 'scheduleTemplate',
           'type' => 'object',
           'relation' => array(
               'items' => function() {
                   return $this->scheduleTemplateRepository->listItems('title', 'ASC');
                },
               'type'            => 'n-1',
               'display'         => 'title',
           ),
           'format' => 'select',
           'help'   => 'Die Vorlage'        
          ),
  */                     
         array(
          'name'     => 'Inhalt',
          'property' => 'content',
          'help'    => 'Ein aussagekräftiger Titel für die Schicht (zB. "Bar #1 vormittag")'
             ),
         array(
          'name'     => 'Tag',
          'property' => 'day',
          'type'     => 'int',
          'help'    => 'Eine Zahl von 1-7 für den Wochentag.'
             ),
         array(
          'name'     => 'Datum',
          'property' => 'date',
          'type'     => 'datetime',
          'help'    => 'Absolutes Datum der Schicht'
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