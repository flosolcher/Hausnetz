<?php
namespace Grandhotel\Hausnetz\Domain\Repository;

/*                                                                      
 *
 */

use Grandhotel\Hausnetz\Domain\Repository\Super\AbstractRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryInterface;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class UnitRepository extends AbstractRepository {

    
    public function getFields() {
        
        $fields = array(
            array(
                'name'      => 'Bezeichnung',
                'property'  =>  'title',
            ),
 
            array(
                'name'      =>  'Beschreibung',
                'property'  =>  'description'
            )
        );
        
        return $this->completeFields($fields);         
    }

        /**
     * @return TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listUnits(){
        return $this->listItems(
            'title',
            QueryInterface::ORDER_ASCENDING
        );
    }

}