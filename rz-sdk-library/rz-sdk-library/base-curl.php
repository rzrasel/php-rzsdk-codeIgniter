<?php
namespace RzSDK\Curl;
?>
<?php
class BaseCurl {
    public function curlSetup($url, $parameters) {
        $curl = curl_init($url);
    }
}
?>