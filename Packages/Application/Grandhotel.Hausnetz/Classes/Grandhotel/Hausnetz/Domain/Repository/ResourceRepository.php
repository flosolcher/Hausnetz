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
class ResourceRepository extends AbstractRepository {

    
    public function getFields() {
        
        $fields = array(
            array(
                'name'      => 'Bezeichnung',
                'property'  =>  'title',
            ),
            array(
                'name'      => 'Einheit',
                'property'  => 'unit'
            ),
            array(
                'name'      =>  'Bemerkung',
                'property'  =>  'comment'
            )
        );
        
        return $fields;         
    }

        /**
     * @return TYPO3\Flow\Persistence\QueryResultInterface
     */
    public function listResources(){
        return $this->listItems(
            'content',
            QueryInterface::ORDER_ASCENDING
        );
    }

}