<?php
namespace RzSDK\Curl;
?>
<?php
class BaseCurl {
    public $url = null;
    private $curl = null;
    protected $options = [];
    protected $userSetOptions = [];

    public $curlError = false;
    public $curlErrorCode = 0;
    public $curlErrorMessage = null;

    public $response = null;
    public $rawResponse = null;

    public function __construct($baseUrl = null, $options = []) {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }
        $this->curl = curl_init();
        $this->initialize($baseUrl, $options);
    }

    private function initialize($base_url = null, $options = []) {
        if (isset($options)) {
            $this->setOpts($options);
        }

        $this->setOptInternal(CURLOPT_RETURNTRANSFER, true);

        if ($base_url !== null) {
            $this->setUrl($base_url);
        }
    }

    public function setUrl($url, $mixed_data = "") {
        $this->url = $url;
        $this->setOpt(CURLOPT_URL, $this->url);
    }

    protected function setOptInternal($option, $value) {
        $success = curl_setopt($this->curl, $option, $value);
        if ($success) {
            $this->options[$option] = $value;
        }
        return $success;
    }

    public function setOpt($option, $value) {
        $success = curl_setopt($this->curl, $option, $value);
        if ($success) {
            $this->options[$option] = $value;
            $this->userSetOptions[$option] = $value;
        }
        return $success;
    }

    public function setOpts($options) {
        if (!count($options)) {
            return true;
        }
        foreach ($options as $option => $value) {
            if (!$this->setOpt($option, $value)) {
                return false;
            }
        }
        return true;
    }

    public function exec($ch = null) {
        $this->rawResponse = curl_exec($this->curl);
        $this->curlErrorCode = curl_errno($this->curl);
        $this->curlErrorMessage = curl_error($this->curl);
        $this->curlError = $this->curlErrorCode !== 0;
        if ($this->curlError) {
            $curl_error_message = curl_strerror($this->curlErrorCode);

            /* if ($this->curlErrorCodeConstant !== '') {
                $curl_error_message .= ' (' . $this->curlErrorCodeConstant . ')';
            } */

            if (!empty($this->curlErrorMessage)) {
                $curl_error_message .= ': ' . $this->curlErrorMessage;
            }

            $this->curlErrorMessage = $curl_error_message;
        }

        //$this->response = $this->parseResponse($this->responseHeaders, $this->rawResponse);
        $this->response = $this->rawResponse;
        //$this->unsetHeader('Content-Length');
        $this->setOptInternal(CURLOPT_NOBODY, false);
    }

    public function head($url, $data = []) {
        if (is_array($url)) {
            $data = $url;
            $url = (string)$this->url;
        }
        $this->setUrl($url, $data);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, 'HEAD');
        $this->setOpt(CURLOPT_NOBODY, true);
        return $this->exec();
    }

    public function get($url, $data = []) {
        $this->setUrl($url, $data);
        $this->setOptInternal(CURLOPT_CUSTOMREQUEST, "GET");
        $this->setOptInternal(CURLOPT_HTTPGET, true);
        return $this->exec();
    }

    public function options($url, $data = []) {
        if (is_array($url)) {
            $data = $url;
            $url = (string)$this->url;
        }
        $this->setUrl($url, $data);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "OPTIONS");
        return $this->exec();
    }

    public function patch($url, $data = []) {
        if (is_array($url)) {
            $data = $url;
            $url = (string)$this->url;
        }

        /* if (is_array($data) && empty($data)) {
            $this->removeHeader('Content-Length');
        } */

        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "PATCH");
        //$this->setOpt(CURLOPT_POSTFIELDS, $this->buildPostData($data));
        $this->setOpt(CURLOPT_POSTFIELDS, http_build_query($data));
        return $this->exec();
    }

    public function post($url, $data = "", $follow_303_with_post = false) {
        if (is_array($url)) {
            $follow_303_with_post = (bool)$data;
            $data = $url;
            $url = (string)$this->url;
        }

        $this->setUrl($url);

        // Set the request method to "POST" when following a 303 redirect with
        // an additional POST request is desired. This is equivalent to setting
        // the -X, --request command line option where curl won't change the
        // request method according to the HTTP 30x response code.
        if ($follow_303_with_post) {
            $this->setOpt(CURLOPT_CUSTOMREQUEST, "POST");
        } elseif (isset($this->options[CURLOPT_CUSTOMREQUEST])) {
            // Unset the CURLOPT_CUSTOMREQUEST option so that curl does not use
            // a POST request after a post/redirect/get redirection. Without
            // this, curl will use the method string specified for all requests.
            $this->setOpt(CURLOPT_CUSTOMREQUEST, null);
        }

        $this->setOpt(CURLOPT_POST, true);
        //$this->setOpt(CURLOPT_POSTFIELDS, $this->buildPostData($data));
        $this->setOpt(CURLOPT_POSTFIELDS, http_build_query($data));
        return $this->exec();
    }

    public function put($url, $data = []) {
        if (is_array($url)) {
            $data = $url;
            $url = (string)$this->url;
        }
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "PUT");
        //$put_data = $this->buildPostData($data);
        $put_data = http_build_query($data);
        /* if (empty($this->options[CURLOPT_INFILE]) && empty($this->options[CURLOPT_INFILESIZE])) {
            if (is_string($put_data)) {
                $this->setHeader('Content-Length', strlen($put_data));
            }
        } */
        if (!empty($put_data)) {
            $this->setOpt(CURLOPT_POSTFIELDS, $put_data);
        }
        return $this->exec();
    }

    public function close() {
        if (is_resource($this->curl) || $this->curl instanceof \CurlHandle) {
            curl_close($this->curl);
        }
        $this->curl = null;
        $this->options = null;
        $this->userSetOptions = null;
        /* $this->jsonDecoder = null;
        $this->jsonDecoderArgs = null;
        $this->xmlDecoder = null;
        $this->xmlDecoderArgs = null;
        $this->headerCallbackData = null;
        $this->defaultDecoder = null; */
    }

    public function curlSetup($url, $parameters) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://stackoverflow.com/questions/17230246/php-curl-get-request-and-requests-body");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        /* curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields)); */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        //curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:11.0) Gecko/20100101 Firefox/11.0");
        //curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $errno = curl_errno($curl);
        curl_close($curl);
        echo $response . " error " . $error . " error no " . $errno;
    }

    public function reset() {
        if (is_resource($this->curl) || $this->curl instanceof \CurlHandle) {
            curl_reset($this->curl);
        } else {
            $this->curl = curl_init();
        }

        /* $this->setDefaultUserAgentInternal();
        $this->setDefaultTimeoutInternal();
        $this->setDefaultHeaderOutInternal(); */

        $this->initialize();
    }
}
?>
<?php
/* $baseCurl = new BaseCurl();
// $baseCurl->curlSetup("", "");
$baseCurl->get("https://stackoverflow.com/questions/17230246/php-curl-get-request-and-requests-body");
echo $baseCurl->response; */
?>