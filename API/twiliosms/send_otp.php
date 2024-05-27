<?php
include('config.php');
// Install the library via PEAR or download the .zip file to your project folder.
// This line loads the library
$appType = $_REQUEST['appType'];
$country_code=$_REQUEST['country_code']; 
$contact = $_REQUEST['contact'];
$to_contact=$country_code.''.$contact;
$randomid = mt_rand(100000,999999);
if($appType=='User')
{
    $fetch = mysqli_query($con, "SELECT * FROM `Senders`  WHERE `country_code`='$country_code' AND `Phone`='$contact'");
    $row = mysqli_fetch_assoc($fetch);
    $contact1 = $row['Phone'];
    $code1 = $row['country_code'];
    $id = $row['SenderID'];
    if ($country_code == $code1 && $contact==$contact1) 
    {
          $generate_otp="Your Sender OTP is"." ".$randomid;
          require('Services/Twilio.php');
        
         $sid = "ACda6ff39e53e672b37275301577c00153"; // Your Account SID from www.twilio.com/user/account
         $token = "71a0cb12e97e5f3ccc13d0c791ced430"; // Your Auth Token from www.twilio.com/user/account
        
        //$sid = "AC59c79c9e9b95ab1399dad955f7f9c1fb"; // Your Account SID from www.twilio.com/user/account
        //$token = "b1a378b9a5da75bcfbb9ccd1249c29cb"; // Your Auth Token from www.twilio.com/user/account
        
        $client = new Services_Twilio($sid, $token);
        $message = $client->account->messages->sendMessage(
          '+12054795765', // From a valid Twilio number
          // '+14048574192', // From a valid Twilio number
          $to_contact, // Text this number
          $generate_otp );
        if($message->sid)
        {
            $msg["result"] = "successfully"; 
            $msg['otp']="$randomid"; 
            $msg['user_id']="$id";
            
        }
        else
        {
           $msg["result"] = "unsuccess";
           $msg['otp'] = '';
        }
    }
    else
    { 
        $msg["result"] = 'Not Registered';
        $msg['otp'] = '';
    }
}
elseif($appType=='Driver')
{
    $fetch = mysqli_query($con, "SELECT * FROM `Drivers`  WHERE `country_code`='$country_code' AND `Phone`='$contact'");
    $row = mysqli_fetch_assoc($fetch);
    $contact1 = $row['Phone'];
    $code1 = $row['country_code'];
    $id = $row['DriverID'];
    if ($country_code == $code1 && $contact==$contact1) 
    {
          $generate_otp="Your Sender Driver OTP is"." ".$randomid;
        require('Services/Twilio.php');
        
         $sid = "ACda6ff39e53e672b37275301577c00153"; // Your Account SID from www.twilio.com/user/account
         $token = "71a0cb12e97e5f3ccc13d0c791ced430"; // Your Auth Token from www.twilio.com/user/account
        
        //$sid = "AC59c79c9e9b95ab1399dad955f7f9c1fb"; // Your Account SID from www.twilio.com/user/account
        //$token = "b1a378b9a5da75bcfbb9ccd1249c29cb"; // Your Auth Token from www.twilio.com/user/account
        
        $client = new Services_Twilio($sid, $token);
        $message = $client->account->messages->sendMessage(
         '+12054795765', // From a valid Twilio number
         //  '+14048574192', // From a valid Twilio number
          $to_contact, // Text this number
          $generate_otp
          
        );
        if($message->sid)
        {
            $msg["result"] = "successfully"; 
            $msg['otp']="$randomid";
            $msg['driver_id']="$id";
        }
        else
        {
            $msg["result"] = "unsuccess"; 
            $msg['otp'] = '';
        }
    }
    else
    { 
        $msg["result"] = 'Not Registered';
        $msg['otp'] = '';
    }
}
echo json_encode($msg);
?>