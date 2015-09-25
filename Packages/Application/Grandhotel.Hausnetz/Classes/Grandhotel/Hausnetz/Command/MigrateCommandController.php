<?php
namespace Grandhotel\Hausnetz\Command;

use Grandhotel\Hausnetz\Domain\Model\Announcement;
use Grandhotel\Hausnetz\Domain\Model\Container;
use Grandhotel\Hausnetz\Domain\Model\Group;
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
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\AnnouncementRepository
     */
    protected $announcementRepository;

    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\GroupRepository
     */
    protected $groupRepository;

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
        $sql = 'SELECT * FROM users ORDER BY id';
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
        $sql = 'SELECT * FROM containers ORDER BY id';
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

    protected function migrateAnnouncement() {
        $sql = 'SELECT * FROM news ORDER BY id';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $announcement = $this->announcementRepository->findByReferenceId($id);
            if ($announcement->count() === 0) {
                $announcement = new Announcement();
                $create = TRUE;
            } else {
                $create = FALSE;
                $announcement = $announcement->getFirst();
            }
            $announcement->setReferenceId($id);
            $announcement->setMessage($row['message']);
            $changeDate = new \DateTime();
            $changeDate->setTimestamp($row['du']);
            $announcement->setChangeDate($changeDate);
            $createDate = new \DateTime();
            $createDate->setTimestamp($row['dc']);
            $announcement->setCreateDate($createDate);
            $announcement->setSortDate($createDate);
            if ($row['container_id'] != 0) {
                $container = $this->containerRepository->findByReferenceId($row['container_id']);
                if ($container->count() !== 0) {
                    $container = $container->getFirst();
                    $announcement->setContainer($container);
                }
            }

            if ($row['user_id'] != 0) {
                $user = $this->userRepository->findByReferenceId($row['user_id']);
                if ($user->count() !== 0) {
                    $user = $user->getFirst();
                    $announcement->setChangeUser($user);
                    $announcement->setCreateUser($user);
                }
            }

            if ($row['replyto'] != 0) {
                $_announcement = $this->announcementRepository->findByReferenceId($row['replyto']);
                if ($_announcement->count() !== 0) {
                    $_announcement = $_announcement->getFirst();
                    $announcement->setAnnouncement($_announcement);
                    if ($_announcement->getSortDate() < $announcement->getSortDate()) {
                        $_announcement->setSortDate($announcement->getSortDate());
                        $this->announcementRepository->update($_announcement, FALSE);
                    }

                }
            }

            $announcement->setActive(TRUE);

            if ($create) {
                $this->announcementRepository->add($announcement);
            } else {
                $this->announcementRepository->update($announcement, FALSE);
            }
            $this->persistenceManager->persistAll();
        }
    }

    protected function migrateGroup()  {
        $sql = 'SELECT * FROM groups ORDER BY id';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $group = $this->groupRepository->findByReferenceId($id);
            if ($group->count() === 0) {
                $group = new Group();
                $create = TRUE;
            } else {
                $create = FALSE;
                $group = $group->getFirst();
            }
            $group->setActive(TRUE);
            $group->setName($row['name']);
            $group->setDeny($row['deny']);
            $group->setPermissions($row['permissions']);
            $group->setReferenceId($id);
            if ($create) {
                $this->groupRepository->add($group);
            } else {
                $this->groupRepository->update($group);
            }
        }
        $this->persistenceManager->persistAll();
    }

    public function migrateGroupUser() {
        $sql = 'SELECT * FROM usergroups';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $groupId = $row['group_id'];
            $group = $this->groupRepository->findByReferenceId($groupId);
            if ($group->count() === 0) {
                //skip
            } else {
                $group = $group->getFirst();
                $userId = $row['user_id'];
                $user = $this->userRepository->findByReferenceId($userId);
                if ($user->count() === 0) {
                    //skip
                } else {
                    $user = $user->getFirst();
                    $group->addUser($user);
                    $this->groupRepository->update($group);
                }
            }
        }
        $this->persistenceManager->persistAll();
    }

    public function databaseCommand() {
        $this->migrateUser();
        $this->migrateGroup();
        $this->migrateGroupUser();
        $this->migrateContainer();
        $this->migrateAnnouncement();

    }






}