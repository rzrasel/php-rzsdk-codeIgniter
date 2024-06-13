<?php
require_once("../include.php");
require_once("include.php");
?>
<?php
use RzSDK\Curl\Curl;
use RzSDK\Response\Response;
use RzSDK\Response\Info;
use RzSDK\Response\InfoType;
use RzSDK\Model\User\Registration\UserRegistrationRequestModel;
use RzSDK\User\Registration\UserRegistrationRegexValidation;

use function RzSDK\Import\logPrint;

?>
<?php
class UserRegistration {
    public function __construct() {
        $this->execute();
    }

    public function execute() {
        if(!empty($_POST)) {
            $userRegiRequestModel = new UserRegistrationRequestModel();
            $userRegiRequestModel->agentType = $_POST[$userRegiRequestModel->agentType];
            $userRegiRequestModel->authType = $_POST[$userRegiRequestModel->authType];
            $userRegiRequestModel->deviceType = $_POST[$userRegiRequestModel->deviceType];
            $userRegiRequestModel->email = $_POST[$userRegiRequestModel->email];
            $userRegiRequestModel->password = $_POST[$userRegiRequestModel->password];
            
            if(!$this->regexValidation($userRegiRequestModel)) {
                return;
            }
            $this->getDbUser($userRegiRequestModel);
            return;
            $this->response(null, new Info("Successful registration completed", InfoType::SUCCESS), $_POST);
        }
    }

    private function regexValidation(UserRegistrationRequestModel $userRegiRequestModel) {
        $userRegistrationRegexValidation = new UserRegistrationRegexValidation();
        return $userRegistrationRegexValidation->execute($userRegiRequestModel);
    }

    private function getDbUser(UserRegistrationRequestModel $userRegiRequestModel) {
        $url = dirname(ROOT_URL) . "/user/user.php";
        $dataModel = $userRegiRequestModel->toArrayKeyMapping($userRegiRequestModel);
        //
        $curl = new Curl($url);
        $result = $curl->exec(true, $dataModel) . "";
        $result = json_decode($result, true);
        logPrint($result);
    }

    private function response($body, Info $info, $parameter = null) {
        $response = new Response();
        $response->body         = $body;
        $response->info         = $info;
        $response->parameter    = $parameter;
        echo $response->toJson();
    }
}
?>
<?php
$userRegistration = new UserRegistration();
?>
