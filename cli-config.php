<?php

require_once 'Packages/Libraries/doctrine/orm/lib/Doctrine/ORM/Tools/Console/ConsoleRunner.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'Packages/Framework/TYPO3.Flow/Classes/TYPO3/Flow/Core/Bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = GetEntityManager();

