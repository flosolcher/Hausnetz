<?php
namespace Grandhotel\Hausnetz\Command;

use Grandhotel\Hausnetz\Domain\Model\Announcement;
use Grandhotel\Hausnetz\Domain\Model\Container;
use Grandhotel\Hausnetz\Domain\Model\Event;
use Grandhotel\Hausnetz\Domain\Model\Group;
use Grandhotel\Hausnetz\Domain\Model\Contact;
use Grandhotel\Hausnetz\Domain\Model\User;
use Grandhotel\Hausnetz\Domain\Model\Note;
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
     * @var \Grandhotel\Hausnetz\Domain\Repository\NoteRepository
     */
    protected $noteRepository;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContainerRepository
     */
    protected $containerRepository;
    /**
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\ContactRepository
     */
    protected $contactRepository;
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
     * @Flow\Inject
     * @var \Grandhotel\Hausnetz\Domain\Repository\EventRepository
     */
    protected $eventRepository;

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


    protected function migrateUsers() {
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

    
    protected function migrateUserNotes() {
        $sql = 'SELECT id, notepad FROM users ORDER BY id';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            //echo "migrateUserNotes $id \n";
            $user = $this->userRepository->findByReferenceId($id);
            if ($user->count() != 0) {
                $user = $user->getFirst();
                $note = new Note();
                $note->setContent($row['notepad']);
                $note->setTitle('');
                $note->setUser($user);
                $this->noteRepository->add($note);
                //$user->setNotes();
            }
        }
        $this->persistenceManager->persistAll();
    }

    protected function migrateContacts() {
        $sql = 'SELECT * FROM adrbook ORDER BY id';
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $item = $this->contactRepository->findByReferenceId($id);
            if ($item->count() === 0) {
                $item = new Contact();
                $create = TRUE;
            } else {
                $create = FALSE;
                $item = $item->getFirst();
            }
            $item->setActive((bool) $row['vis']);
            //$item->setReferenceId($id);
            $item->setLastname($row['fam_name']);
            $item->setFirstname($row['chr_name']);
            $item->setCompany($row['company']);
            $item->setStr2($row['str2']);
            $item->setStr1($row['str1']);
            $item->setZip($row['zip']);
            $item->setCity($row['city']);
            $item->setPhone($row['phone']);
            $item->setFax($row['fax']);
            $item->setCellphone($row['cellphone']);
            $item->setEmail($row['email']);
            $item->setWebsite($row['website']);
            $item->setFacebook($row['facebook']);
            $item->setTwitter($row['twitter']);
            $item->setComment($row['memo']);
//            $item->set($row['']);
            
            if ($create) {
                $this->contactRepository->add($item);
            } else {
                $this->contactRepository->update($item);
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

    protected function migrateAnnouncements() {
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

    protected function migrateGroups()  {
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

    public function migrateGroupUsers() {
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

    public function migrateEvents() {
        $sql = 'SELECT * FROM calendar';
        $result = $this->getConnection()->query($sql);
        $md5Array = array();
        while ($row = $result->fetch_assoc()) {
            if ($row['title'] && $row['date'] != '0000-00-00') {
                $check = $row;
                unset($check['id']);
                unset($check['du']);
                unset($check['ic']);
                $md5 = md5(serialize($check));

                if (!in_array($md5, $md5Array)) { //dup handling
                    $md5Array[] = $md5;
                    $id = $row['id'];
                    $event = $this->eventRepository->findByReferenceId($id);
                    if ($event->count() === 0) {
                        $event = new Event();
                        $create = TRUE;
                    } else {
                        $create = FALSE;
                        $event = $event->getFirst();
                    }
                    $event->setActive(TRUE);
                    $event->setTitle($row['title']);
                    $event->setDescription($row['descr']);
                    $event->setLocation($row['location']);
                    $event->setPublicAudience( ($row['public_audience']=='no') ? false : true );
                    $event->setWholeDay((bool)$row['whole_day']);
                    $event->setReferenceId($id);
                    $format = 'Y-m-d H:i:s';
                    $recurringFormat = 'Y-m-d';
                    //$startDate = \DateTime::createFromFormat($format, $row['start_date'] . ' ' . $row['start_time']);
                    $startDate = \DateTime::createFromFormat($format, $row['date'] . ' ' . $row['start_time']);
                    $event->setStartDate($startDate);


                    $endDate = \DateTime::createFromFormat($format, $row['end_date'] . ' ' . $row['end_time']);
                    $endDate = clone $startDate; //fix weil nicht gepflegt
                    $event->setEndDate($endDate);

                    //$startDate = \DateTime::createFromFormat($format, $row['start_date'] . ' ' . $row['start_time']);


                    if ($row['start_date'] != '0000-00-00') {
                        $recurringStartDate = \DateTime::createFromFormat($recurringFormat, $row['start_date']);
                        $event->setRecurringStartDate($recurringStartDate);
                    }

                    if ($row['end_date'] != '0000-00-00') {
                        $recurringEndDate = \DateTime::createFromFormat($recurringFormat, $row['end_date']);
                        $event->setRecurringEndDate($recurringEndDate);
                    }

                    $changeDate = new \DateTime();
                    $changeDate->setTimestamp($row['du']);
                    $event->setChangeDate($changeDate);
                    $createDate = new \DateTime();
                    $createDate->setTimestamp($row['dc']);
                    $event->setCreateDate($createDate);

                    $event->setRecurringType($row['rpt_type']);

                    if ($row['user_id'] != 0) {
                        $user = $this->userRepository->findByReferenceId($row['user_id']);
                        if ($user->count() !== 0) {
                            $user = $user->getFirst();
                            $event->setChangeUser($user);
                            $event->setCreateUser($user);
                        }
                    }

                    if ($row['container_id'] != 0) {
                        $container = $this->containerRepository->findByReferenceId($row['container_id']);
                        if ($container->count() !== 0) {
                            $container = $container->getFirst();
                            $event->setContainer($container);
                        }
                    }

                    if ($create) {
                        $this->eventRepository->add($event);
                    } else {
                        $this->eventRepository->update($event);
                    }
                }
            }
        }
        $this->persistenceManager->persistAll();
    }

    public function databaseCommand() {
       /*
        $this->migrateUsers();
        $this->migrateGroups();
        $this->migrateGroupUsers();
        $this->migrateContainers();
        //$this->migrateAnnouncements();
        $this->migrateEvents();
         */
       
       /*
        echo "migrating users \n";
        $this->migrateUsers();
        echo "migrating users notes \n";
        $this->migrateUserNotes();
        echo "migrating groups \n";
        $this->migrateGroups();
        echo "migrating user groups \n";
        $this->migrateGroupUsers();
        echo "migrating container \n";
        $this->migrateContainer();
        * 
        */
        //echo "migrating announcement \n";
        //$this->migrateAnnouncements();
        echo "migrating events \n";
        $this->migrateEvents();
        echo "migrating contacts \n";
        $this->migrateContacts();

    }

}