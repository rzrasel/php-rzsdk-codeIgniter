<?php
require_once("run-autoloader.php");

//use RzSDK\Autoloader\RunAutoloader;
use RzSDK\UniqueIntId;

//new RunAutoloader(trim(trim(__DIR__, "/")));
$uniqueIntId = new UniqueIntId();
echo $uniqueIntId->getUserId();
?>
<?php
//echo $_SERVER["PHP_SELF"];
//echo dirname($_SERVER["PHP_SELF"]);
?>
<br />
<br />
<!-- <a href="<?= dirname($_SERVER["PHP_SELF"]) ?>/user-registration.php">User Registration</a> -->
<a href="http://localhost/php-rzsdk-codeigniter/rz-sdk-library/user-registration.php">User Registration</a>