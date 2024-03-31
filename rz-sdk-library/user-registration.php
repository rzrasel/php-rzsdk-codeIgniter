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
user-registration
user_registration

DROP TABLE IF EXISTS user_registration;

CREATE TABLE IF NOT EXISTS user_registration (
    user_id         BIGINT(20) NOT NULL,
    created_date    DATETIME NOT NULL,
    modified_date   DATETIME NOT NULL,
    CONSTRAINT pk_user_registration_user_id PRIMARY KEY (user_id)
);

https://www.facebook.com/reel/971549021305245
https://www.facebook.com/reel/955959129506553

*/
?>