<?php 

    include('config.php');
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d h:i:s');
    $route_id_list = $_REQUEST['route_id_list'];
    $UserName=$_REQUEST['UserName'];
    $FirstName=$_REQUEST['FirstName'];
    $LastName=$_REQUEST['LastName'];
    $Address =$_REQUEST['Address'];
    $Address2=$_REQUEST['Address2'];
    $City=$_REQUEST['City'];
    $Email=$_REQUEST['Email'];
    $Password=$_REQUEST['Password'];
    
    $State=$_REQUEST['State'];
    $lng=$_REQUEST['longitude'];
    $lat=$_REQUEST['latitude'];
    $Zip = $_REQUEST['Zip'];
    $LicenseNum=$_REQUEST['LicenseNum'];
    $country_code = $_REQUEST['country_code'];
    $Phone=$_REQUEST['Phone'];
    $Phone2=$_REQUEST['Phone2'];  
    $Phone3=$_REQUEST['Phone3'];
    $flag = $_REQUEST['flag'];
    
    $filename=$_FILES['license_image']['name'];
    $tmpname=$_FILES["license_image"]["tmp_name"];
    $ext=substr($filename,strpos($filename,"."));
    $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
    $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
    if(move_uploaded_file($tmpname,"images/$finame"));
    
    $sql=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `Phone`='$Phone'");
    $row=mysqli_num_rows($sql);
    
    $sql1=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `Email`='$Email'");
    $row1=mysqli_num_rows($sql1);
    
    if($row>0)
    {
        $message['result']="Contact Already Exist";
        echo json_encode($message);
    }
    elseif($row1>0)
    {
        $message['result']="Email Already Exist";
        echo json_encode($message);
    }
    else
    { 
        $ins=mysqli_query($con,"INSERT INTO `Drivers`(`UserName`, `Password`, `FirstName`, `LastName`, `Address`, `Address2`, `City`, `State`, `Zip`, `Driver_lat`, `Driver_lng`, `Email`, `country_code`, `Phone`, `Phone2`, `Phone3`, `OptIn`, `Status`, `NotifyType`, `Notes`, `InternalNote`, `LicenseNum`, `LicensePic`, `image`, `Driver_device_id`, `iosDriver_device_id`, `device_status`, `wallet_balance`, `login_status`, `date`, `logout_time`, `login_device_key`, `access_token`, `last_login_time`, `zipcode_list`, `package_list`, `flag`)
                                            VALUES ('$UserName','$Password','$FirstName','$LastName','$Address','$Address2','$City','$State','$Zip','$lat','$lng','$Email','$country_code','$Phone','$Phone2','$Phone3','','0','','','','$LicenseNum','$finame','','','','','0','0','$date','','','','','$route_id_list','','$flag')");
        //die(mysqli_error($con));
        $insert_id=mysqli_insert_id($con);
        if($insert_id==0)
        {
            $message['result']="unsuccess";
        }
        else
        {
            $message['id']=$insert_id;
            $message['result']="successfully";
            $to_email = $Email;
            $subject = 'Welcome to Sender App';
            $txt ="Hello $FirstName $LastName "."\r\n";
            $txt.="Thank you for registering with us."."\r\n";
            $txt.="Please here are your login details below. "."\r\n";
            $txt.="UserName : $UserName"."\r\n";
            $txt.="Phone : $country_code$Phone"."\r\n";
            $txt.="Password : $Password"."\r\n";
            $headers = "from:barkhapatelciss@gmail.com" . "\r\n" ;
           // $header .= "Cc:info@dropus.org \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
             'X-Mailer: PHP/' . phpversion(); 
            $user_email=mail($to_email,$subject,$txt,$headers);
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);
        die;
    }
?>