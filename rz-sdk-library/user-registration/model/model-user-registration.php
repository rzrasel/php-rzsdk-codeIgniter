<?php
namespace RzSDK\Model\User\Registration;
require_once("enum-user-registration.php");
use RzSdk\Model\User\Registration\UserRegistrationEnum;

class UserRegistrationModel {
    public $table = "user_registration";
    public $userId = "user_id";
    public $createdDate = "created_date";
    public $modifiedDate = "modified_date";
    public UserRegistrationEnum $userRegistrationEnum;
}