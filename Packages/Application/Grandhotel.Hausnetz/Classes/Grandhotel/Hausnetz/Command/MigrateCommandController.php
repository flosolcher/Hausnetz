<?php
namespace Grandhotel\Hausnetz\Command;

use Grandhotel\Hausnetz\Domain\Model\Container;
use Grandhotel\Hausnetz\Domain\Model\User;
use TYPO3\Flow\Annotations as Flow;

class MigrateCommandController extends \TYPO3\Flow\Cli\CommandController {
    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\UserRepository
     */
    protected $userRepository;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContainerRepository
     */
    protected $containerRepository;
    /**
     * @var string
     * @Flow\Inject(setting="Migrate.Database")
     */
    protected $migrateDatabase;

    private $connection = NULL;

    protected function getConnection() {
        if ($this->connection == NULL) {
            $this->connection = new \mysqli($this->migrateDatabase['Host'], $this->migrateDatabase['User'], $this->migrateDatabase['Password'], $this->migrateDatabase['Database']);
        }
        return $this->connection;
    }


    protected function migrateUser() {
        $sql = 'SELECT * FROM users';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $user = $this->userRepository->findByReferenceId($id);
            if ($user->count() === 0) {
                $user = new User();
                $create = TRUE;
            } else {
                $create = FALSE;
                $user = $user->getFirst();
            }
            $user->setReferenceId($id);
            $user->setEmail($row['email']);
            $user->setUserName($row['username']);
            $user->setActive((bool) $row['is_active']);
            $exploded = explode(' ', $row['realname']);
            $firstName = $exploded[0];
            $lastName = isset($exploded[1]) ? $exploded[1] : '';
            if ($lastName == '') $lastName = '...';
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setPassword($row['md5pass']);
            $role = $row['is_admin'] ? 'admin' : 'user';
            $user->setRole($role);
            $user->setPhone($row['phone']);
            if ($create) {
                $this->userRepository->add($user);
            } else {
                $this->userRepository->update($user);
            }
        }
        $this->persistenceManager->persistAll();
    }

    protected function migrateContainer() {
        $sql = 'SELECT * FROM containers';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $container = $this->containerRepository->findByReferenceId($id);
            if ($container->count() === 0) {
                $container = new Container();
                $create = TRUE;
            } else {
                $create = FALSE;
                $container = $container->getFirst();
            }
            $container->setActive((bool) $row['active']);
            $container->setTitle($row['title']);
            $container->setReferenceId($id);
            $container->getDescription($row['descr']);
            $container->setColor($row['color']);
            if ($create) {
                $this->containerRepository->add($container);
            } else {
                $this->containerRepository->update($container);
            }
        }
        $this->persistenceManager->persistAll();
    }

    public function databaseCommand() {
        $this->migrateUser();
        $this->migrateContainer();
    }
}