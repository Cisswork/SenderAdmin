<?php
 
/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Push {
 
    // push message title
    private $title;
    private $message;
   //private $message1;
    private $type;
    private $call_type;
    private $ctoken;
    private $channelId;
    private $sender_id;
    private $reciver_id;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
    public function setMessage1($message1) {
        $this->message1 = $message1;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function setCallType($call_type) {
        $this->call_type = $call_type;
    }
    
    public function setCtoken($ctoken) {
        $this->ctoken = $ctoken;
    }
    
    public function setChannelid($channelId) {
        $this->channelId = $channelId;
    }
    
    public function setSenderid($sender_id) {
        $this->sender_id = $sender_id;
    }
    
    public function setReciverid($reciver_id) {
        $this->reciver_id = $reciver_id;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
        //$res['data']['message1'] = $this->message1;
        $res['data']['type'] = $this->type;
        $res['data']['call_type'] = $this->call_type;
        $res['data']['ctoken'] = $this->ctoken;
        $res['data']['channelId'] = $this->channelId;
        $res['data']['sender_id'] = $this->sender_id;
        $res['data']['reciver_id'] = $this->reciver_id;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }
 
}?>