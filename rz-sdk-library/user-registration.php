<?php
require_once("run-autoloader.php");
require_once("user-registration/user-registration.php");
use RzSDK\Model\User\Registration;
use RzSDK\User\Registration\UserRegistration;
?>
<?php
$userRegistration = new UserRegistration("database/user-registration.sqlite");
$userRegistration->insert();
$items = $userRegistration->getData();
foreach($items as $item) {
    echo "{$item->userId} {$item->modifiedDate} {$item->createdDate}<br />";
}
?>
<?php
/*
*/
?>