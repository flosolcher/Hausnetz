<?php
namespace Grandhotel\Hausnetz\Command;

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
        while ($userRow = $result->fetch_assoc()) {
            $id = $userRow['id'];
            $user = $this->userRepository->findByReferenceId($id);
            if ($user->count() === 0) {
                $user = new User();
                $create = TRUE;
            } else {
                $create = FALSE;
                $user = $user->getFirst();
            }
            $user->setReferenceId($id);
            $user->setEmail($userRow['email']);
            $user->setUserName($userRow['username']);
            $user->setActive((bool) $userRow['is_active']);
            $exploded = explode(' ', $userRow['realname']);
            $firstName = $exploded[0];
            $lastName = isset($exploded[1]) ? $exploded[1] : '';
            if ($lastName == '') $lastName = '...';
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setPassword($userRow['md5pass']);
            $role = $userRow['is_admin'] ? 'admin' : 'user';
            $user->setRole($role);
            $user->setPhone($userRow['phone']);
            if ($create) {
                $this->userRepository->add($user);
            } else {
                $this->userRepository->update($user);
            }
        }
        $this->persistenceManager->persistAll();
    }

    public function databaseCommand() {
        $this->migrateUser();
    }
}