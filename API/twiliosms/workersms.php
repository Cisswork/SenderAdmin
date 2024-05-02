<?php
// Install the library via PEAR or download the .zip file to your project folder.
// This line loads the library
$to_contact=$_REQUEST['to_contact'];    
$generate_otp="Your otp is".":".$_REQUEST['generate_otp'];
require('Services/Twilio.php');

$sid = "ACdaaf27154df9c345bdb0b262548c96ee"; // Your Account SID from www.twilio.com/user/account
$token = "4b05288ddc37d9e877e3306713eca6a7"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
$message = $client->account->messages->sendMessage(
  '+44 7481 338697', // From a valid Twilio number
  $to_contact, // Text this number
  $generate_otp
  
);
if($message->sid)
{
    $msg["result"] = "successfully"; 
}
else
{
 $msg["result"] = "unsuccess"; 
}
echo json_encode($msg);
?>