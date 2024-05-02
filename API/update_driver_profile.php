<?php 

    include('config.php');
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d h:i:s');
   // $route_id_list = $_REQUEST['route_id_list'];
    $driver_id = $_REQUEST['driver_id'];
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

    if($filename!= " ")
    {
        $tmpname=$_FILES["license_image"]["tmp_name"];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        
        $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName', `Password`='$Password', `FirstName`='$FirstName', `LastName`='$LastName', `Address`='$Address', `Address2`='$Address2', `City`='$City', `State`='$State', `Zip`='$Zip', `Driver_lat`='$lat', `Driver_lng`='$lng', `Email`='$Email', `country_code`='$country_code', `Phone`='$Phone', `Phone2`='$Phone2', `Phone3`='$Phone3',`LicenseNum`='$LicenseNum', `LicensePic`='$finame',`flag`='$flag' WHERE DriverID ='$driver_id'");
        if($update){$message['result']="unsuccess";}else{$message['result']="successfully"; }
        echo json_encode($message);
        die;
    }
    else
    { 
        $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName', `Password`='$Password', `FirstName`='$FirstName', `LastName`='$LastName', `Address`='$Address', `Address2`='$Address2', `City`='$City', `State`='$State', `Zip`='$Zip', `Driver_lat`='$lat', `Driver_lng`='$lng', `Email`='$Email', `country_code`='$country_code', `Phone`='$Phone', `Phone2`='$Phone2', `Phone3`='$Phone3',`LicenseNum`='$LicenseNum',`flag`='$flag' WHERE DriverID ='$driver_id'");
        if($update){$message['result']="unsuccess";}else{ $message['result']="successfully"; }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);
        die;
    }
?>