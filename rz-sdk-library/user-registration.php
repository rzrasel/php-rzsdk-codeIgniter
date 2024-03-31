<?php
namespace RzSDK\User\Registration;
require_once("run-autoloader.php");
require_once("user-registration/user-registration.php");
?>
<?php
use \RzSDK\Model\User\Registration;
use \RzSDK\User\Registration\UserRegistrationProcess;
?>
<?php
class UserRegistration {
    public function __construct() {
        //
    }

    public function registrationByEmail($email, $password) {}
}
?>
<?php
$userRegistration = new UserRegistrationProcess("database/user-registration.sqlite");
$userRegistration->insert();
$items = $userRegistration->getData();
foreach($items as $item) {
    echo "{$item->userId} {$item->modifiedDate} {$item->createdDate}<br />";
}
?>
<!--



-->