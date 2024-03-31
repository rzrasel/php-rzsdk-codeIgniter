<?php
namespace RzSDK\User\Registration;
?>
<?php
require_once("model/model-user-registration.php");
?>
<?php
use RzSDK\Database\SqliteConnection;
use RzSDK\UniqueIntId;
use RzSDK\Model\User\Registration\UserRegistrationModel;
use RzSDK\Model\User\Registration\UserRegistrationEnum;
?>
<?php
class UserRegistration {
    private SqliteConnection $sqliteConnection;
    private UniqueIntId $uniqueIntId;
    private UserRegistrationModel $userRegistrationModel;

    public function __construct(string $dbPath) {
        $this->sqliteConnection = new SqliteConnection($dbPath);
        $this->uniqueIntId = new UniqueIntId();
        $this->userRegistrationModel = new UserRegistrationModel();
    }

    public function getData(): array {
        $sqlQuery = $this->selectSql();
        $dbResult = $this->sqliteConnection->query($sqlQuery);

        $items = array();
        if($dbResult != null) {
            foreach($dbResult as $row) {
                $userRegistration = new UserRegistrationModel();
                $userRegistration->userId = $row[UserRegistrationEnum::REGI_ID->value];
                $userRegistration->createdDate = $row[UserRegistrationEnum::CREATE_DATE->value];
                $userRegistration->modifiedDate = $row[UserRegistrationEnum::MODIFIED_DATE->value];
                $items[] = $userRegistration;
            }
        }

        return $items;
    }
    public function insert() {
        $sqlQuery = $this->insertSql();
        $this->sqliteConnection->query($sqlQuery);
        //echo $this->userRegistrationModel->userRegistrationEnum::createdDate->name;
    }

    public function insertSql(): string {
        return "INSERT INTO {$this->userRegistrationModel->table} VALUES("
            . "'" . $this->uniqueIntId->getUserId() . "',"
            . " '" . date("Y-m-d H:i:s") . "',"
            . " '" . date("Y-m-d H:i:s") . "'"
            . ");";
    }

    public function selectSql(): string {
        return "SELECT * FROM {$this->userRegistrationModel->table}"
            . ";";
    }
}
?>