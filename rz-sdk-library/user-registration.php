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
DROP TABLE IF EXISTS enrollment_type;

CREATE TABLE IF NOT EXISTS enrollment_type (
    enrollment_id       BIGINT(20) NOT NULL,
    enrollment_type     TEXT NOT NULL,
    CONSTRAINT pk_enrollment_type_enrollment_id PRIMARY KEY (enrollment_id),
    CONSTRAINT uk_enrollment_type_enrollment_type UNIQUE (enrollment_type)
);

INSERT INTO enrollment_type VALUES("171182948560812938", "registered");
INSERT INTO enrollment_type VALUES("171187607072497731", "loggined");

DROP TABLE IF EXISTS user_registration;

CREATE TABLE IF NOT EXISTS user_registration (
    user_regi_id    BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_registration_user_regi_id PRIMARY KEY (user_regi_id)
);

DROP TABLE IF EXISTS user_identity;

CREATE TABLE IF NOT EXISTS user_identity (
    user_regi_id            BIGINT(20) NOT NULL,
    enrollment_id           BIGINT(20) NOT NULL,
    user_identity_id        BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_identity_user_identity_id PRIMARY KEY (user_identity_id),
    FOREIGN KEY (user_regi_id) REFERENCES user_registration(user_regi_id),
    FOREIGN KEY (enrollment_id) REFERENCES enrollment_type(enrollment_id)
);



*/
?>
<?php
/*

https://www.facebook.com/reel/971549021305245
https://www.facebook.com/reel/955959129506553

*/
?>