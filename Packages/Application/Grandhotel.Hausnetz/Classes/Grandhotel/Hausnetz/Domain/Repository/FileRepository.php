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
class FileRepository extends AbstractRepository {

   /**
     * @var \Grandhotel\Hausnetz\Service\FileService
     * @Flow\Inject
     */
    protected $fileService;
    
    public function getTest() {
       return "test";
    }
    
    
}