<?php
namespace RzSDK\Response;
?>
<?php
class Response {
    public $body;
    public Info $info;
    public $parameter;

    public function __construct($body = null, Info $info = new Info(null, InfoType::MESSAGE), $parameter = null) {
        $this->body = $body;
        $this->info = $info;
        $this->parameter = $parameter;
    }

    public function toJson() {
        return json_encode($this);
    }
}
?>
<?php
class Info {
    public $message;
    public $type;

    public function __construct($message, InfoType $infoType) {
        $this->message = $message;
        $this->type = $infoType->value;
    }
}
enum InfoType: string {
    case ALERT      = "alert";
    case ERROR      = "error";
    case MESSAGE    = "message";
    case SUCCESS    = "success";
    case WARNING    = "warning";
}
?>