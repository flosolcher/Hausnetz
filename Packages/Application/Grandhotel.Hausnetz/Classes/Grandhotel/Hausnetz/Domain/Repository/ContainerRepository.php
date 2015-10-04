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
class ContainerRepository extends AbstractRepository {


    public function getFields() {
      // TODO move to yaml format
      $fields = array(
         array(
          'name'     => 'Name',
          'property' => 'title'),
         array(
          'name'     => 'Farbe',
          'property' => 'color',
          'format'   => 'color',
             ),
         array(
          'name'     => 'Beschreibung',
          'property' => 'description',
             ),
      );
      
      return $this->completeFields($fields);
    }
}