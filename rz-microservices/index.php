<?php
require_once("include.php");
?>
<?php

use RzSDK\Import\DebugLog;
use RzSDK\URL\SiteUrl;
use RzSDK\User\Registration\CurlUserRegistration;
use RzSDK\User\Login\CurlUserLogin;

use function RzSDK\Import\logPrint;

?>
<?php
/* echo "getFullUrl() " . SiteUrl::getFullUrl();
echo "<br />";
echo "getUrlOnly() " . SiteUrl::getUrlOnly();
echo "<br />";
echo "getBaseUrl() " . SiteUrl::getBaseUrl();
echo "<br />";
echo "<br />"; */
//$curlUserRegistration = new CurlUserRegistration(SiteUrl::getBaseUrl());
?>
<?php
$curlUserLogin = new CurlUserLogin(SiteUrl::getBaseUrl());
?>
<?php
echo "<br />";
echo $_SERVER["PHP_SELF"];
echo "<br />";
echo dirname($_SERVER["PHP_SELF"]);
echo "<br />";
?>
<div style="margin: auto; width: 50%; border: 1px solid green; padding: 10px; border-radius: 10px;">
    <br />
    <br />
    <!-- <a href="<?= dirname($_SERVER["PHP_SELF"]) ?>/user-registration.php">User Registration</a> -->
    <a href="<?= ROOT_URL; ?>">Laptop User Registration</a>
    <br />
    <br />
    <a href="http://localhost/php-rzsdk-codeigniter/rz-microservices/user-registration/user-registration.php">Desktop User Registration Process</a>
    <br />
    <br />
    <br />
    <br />
    <a href="http://localhost/php-rzsdk-codeigniter/rz-microservices/user-registration/user-registration.php">Desktop User Registration</a>
</div>