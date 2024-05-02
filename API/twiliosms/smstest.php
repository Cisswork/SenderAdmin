<?php
// Install the library via PEAR or download the .zip file to your project folder.
// This line loads the library
$to_contact=$_REQUEST['to_contact'];    
$generate_otp="Your otp is".":".$_REQUEST['generate_otp'];
require('Services/Twilio.php');

$sid = "AC2f65161a652ff03bfd78eb8b5ddee39e"; // Your Account SID from www.twilio.com/user/account
$token = "b60f965b107a2b7c1f0b742b42f3daf2"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
$message = $client->account->messages->sendMessage(
  '+61 424 573 717', // From a valid Twilio number
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