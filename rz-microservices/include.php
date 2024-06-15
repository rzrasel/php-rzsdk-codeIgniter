<?php
namespace RzSDK\Import;
?>
<?php
$baseInclude = "rz-sdk-library/";
require_once($baseInclude . "curl/curl.php");
require_once($baseInclude . "response/response.php");
require_once($baseInclude . "utils/site-url.php");
require_once($baseInclude . "database/sqlite-connection.php");
?>
<?php
$baseInclude = "user/";
//require_once($baseInclude . "model/user-model.php");
?>
<?php
$baseInclude = "utils/";
require_once($baseInclude . "user-auth-type.php");
?>
<?php
$baseInclude = "";
require_once($baseInclude . "curl-user-registration.php");
require_once($baseInclude . "curl-user-login.php");
?>
<?php
use RzSDK\URL\SiteUrl;
?>
<?php
defined("ROOT_URL") or define("ROOT_URL", SiteUrl::getBaseUrl());
defined("DB_PATH") or define("DB_PATH", "database");
defined("DB_FILE") or define("DB_FILE", "user-database.sqlite");
?>
<?php
function logPrint($message) {
    echo "<br />";
    if(is_array($message)) {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
    } else {
        echo $message;
    }
    echo "<br />";
    //var_dump(debug_backtrace());
    /* echo "<pre>";
    print_r(debug_backtrace());
    echo "</pre>";
    echo "<br />"; */
}
class DebugLog {
    public static function log($message) {
        echo "<br />";
        echo "<pre style=\"overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; font-size: 12px;\">";
        //echo "<div style=\"margin: auto; width: 50%; border: 1px solid green; padding: 10px; border-radius: 10px;\">";
        echo "<div style=\"line-height: 16px; margin: auto; background: #4eaf51; color: #fdfdf9; border: 1px solid #3a833d; padding: 10px; border-radius: 10px;\">";
        //echo "<div style=\"margin: auto; background: #ef1e62; color: #fffbff; border: 1px solid #b2164b; padding: 10px; border-radius: 10px;\">";
        //echo "<div style=\"overflow-wrap: break-word; word-wrap: break-word; -ms-word-break: break-all; word-break: break-all; word-break: break-word; -ms-hyphens: auto; -moz-hyphens: auto; -webkit-hyphens: auto; hyphens: auto;\">";
        if(is_array($message)) {
            //echo "<pre>";
            print_r($message);
            //echo "</pre>";
        } else {
            echo $message;
        }
        echo "<br />";

        $debugBacktrace = debug_backtrace();
        $printData = "File " . $debugBacktrace[0]["file"];
        if(count($debugBacktrace) > 1) {
            $class = $debugBacktrace[1]["class"];
            $method = $debugBacktrace[1]["function"];
            $printData .= " class " . $class . " method " . $method;
        }
        $printData .= " on line " . $debugBacktrace[0]["line"];
        echo $printData;
        echo "</div>";
        //echo "</div>";
        echo "</pre>";
        echo "<br />";
    }
}
?>
