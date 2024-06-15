<?php
namespace RzSDK\User;
?>
<?php
enum UserAuthType: string {
    case EMAIL      = "email";
    case GOOGLE     = "google";
    case FACEBOOK   = "facebook";
}
?>
<?php
//https://github.com/php/php-src/issues/9352
//Retrieving an enum case by its name
function getUserAuthTypeByValue($value) {
    foreach (UserAuthType::cases() as $case) {
        /* if ($case->name === $enumName) {
            return $case;
        } */
        if ($case->value === $value) {
            return $case;
        }
    }
    return null;
}
?>