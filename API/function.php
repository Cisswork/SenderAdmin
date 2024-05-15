<?php
class Cerber_taxi
{
    /*------fetch_pincode_list-----*/
    function fetch_pincode_list()
    {
        include('config.php');
        $array = array();
        $sql="SELECT * FROM AreaFromTo";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $message['id']= $row['id'];
            $message['RouteID']= $row['RouteID'];
            $message['FromArea']= $row['FromArea'];
            $message['ToArea']= $row['ToArea'];
            array_push($array,$message);
        }
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------fetch_pincode_list-----*/  
    /*------user signup-----*/
    function user_signup()
    {
        include('config.php');
        require_once 'stripe-payment/vendor/autoload.php';
        $path="https://cisswork.com/Android/SenderApp/images/";
        
        date_default_timezone_set('Asia/Kolkata');
        $date1=date('Y-m-d H:i:s',strtotime("-1 days"));
        $date = date('Y-m-d');
    
      //  $company_ids=$_REQUEST['perefferd_company'];
        $fname=$_REQUEST['firstname'];
        $mname=$_REQUEST['middlename'];
        $sname=$_REQUEST['surname'];
        $name = $fname." ".$mname." ".$sname;
        $country_code = $_REQUEST['country_code'];
        $phn=$_REQUEST['mobile_number'];
        $em=$_REQUEST['email'];
        $ps=$_REQUEST['password'];
        $gender=$_REQUEST['gender'];
        $address=$_REQUEST['address'];
        $latitude=$_REQUEST['latitude'];
        $longitude=$_REQUEST['longitude'];
        $refel_code=$_REQUEST['refel_code'];
        $CountryFlag=$_REQUEST['CountryFlag'];
        
        $filename=$_FILES['id_proof_image']['name'];
        $tmpname=$_FILES["id_proof_image"]["tmp_name"];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        $expiry_date=$_REQUEST['expiry_date'];
        $test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
        $Live_key = '';
        
        \Stripe\Stripe::setApiKey($test_key);
        $customerInfo = array('name' => $name,'email' => $em,);
        
        // Create a customer in Stripe
        $stripeCustomer = \Stripe\Customer::create(['email' => $customerInfo['email'],]);
        
        $customerId = $stripeCustomer->id;
        
        $sql=mysqli_query($con,"SELECT * FROM `user_register` WHERE country_code='$country_code' AND contact='$phn'");
        $row=mysqli_num_rows($sql);
        $sql1=mysqli_query($con,"SELECT * FROM `user_register` WHERE email='$em'");
        $row1=mysqli_num_rows($sql1);
        
        $sql2=mysqli_query($con,"SELECT * FROM `user_register` WHERE generated_code=$refel_code AND (STR_TO_DATE(code_end_date, '%Y-%m-%d') >= STR_TO_DATE('$date', '%Y-%m-%d'))");
       //die(mysqli_error($con));
        $row2=mysqli_fetch_assoc($sql2);
        $code = $row2['generated_code'];
        $u_id = $row2['id'];
        $wallet = $row2['user_wallet'];
        $s_t = $row2['code_start_date'];
        $e_t = $row2['code_end_date'];
        if($row>0)
        {
        	$message['result']="Contact Already Exist";
        	echo json_encode($message);
        	die;
        }
        elseif($row1>0)
        {
        	$message['result']="Email Already Exist";
        	echo json_encode($message);
        	die;
        }
        else
        {
            if($refel_code=="")
            {
                  $ins=mysqli_query($con,"INSERT INTO `user_register`(`full_name`, `middle_name`, `sur_name`, `gender`, `email`, `password`, `country_code`, `contact`, `wrok`, `image`, `device_id`, `iosdevice_id`, `device_status`, `address`, `lat`, `long`, `status`, `date`, `user_wallet`, `user_status`, `access_token`, `booking_cancel_time`, `type`, `google_token`, `facebook_token`, `apple_token`, `created_at`, `updated_at`, `secret_key`, `firebase_id`, `invite_code`,company_id,generated_code,country_flag,`id_proof_image`, `id_expiry_date`)
                                  VALUES('$fname','$mname','$sname','$gender','$em','$ps','$country_code','$phn','','','','','','$address','$latitude','$longitude','','','0','Approve','','$date','','','','','$date','','','','','','','$CountryFlag','$finame','$expiry_date')");
      
             // die(mysqli_error($con));
               $insert_id=mysqli_insert_id($con);
               if($insert_id==0)
               {
        	      $message['result']="unsuccess";
               }
               else
               {
                    $message['id']=$insert_id;
                    $message['result']="successfully";
                	$contac=str_replace("+","",$country_code);
                	$randomid = mt_rand(100000,999999);
                    $secret_key=$insert_id.''.$randomid.''.$contac.''.$phn;
                    
                    $select = mysqli_query($con,"SELECT * FROM `Refferal_Amount` WHERE type='USER'");
                    $rr= mysqli_fetch_assoc($select);
                    $refer_amount = $rr['refer_amount'];
                    $self_amount = $rr['self_amount'];
                    $start_date = $rr['start_date'];
                    $end_date = $rr['end_date'];
                 
                    $nme=substr($name, 0, 1);
                    $random = mt_rand(10,99);
                    $code=$nme.''.$insert_id.''.$random;
                    $inv=$code;
                    $updt=mysqli_query($con,"update user_register set secret_key='$secret_key',generated_code='$code',code_start_date='$start_date',code_end_date='$end_date',customerID='$customerId' where id='$insert_id'");
                        
                    // $message['secret_key']=$roe['secret_key'];
                    // $message['invite_code']="https://cisswork.com/Android/Cerber_taxi/invite_u.php/".$roe['invite_code'];
                	$to_email = $em;
                    $subject = 'Welcome to Cerber';
                    $txt ="Hello $name"."\r\n"; 
                    $txt.="Welcome to Cerber "."\r\n";
                    $txt.="Thanks"."\r\n";
                    $txt.="Cerber "."\r\n";
                    $headers = "from:info@dropus.org" . "\r\n" .
                      //"CC: somebodyelse@example.com";
                     'X-Mailer: PHP/' . phpversion(); 
                    $user_email=mail($to_email,$subject,$txt,$headers);
                }
                  echo json_encode($message, JSON_UNESCAPED_SLASHES); 
                   die;
            }
            elseif($code==$refel_code )
            {
                  $ins=mysqli_query($con,"INSERT INTO `user_register`(`full_name`, `middle_name`, `sur_name`, `gender`, `email`, `password`, `country_code`, `contact`, `wrok`, `image`, `device_id`, `iosdevice_id`, `device_status`, `address`, `lat`, `long`, `status`, `date`, `user_wallet`, `user_status`, `access_token`, `booking_cancel_time`, `type`, `google_token`, `facebook_token`, `apple_token`, `created_at`, `updated_at`, `secret_key`, `firebase_id`, `invite_code`,company_id,generated_code,country_flag,`id_proof_image`, `id_expiry_date`)
                                  VALUES('$fname','$mname','$sname','$gender','$em','$ps','$country_code','$phn','','','','','','$address','$latitude','$longitude','','','0','Approve','','$date','','','','','$date','','','','$refel_code','','','$CountryFlag','$finame','$expiry_date')");
      
                 // die(mysqli_error($con));
                   $insert_id=mysqli_insert_id($con);
                   if($insert_id==0)
                   {
            	      $message['result']="unsuccess";
                   }
                   else
                   {
                        $message['id']=$insert_id;
                        $select = mysqli_query($con,"SELECT * FROM `Refferal_Amount` WHERE type='USER'");
                        $rr= mysqli_fetch_assoc($select);
                        $refer_amount = $rr['refer_amount'];
                        $self_amount = $rr['self_amount'];
                        $start_date = $rr['start_date'];
                        $end_date = $rr['end_date'];
                        $new_w = $wallet+$self_amount;
                        
                        $message['result']="successfully";
                    	$contac=str_replace("+","",$country_code);
                    	$randomid = mt_rand(100000,999999);
                        $secret_key=$insert_id.''.$randomid.''.$contac.''.$phn;
                     
                        $nme=substr($name, 0, 1);
                        $random = mt_rand(10,99);
                        $code=$nme.''.$insert_id.''.$random;
                        $inv=$code;
                        $updt=mysqli_query($con,"update user_register set secret_key='$secret_key',generated_code='$code',user_wallet='$refer_amount' ,code_start_date='$start_date',code_end_date='$end_date',customerID='$customerId' where id='$insert_id'");
                        $updt1=mysqli_query($con,"update user_register set user_wallet='$new_w' where id='$u_id'");
                      
                        // $message['secret_key']=$roe['secret_key'];
                        // $message['invite_code']="https://cisswork.com/Android/Cerber_taxi/invite_u.php/".$roe['invite_code'];
                    	$to_email = $em;
                        $subject = 'Welcome to Cerber';
                        $txt ="Hello $name"."\r\n"; 
                        $txt.="Welcome to Cerber "."\r\n";
                        $txt.="Thanks"."\r\n";
                        $txt.="Cerber "."\r\n";
                        $headers = "from:info@dropus.org" . "\r\n" .
                          //"CC: somebodyelse@example.com";
                         'X-Mailer: PHP/' . phpversion(); 
                        $user_email=mail($to_email,$subject,$txt,$headers);
                    }
                    echo json_encode($message, JSON_UNESCAPED_SLASHES); 
                    die;
            }
            elseif($code!=$refel_code)
            {
                $message['result']="please enter valid invite code.";
                echo json_encode($message, JSON_UNESCAPED_SLASHES); 
                    die;
            }
          
        }
    }
    /*------user signup-----*/
    
    /*--------fetch_package_list-----*/
    function fetch_package_list()
    {
        include('config.php');
        $array = array();
        $path="https://cisswork.com/Android/SenderApp/car_img/";
        $sql="SELECT * FROM tbl_package WHERE status='Approve'";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $message['package_id']= $row['id'];
            $message['package_name']= $row['package_name'];
            if($row['image']=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
              $message["image"]=$path.$row['image'];
            }
            $message['capacity']= $row['capacity'] . "Kg";
            $message['size']= $row['size'];
            $message['service_charge']= $row['service_charge'];
            array_push($array,$message);
        }
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*--------fetch_package_list-----*/
    
    /*------ driver_login-------*/
    function driver_login()
    {
       include('config.php');
       $em=$_REQUEST['email'];
       $ps=$_REQUEST['password']; 
       $st=$_REQUEST['status'];
       $login_key=$_REQUEST['login_device_key'];
       $access_token=$_REQUEST['access_token'];
       
       $path="https://cisswork.com/Android/SenderApp/images/";
       $sel=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `Email`='$em'");
      //die(mysqli_error($con));
       $count=mysqli_num_rows($sel);
       $row=mysqli_fetch_assoc($sel);
       $aid=$row['DriverID '];
       $log=$row['login_device_key'];
       $id=$row['DriverID '];
       $status=$row['login_status'];
       $dst=$row['Status'];
       $password = $row['Password'];
       $access_token1 = $row['access_token'];
       //$verify = password_verify($ps, $password);
       
        if($count=='0')
        {
            $message["result"]="Invalid email or password"; 
        }
        elseif($dst =='0')
        {
            $message["result"]="Your account is not active";
        }
        elseif($ps == $password)
        {
            if($log=="" && $access_token1=="")
            {
                $upd=mysqli_query($con,"UPDATE Drivers SET login_device_key='$login_key' WHERE `Email`='$em'");
               //  $row=mysqli_fetch_assoc($sel);
             
                date_default_timezone_set("Asia/Calcutta"); 
                $date = date('m/d/Y h:i:s', time());
                $upd=mysqli_query($con,"UPDATE Drivers SET login_status='$st',date='$date',access_token='$access_token' WHERE `Email`='$em' AND login_status='0'");
                 $message["result"]="Success";
                 $message["driver_id"]=$row['DriverID'];
                 $message["name"]=$row['FirstName']."".$row['LastName'];
                 $message["email"]=$row['Email']; 
                 $message['country_code']=$row['country_code'];
                 $message["contact"]=$row['Phone'];
                 $message["contact1"]=$row['Phone2'];
                 $message["contact2"]=$row['Phone3'];
                 $message["Address"]=$row['Address'];
                 $message["Address"]=$row['Address2'];
                 $message['State'] = $row['State'];
                 $message['city'] = $row['City'];
                 $message['Zip'] = $row['Zip'];
        	    $message['LicenseNum']=$row['LicenseNum'];
        	    $message['zipcode_list']=$row['zipcode_list'];
        	   
                 $iim=$row['image'];
                 if($iim=='')
                 {
                  $message["Image"]="https://cisswork.com/Android/SenderApp/user.png";
                 }
                 else
                 {
                 $message["Image"]=$path.$iim;
                 }
                 
                 $iim1=$row['LicensePic'];
                 if($iim1=='')
                 {
                  $message["license_image"]="https://cisswork.com/Android/SenderApp/user.png";
                 }
                 else
                 {
                 $message["license_image"]=$path.$iim1;
                 }
                 
                 $message["status"]=$row['Status'];
                
                 $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$id'");   // changed
                 $p1f=mysqli_fetch_assoc($p1);
                 $rp1=$p1f['rating'];
                 $cp1=$p1f['count'];
                // $np1=$rp1/$cp1;
                 if($cp1=='')
                 {
                    $message["rating"]='0'; 
                 }
                 else
                 {
                 $message["rating"]=round($rp1,1);
                 }
             
           }
            elseif($log!=$login_key && $access_token!=$access_token1)
            {
              $message["driver_id"]=$row['DriverID'];
              $message["result"]="You Are Already Logged-in In Other Device"; 
           }
            elseif($log==$login_key && $access_token!=$access_token1 )
            {
                date_default_timezone_set("Asia/Calcutta"); 
                $date = date('m/d/Y h:i:s', time());
                $upd=mysqli_query($con,"UPDATE Drivers SET login_status='$st',date='$date',access_token='$access_token' WHERE `Email`='$em'  AND login_status='0'");
                
                $message["result"]="Success";
                $message["driver_id"]=$row['DriverID'];
                $message["name"]=$row['FirstName']."".$row['LastName'];
                $message["email"]=$row['Email']; 
                $message['country_code']=$row['country_code'];
                $message["contact"]=$row['Phone'];
                $message["contact1"]=$row['Phone2'];
                $message["contact2"]=$row['Phone3'];
                $message["Address"]=$row['Address'];
                $message["Address"]=$row['Address2'];
                $message['State'] = $row['State'];
                $message['city'] = $row['City'];
                $message['Zip'] = $row['Zip'];
        	    $message['LicenseNum']=$row['LicenseNum'];
        	    $message['zipcode_list']=$row['zipcode_list'];
        	   
                $iim=$row['image'];
                if($iim=='')
                {
                  $message["Image"]="https://cisswork.com/Android/SenderApp/user.png";
                }
                else
                {
                 $message["Image"]=$path.$iim;
                }
                 
                $iim1=$row['LicensePic'];
                if($iim1=='')
                {
                  $message["license_image"]="https://cisswork.com/Android/SenderApp/user.png";
                }
                else
                {
                  $message["license_image"]=$path.$iim1;
                }
                 
                $message["status"]=$row['Status'];
                
                $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                $cp1=$p1f['count'];
                // $np1=$rp1/$cp1;
                if($cp1=='')
                {
                    $message["rating"]='0'; 
                }
                else
                {
                 $message["rating"]=round($rp1,1);
                }
            }
        }
        else
        {
            $message["result"]="Invalid Email or Password"; 
        }
          
        array_walk_recursive($message,function(&$item){$item=strval($item);});
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;     
    }
    /*------ driver_login-------*/

    /*------fetch_vehicle_list-----*/
    function fetch_vehicle_list()
    {
        include('config.php');
        $path="https://cisswork.com/Android/SenderApp/car_img/";
        $array = array();
        $company_id=$_REQUEST['company_id'];
        $sql="SELECT * FROM company_car_tbl WHERE company_id='$company_id' AND status='Approve'";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $sql1="SELECT * FROM car_names_tbl WHERE id='".$row['car_id']."'";
            $res1=mysqli_query($con,$sql1);
            $row1=mysqli_fetch_assoc($res1);
            $message['car_id']= $row['id'];
            $message['car_name']= $row['car_name'];
            $message['car_image']=$path.$row1['image']; 
            
            array_push($array,$message);
        }
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------fetch_vehicle_list-----*/
        
    /*------driver_add_vehicle----*/
    function driver_add_vehicle()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $vehicle_id=$_REQUEST['vehicle_id'];
        $vehicle_name=$_REQUEST['vehicle_name'];    // Make 
        $vehicle_number=$_REQUEST['vehicle_number'];   // Model
        
        $year=$_REQUEST['year'];   // Year
        $colour=$_REQUEST['colour'];   // Colour
        
        //$image_name=$_REQUEST['license_image'];

        // Driver’s License (Picture & Expiry Date)
        $filename=$_FILES['license_image']['name'];
        $tmpname=$_FILES["license_image"]["tmp_name"];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        $expiry_date=$_REQUEST['expiry_date'];
        
        // Fitness (Picture & Expiry Date)
        $filename1=$_FILES['identity_image']['name'];
        $tmpname1=$_FILES["identity_image"]["tmp_name"];
        $ext1=substr($filename1,strpos($filename1,"."));
        $str1="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame1=substr(str_shuffle($str1),5,10)."_".time().$ext1;
        if(move_uploaded_file($tmpname1,"../images/$finame1"));
        $identity_expiry_date=$_REQUEST['identity_expiry_date'];
        
        // Registration (Picture & Expiry Date)
        $filename3=$_FILES['rc_image']['name'];
        $tmpname3=$_FILES["rc_image"]["tmp_name"];
        $ext3=substr($filename3,strpos($filename3,"."));
        $str3="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame3=substr(str_shuffle($str3),5,10)."_".time().$ext3;
        if(move_uploaded_file($tmpname3,"../images/$finame3"));
        $rc_expiry_date = $_REQUEST['rc_expiry_date'];
        
        //Insurance (Picture & Expiry Date)
        $filename4=$_FILES['insurance_image']['name'];
        $tmpname4=$_FILES["insurance_image"]["tmp_name"];
        $ext4=substr($filename4,strpos($filename4,"."));
        $str4="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame4=substr(str_shuffle($str4),5,10)."_".time().$ext4;
        if(move_uploaded_file($tmpname4,"../images/$finame4"));
        $insurance_expiry_date = $_REQUEST['insurance_expiry_date'];
        
        $sql="SELECT * FROM company_car_tbl WHERE id='$vehicle_id'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        $v_name= $row['car_name'];
        $v_seat= $row['seats'];
        $v_id = $row['car_id'];
      
        $update="UPDATE `driver_register` SET car_type_id='$v_id',`car_id`='$vehicle_id',`vehicle_type`='$v_name',`vehicle_name`='$vehicle_name',`total_seats`='$v_seat',`vehicle_no`='$vehicle_number',`licence_image`='$finame',`expiry_date`='$expiry_date' ,`identity_image`='$finame1',`rc_image`='$finame3',`rc_expiry_date`='$rc_expiry_date',`identity_expiry_date`='$identity_expiry_date',`insurance_image`='$finame4',`insurance_expiry_date`='$insurance_expiry_date',`year`='$year',`colour`='$colour' WHERE `id`='$driver_id'";
        $res=mysqli_query($con,$update);
        if($res)
        {
            $message["result"] = "success";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------driver_add_vehicle----*/
        
    /*------driver_add_bank_details----*/
    function driver_add_bank_details()
    {
        include('config.php');
        date_default_timezone_set('Asia/Kolkata');
        $date=date('Y-m-d');
        $driver_id=$_REQUEST['driver_id'];
        $account_holder_name=$_REQUEST['account_holder_name'];
        $account_number=$_REQUEST['account_number'];
        $email=$_REQUEST['email'];   
        
        $insert = mysqli_query($con,"INSERT INTO `driver_bank_details`(`driver_id`, `account_holder_name`, `account_number`, `email`, `status`, `date`)
                    VALUES ('$driver_id','$account_holder_name','$account_number','$email','','$date')");
                    
        if($insert)
        {
            $message["result"] = "success";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die;             
        
    }
    /*------driver_add_bank_details----*/

    /*------ driver_logout-------*/
    function driver_logout()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $sel=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
      // die(mysqli_error($con));
       $count=mysqli_num_rows($sel);
       if($count==0)
       {
           echo  $message["result"]="unsuccess";  
       }
       else
       {
            date_default_timezone_set("Asia/Calcutta"); 
            $date = date('m/d/Y h:i:s', time());
            $upd=mysqli_query($con,"UPDATE Drivers SET login_status='0',date='$date',access_token='',login_device_key='',Driver_device_id='',iosDriver_device_id='',device_status=''  WHERE `DriverID`='$driver_id'");
            if($upd)
            {
                $message["result"]="success";  
            }
            else
            {
                $message["result"]="unsuccess";  
            }
       }
       echo json_encode($message, JSON_UNESCAPED_SLASHES); 
       die; 
    }
    /*------ driver_logout-------*/
        
    /*------ user_login-------*/
    function user_login()
    {
        include('config.php');
        $path="https://cisswork.com/Android/SenderApp/images/";
        $em=$_REQUEST['email'];
        $ps=$_REQUEST['password']; 
        
        $sel=mysqli_query($con,"SELECT * FROM `user_register` WHERE `email`='$em' AND password='$ps'");
        $count=mysqli_num_rows($sel);
        $row=mysqli_fetch_assoc($sel);
        $user_id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
        $user_status= $row['user_status'];
         
        if($count=='0')
        {
            $message["result"] = "Email or Password is incorrect";   
        }
        elseif($user_status=='Disapprove')
        {
            $message["result"] = "Your account is disapprove";   
        }
        else
        { 
            $message["result"] = "success"; 
            $message["user_id"] = $user_id; 
            $uid=$row['id'];
            $message["first_name"]=$row['full_name'];
            $message['last_name'] = $row['sur_name'];
            $message["email"]=$row['email']; 
            $message['country_code']=$row['country_code'];
            $message["password"]=$row['password']; 
            $message["contact"]=$row['contact'];
            $message['gender']= $row['gender'];
            $message["invite_code"]=$row['generated_code'];
            $message["Address"]=$row['address'];
            $iim=$row['image'];
            if($iim=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
             $message["Image"]=$path.$iim;
            }
            $message["status"]=$row['user_status']; 
        //     $p3=mysqli_query($con,"SELECT count(rate_id) as count, SUM( `user_rated` ) AS rating FROM tbl_rating WHERE user_id='$uid'");   // changed
        //     $p3f=mysqli_fetch_assoc($p3);
        //     $rp3=$p3f['rating'];
        //     $cp3=$p3f['count'];
        // //     $np3=$rp3/$cp3;
        //      if($cp3<0)
        //      {
        //         $message["rating"]='0'; 
        //      }
        //      else
        //      {
        //         $message["rating"]=round($np3,1);
        //      }
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
          
        }
    /*------ user_login-------*/
    
    /*------ user_logout-------*/
    function user_logout()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $sel=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
      // die(mysqli_error($con));
       $count=mysqli_num_rows($sel);
       if($count==0)
       {
            $message["result"]="unsuccess";  
       }
       else
       {
            date_default_timezone_set("Asia/Calcutta"); 
            $date = date('m/d/Y h:i:s', time());
            $upd=mysqli_query($con,"UPDATE user_register SET device_id='',iosdevice_id='',device_status='' WHERE `id`='$user_id'");
            if($upd)
            {
                $message["result"]="success";  
            }
            else
            {
                $message["result"]="unsuccess";  
            }
       }
       echo json_encode($message, JSON_UNESCAPED_SLASHES); 
       die; 
    }
    /*-------user_logout-------*/
    
    /*------------ send_driver_otp -----------*/
    function send_driver_otp()
    {
            include('config.php');
            $code=$_REQUEST['country_code'];
            $contact=$_REQUEST['contact'];
            $v_code = mt_rand(1000, 9999);
            $fetch = mysqli_query($con, "SELECT * FROM `driver_register`  WHERE `country_code`='$code' AND `contact`='$contact'");
            $row = mysqli_fetch_assoc($fetch);
            $contact1 = $row['contact'];
            $code1 = $row['country_code'];
            $id = $row['id'];
            if ($code == $code1 && $contact==$contact1 ) 
            {
                $up = mysqli_query($con, "UPDATE driver_register SET otp='$v_code' where `country_code`='$code' AND `contact`='$contact'");
                if($up) 
                {
                    $return_array['result'] = "success";
                    $return_array['driver_id'] = $id;
                    $return_array['otp'] = $v_code;
                    echo json_encode($return_array, JSON_UNESCAPED_SLASHES);
                    die;
                } 
                else 
                {
                    $return_array['result'] = "unsuccess";
                    echo json_encode($return_array, JSON_UNESCAPED_SLASHES);
                    die;
                }
            }  
            else 
            {
                $return_array['result'] = 'Not Registered';
                $return_array['otp'] = '';
                echo json_encode($return_array, JSON_UNESCAPED_SLASHES);
                die;
            }
        }
    /*------------ send_driver_otp -----------*/
     
    /*---------driver_otp_verification--------*/
    function driver_otp_verification()
    {
            include "config.php";
            $driver_id = $_REQUEST['driver_id'];
            $v_otp = $_REQUEST['otp'];
            $select_email = mysqli_query($con, "SELECT * FROM `driver_register` where id='$driver_id' ");
            $row = mysqli_num_rows($select_email);
            $result_email = mysqli_fetch_assoc($select_email);
            $v_otp1 = $result_email['otp'];
            $id = $result_email['id'];
            if($v_otp == $v_otp1) {
                $message["result"] = "success";
                $message['driver_id'] = $id;
            } else {
                $message["result"] = "unsuccess";
            }
            echo json_encode($message, JSON_UNESCAPED_SLASHES);
            die;
        }
    /*---------driver_otp_verification--------*/
    
    /*------ change_driver_password-------*/
    function change_driver_password()
    {
        include('config.php');
        $uid=$_REQUEST['driver_id'];
        $plaintext_password=$_REQUEST['password'];
        $new_password=password_hash($plaintext_password, PASSWORD_DEFAULT);
        $sel=mysqli_query($con,"SELECT * FROM driver_register WHERE id='$uid'");
        $fetch=mysqli_fetch_assoc($sel);
        $count = mysqli_num_rows($sel);
        if($count==0)
        {
           $message["result"]="Unsuccess";
        }
        else
        {
          $upd=mysqli_query($con,"UPDATE `driver_register` SET `password`='$new_password' WHERE id='$uid'");
           if($upd)
            {
          
           $message["result"]="Password changed successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
        }
     echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;
    }
    /*------ change_driver_password-------*/
    
    /*------ update_user_password-------*/
    function update_user_password()
    {
        include('config.php');
        $uid=$_REQUEST['userid'];
        $plaintext_password=$_REQUEST['password'];
        $new_password=password_hash($plaintext_password, PASSWORD_DEFAULT);
        $sel=mysqli_query($con,"SELECT * FROM user_register WHERE id='$uid'");
        $fetch=mysqli_fetch_assoc($sel);
        $count = mysqli_num_rows($sel);
        if($count==0)
        {
           $message["result"]="Unsuccess";
        }
        else
        {
          $upd=mysqli_query($con,"UPDATE `user_register` SET `password`='$plaintext_password' WHERE id='$uid'");
           if($upd)
            {
          
           $message["result"]="Password updated successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
        }
     echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;
    }
    /*------ update_user_password-------*/
    
    /*----------fetch driver detail------*/
    function fetch_driver_detail()
    {
        include ('config.php');
        $driver_id=$_REQUEST['driver_id'];
        //$firebase_id= $_REQUEST['firebase_id'];
        $return_arr=array(); 
        $path="https://cisswork.com/Android/SenderApp/images/";  
        $sql=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
        $nu=mysqli_num_rows($sql);
        if($nu=='0')
        {
            $message['result']='unsuccess';
        }
        else
        {
            $row = mysqli_fetch_assoc($sql);
            $message["result"]="successfully"; 
             $message["id"]=$row['DriverID'];
             $message["UserName"]=$row['UserName'];
             $message["first_name"]=$row['FirstName'];
             $message["last_name"]=$row['LastName'];
             $message["email"]=$row['Email']; 
             $message['password']=$row['Password'];
            //  $message['gender'] = $row['gender'];
             $message["country_code"]=$row['country_code'];
             $message["Phone"]=$row['Phone'];
             $message["Phone2"]=$row['Phone2'];
             $message["Phone3"]=$row['Phone3'];
             $message["Address"]=$row['Address'];
             $message["Address2"]=$row['Address2'];
             $message["City"]=$row['City'];
             $message["State"]=$row['State'];
             $message["Zip"]=$row['Zip'];
             $message["flag"]=$row['flag'];
             if($row['image']==''){$message["Image"]=''; } else{$message["Image"]=$path.$row['image'];}
             if($row['LicensePic']=='') { $message["licence_image"]=''; } else { $message["licence_image"]=$path.$row['LicensePic']; }
             $message["LicenseNum"]=$row['LicenseNum'];
             $message["status"]=$row['Status'];
             $message["access_token"]=$row['access_token'];
             $message["zipcode_list"]=$row['zipcode_list']; 
       }
    	array_walk_recursive($message,function(&$item){$item=strval($item);});
        echo json_encode($message, JSON_UNESCAPED_SLASHES);
    }
    /*----------fetch driver detail------*/
    /*------update_driver_profile---------*/
        function update_driver_profile()
        {
            include('config.php');
            $driver_id=$_REQUEST['driver_id'];
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d h:i:s');
            $FirstName=$_REQUEST['FirstName'];
            $LastName=$_REQUEST['LastName'];
            $Email=$_REQUEST['Email'];
            $Password=$_REQUEST['Password'];
            $LicenseNum=$_REQUEST['LicenseNum'];
            $country_code = $_REQUEST['country_code'];
            $Phone=$_REQUEST['Phone'];
            $flag = $_REQUEST['flag'];
            $route_id_list = $_REQUEST['route_id_list'];
            
            $filename=$_FILES['license_image']['name'];
            $tmpname=$_FILES["license_image"]["tmp_name"];
            $ext=substr($filename,strpos($filename,"."));
            $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
            $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
            if(move_uploaded_file($tmpname,"../images/$finame"));
        
            if($filename=="")
            {
                $update="UPDATE `Drivers` SET `FirstName`='$FirstName',LastName='$LastName',country_code='$country_code',`Phone`='$Phone',`Email`= '$Email',Password='$Password',flag='$flag',LicenseNum='$LicenseNum',zipcode_list='$route_id_list'  WHERE `DriverID`='$driver_id'";
                $res=mysqli_query($con,$update);
            }
            else
            {
                $update="UPDATE `Drivers` SET `FirstName`='$FirstName',LastName='$LastName',country_code='$country_code',`Phone`='$Phone',`Email`= '$Email',Password='$Password',flag='$flag',LicenseNum='$LicenseNum',LicensePic='$finame',zipcode_list='$route_id_list'  WHERE `DriverID`='$driver_id'";
                $res=mysqli_query($con,$update);
               // die(mysqli_error($con));
            }
            if($res)
            {
                $message["driver_id"] =$driver_id;
                $message["result"] = "successfully update";
            }
            else
            {
                $message["result"] = "unsuccess";
            }
            echo json_encode($message, JSON_UNESCAPED_SLASHES);   
            die; 
        }
    /*-------update_driver_profile1--------*/ 
     
    /*---- update_driver_profile_image-----*/
     function update_driver_profile_image()
     {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $filename=$_FILES['image']['name'];
        $tmpname=$_FILES["image"]["tmp_name"];
        $type=$_FILES['image']['type'];
        $size=$_FILES['image']['size'];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        
        $update="UPDATE `Drivers` SET `image`='$finame' WHERE  `DriverID`='$driver_id'";
        $res=mysqli_query($con,$update);
        if($res)
        {
            $message["driver_id"] =$driver_id;
            $message["result"] = "successfully update";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
     }
    /*----- update_driver_profile_image---*/
    
    /*------ update_userdevice_id-------*/
    function update_userdevice_id()
    {
        include('config.php');
       $email=$_REQUEST['user_id'];
       $device_id=$_REQUEST['device_id'];  
       $device_status = $_REQUEST['device_status'];
      // $firebase_id= $_REQUEST['firebase_id'];
       
        if($device_status == "Android")
       {
           $upd=mysqli_query($con,"UPDATE `user_register` SET `device_id`='$device_id',`iosdevice_id`='',device_status='Android' WHERE `id`='$email'");
           if($upd)
           {
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
       }
       elseif($device_status == "IOS")
       {
           $upd=mysqli_query($con,"UPDATE `user_register` SET `device_id`='',`iosdevice_id`='$device_id',device_status='IOS'  WHERE `id`='$email'");
           if($upd)
           {
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
       }
       
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------ update_userdevice_id-------*/
    
    /*------ fetch_user_detail-------*/
    function fetch_user_detail()
    {
        include('config.php');
       $user_id=$_REQUEST['user_id'];
       $path="https://cisswork.com/Android/SenderApp/images/";
    
    $rt1="https://apps.apple.com/us/app/dropus/id1606339134";
    if($user_id!='')
    {
        $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
       
        if($sel=mysqli_fetch_assoc($upd))
        {
            $message["result"]="successfully";
            $message["id"]=$sel['id'];
            $message["first_name"]=$sel['full_name'];
            $message['last_name'] = $sel['sur_name'];
            $message["email"]=$sel['email']; 
            $message['country_code']=$sel['country_code'];
            $message["password"]=$sel['password']; 
            $message["contact"]=$sel['contact'];
            $message['gender']= $sel['gender'];
            $message["invite_code"]=$sel['generated_code'];
            $message["Address"]=$sel['address'];
            $message['CountryFlag']=$sel['country_flag'];
            if($sel['image']=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
              $message["Image"]=$path.$sel['image'];
            }
            $message["status"]=$sel['user_status'];
            
            if($sel['id_proof_image']=='')
            {
              $message["id_proof_image"]=$path."user.png";
            }
            else
            {
              $message["id_proof_image"]=$path.$sel['id_proof_image'];
            }
            $message["id_expiry_date"]=$sel['id_expiry_date'];
            $message["customerID"]=$sel['customerID'];
        } 
           
    } 
    array_walk_recursive($message,function(&$item){$item=strval($item);});
     echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;
    }
    /*------ fetch_user_detail-------*/
    
    /*--update_user_profile--*/
    function update_user_profile()
    {
            include('config.php');
    
            $user_id=$_REQUEST['user_id'];
            $first_name=$_REQUEST['firstname'];
            $last_name=$_REQUEST['lastname'];
            $ccode=$_REQUEST['countrycode'];
            $phn=$_REQUEST['contact'];
            $email=$_REQUEST['email'];  
            $password=$_REQUEST['password'];
            $countryflag=$_REQUEST['countryflag'];
            $company_id = $_REQUEST['company_list'];
            
            $filename=$_FILES['id_proof_image']['name'];
            $tmpname=$_FILES["id_proof_image"]["tmp_name"];
            $ext=substr($filename,strpos($filename,"."));
            $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
            $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
            if(move_uploaded_file($tmpname,"../images/$finame"));
            $expiry_date=$_REQUEST['expiry_date'];
             
            if($password=="")
            {
                if($filename=="")
                {
                    $update="UPDATE `user_register` SET `full_name`='$first_name',sur_name='$last_name',country_code='$ccode',company_id='$company_id',`contact`='$phn',`email`= '$email',country_flag='$countryflag',id_expiry_date='$expiry_date'  WHERE `id`='$user_id'";
                    $res=mysqli_query($con,$update);
                    if($res)
                    {
                        $message["user_id"] =$user_id;
                        $message["result"] = "successfully update";   
                    }
                    else
                    {
                        $message["result"] = "unsuccess"; 
                    }
                }
                else
                {
                    $update="UPDATE `user_register` SET `full_name`='$first_name',sur_name='$last_name',country_code='$ccode',company_id='$company_id',`contact`='$phn',`email`= '$email',country_flag='$countryflag',id_proof_image='$finame',id_expiry_date='$expiry_date'  WHERE `id`='$user_id'";
                    $res=mysqli_query($con,$update);
                    if($res)
                    {
                        $message["user_id"] =$user_id;
                        $message["result"] = "successfully update";   
                    }
                    else
                    {
                        $message["result"] = "unsuccess"; 
                    } 
                }
            }
            else
            {
                if($filename=="")
                {
                    $update="UPDATE `user_register` SET `full_name`='$first_name',sur_name='$last_name',country_code='$ccode',company_id='$company_id',`contact`='$phn',`email`= '$email',password ='$password',country_flag='$countryflag',id_expiry_date='$expiry_date'  WHERE `id`='$user_id'";
                    $res=mysqli_query($con,$update);
                    if($res)
                    {
                        $message["user_id"] =$user_id;
                        $message["result"] = "successfully update";   
                    }
                    else
                    {
                        $message["result"] = "unsuccess"; 
                    }
                }
                else
                {
                    $update="UPDATE `user_register` SET `full_name`='$first_name',sur_name='$last_name',country_code='$ccode',company_id='$company_id',`contact`='$phn',`email`= '$email',password ='$password',country_flag='$countryflag',id_proof_image='$finame',id_expiry_date='$expiry_date'  WHERE `id`='$user_id'";
                    $res=mysqli_query($con,$update);
                    if($res)
                    {
                        $message["user_id"] =$user_id;
                        $message["result"] = "successfully update";   
                    }
                    else
                    {
                        $message["result"] = "unsuccess"; 
                    }
                }
            }
            echo json_encode($message, JSON_UNESCAPED_SLASHES);   
            die; 
        }
    /*-- update_user_profile--*/
     
     /*-- update_user_profile_image--*/
     function update_user_profile_image()
     {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $filename=$_FILES['image']['name'];
        $tmpname=$_FILES["image"]["tmp_name"];
        $type=$_FILES['image']['type'];
        $size=$_FILES['image']['size'];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        
        $update="UPDATE `user_register` SET `image`='$finame' WHERE  `id`='$user_id'";
        $res=mysqli_query($con,$update);
        if($res)
        {
            $message["user_id"] =$user_id;
            $message["result"] = "successfully update";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
     }
     /*-- update_user_profile_image--*/
    
    /*------fetch_vehicle_type_list-----*/
    function fetch_vehicle_type_list()
    {
        include('config.php');
        $array = array();
        $path="https://cisswork.com/Android/SenderApp/car_img/";
        $sql="SELECT * FROM tbl_package WHERE status='Approve'";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $message['package_id']= $row['id'];
            $message['package_name']= $row['package_name'];
            if($row['image']=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
              $message["image"]=$path.$row['image'];
            }
            $message['capacity']= $row['capacity'] . "Kg";
            $message['size']= $row['size'];
            $message['service_charge']= $row['service_charge'];
            array_push($array,$message);
        }
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
     /*------fetch_vehicle_type_list-----*/
     
    /*------ fetch_user_wallet------*/
    function fetch_user_wallet()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
     
        $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
        if($sel=mysqli_fetch_assoc($upd))
        {
            $message["result"]="success";
            $message["id"]=$sel['id'];
            $message["user_wallet"]=$sel['user_wallet'];
        }
        array_walk_recursive($message,function(&$item){$item=strval($item);});
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_user_wallet-------*/
    
     /*------ fetch_driver_wallet------*/
    function fetch_driver_wallet()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
     
        $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        if($sel=mysqli_fetch_assoc($upd))
        {
            $message["result"]="success";
            $message["id"]=$sel['id'];
            $message["driver_wallet"]=$sel['wallet_balance'];
        }
        array_walk_recursive($message,function(&$item){$item=strval($item);});
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_driver_wallet-------*/
    
    /*------ fetch_driver_wallet_transaction_history------*/
    function fetch_driver_wallet_transaction_history()
    {
        ini_set('display_errors', 1);
    error_reporting(E_ALL);
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $array = array();
        //$upd=mysqli_query($con,"SELECT * FROM `driver_wallet_transaction_history` WHERE `driver_id`='$driver_id'");
        $upd=mysqli_query($con,"SELECT * FROM `driver_withdraw_request` WHERE `driver_id`='$driver_id' AND status='Pending' ORDER BY withdraw_id DESC");
        // mysqli_num_rows($upd);
        while($sel=mysqli_fetch_assoc($upd))
        {
           //$message["result"]="success";
           if($sel['booking_id']!="")
           {
                $message["booking_id"]=$sel['booking_id'];
           }
           else
           {
                $message["booking_id"]="";
           }
           
           
            //$message["paid_amount"]=$sel['paid_amount'];
            $message["payment_mode"]=$sel['payment_mode'];
            
            // if($sel['payment_mode'] =='Cash' && $sel['admin_com'] =='Yes')
            // {
            //  echo  "true";
            // }
            // else{
            //     echo "false";
            // }
            
            
            if($sel['payment_mode']=='Cash' && $sel['admin_com'] =='')
            {
                $message["status"]='Pay By Cash';
                $message["driver_earning"]=$sel['withdraw_credit'];
            }
            elseif($sel['payment_mode'] =='Cash' && $sel['admin_com'] =='Yes')
            {
                $message["status"]='Dedited By Your Wallet';
                $message["driver_earning"]=$sel['withdraw_credit'];
            }
            elseif($sel['payment_mode']=='Wallet')
            {
                $message["status"]='Pay By Wallet';
                $message["driver_earning"]=$sel['withdraw_credit'];
            }
            elseif($sel['payment_mode']=='Card')
            {
                $message["status"]='Pay By Card';
                $message["driver_earning"]=$sel['withdraw_credit'];
            }
            else
            {
                $message["status"]='Credited By Admin';
                $message["driver_earning"]=$sel['withdraw_credit'];
            }
            //$message["status"]=$sel['driver_status'];
            $message["date"]=$sel['date'];
            $message["time"]=$sel['time'];
             array_push($array,$message);
        }
        //array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_driver_wallet_transaction_history-------*/
    
    /*------ fetch_coupon_list------*/
    function fetch_coupon_list()
    {
        include('config.php');
        $array= array();
        date_default_timezone_set('Asia/Kolkata');
        $today = date('Y-m-d');
        $upd=mysqli_query($con,"SELECT * FROM `tbl_coupon` WHERE `end_date`>'$today' AND remaining_amount >'0'");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["id"]=$sel['id'];
            $message["discount_code"]=$sel['code'];
            $message["minimum_amount"]=$sel['amount'];
            $message["discount_percentage"]=$sel['discount'];
            $message["remaining_minimum_amount"]=$sel['remaining_amount'];
            $message["title"]=$sel['discription'];
            $message["start_date"]=$sel['start_date'];
            $message["end_date"]=$sel['end_date'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_coupon_list-------*/
    
    /*------ fetch_user_notification_list------*/
    function fetch_user_notification_list()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `tbl_notification_list` WHERE `user_id`='$user_id' ORDER BY  noti_id DESC");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["id"]=$sel['noti_id'];
            $message["user_id"]=$sel['user_id'];
            $message["title"]=$sel['title'];
            $message["message"]=$sel['message'];
            $message["date"]=$sel['date'];
            $message["time"]=$sel['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_user_notification_list-------*/
    
    /*------ delete_user_notification------*/
    function delete_user_notification()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $notification_id = $_REQUEST['notification_id'];
        $array= array();
        $upd=mysqli_query($con,"DELETE FROM `tbl_notification_list` WHERE `user_id`='$user_id' AND noti_id='$notification_id'");
        if($upd)
        {
           $message["result"]="Update successfully";
        }
        else
        {
           $message["result"]="Unsuccess";
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ delete_user_notification-------*/
    
    /*------ fetch_online_driver_list-----*/
    function fetch_online_driver_list()
    {
        include('config.php');
        $array= array();
        $lat = $_REQUEST['lat'];
        $lng = $_REQUEST['lng'];
        $upd=mysqli_query($con,"SELECT *, 3956 * 2 * ACOS( SIN( RADIANS( '$lat' ) ) * SIN( RADIANS(  `Driver_lat` ) ) + COS( RADIANS( '$lat' ) ) * COS( RADIANS(  `Driver_lat` ) ) * COS( RADIANS(  `Driver_lng` ) - RADIANS( '$lng' ) ) ) AS  `distance`  FROM  `driver_register` WHERE  admin_status !='busy' AND available_status='Available' AND Driver_lat NOT IN (0.0) AND `login_status`='1' AND Driver_lng NOT IN (0.0) HAVING DISTANCE <=10 ");
       // $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `login_status`='1'");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["id"]=$sel['id'];
            $message["Driver_lat"]=$sel['Driver_lat'];
            $message["Driver_lng"]=$sel['Driver_lng'];
            $message["rotation"]=$sel['rotation'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_online_driver_list------*/
    
    /*------ update_driverdevice_id-------*/
    function update_driverdevice_id()
    {
        include('config.php');
       $driver_id=$_REQUEST['driver_id'];
       $device_id=$_REQUEST['device_id'];  
       $device_status = $_REQUEST['device_status'];
      // $firebase_id= $_REQUEST['firebase_id'];
       
        if($device_status == "Android")
       {
           $upd=mysqli_query($con,"UPDATE `Drivers` SET `Driver_device_id`='$device_id',`iosDriver_device_id`='',device_status='Android' WHERE `DriverID`='$driver_id'");
           if($upd)
           {
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
       }
       elseif($device_status == "IOS")
       {
           $upd=mysqli_query($con,"UPDATE `Drivers` SET `Driver_device_id`='',`iosDriver_device_id`='$device_id',device_status='IOS'  WHERE `DriverID`='$driver_id'");
           if($upd)
           {
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
       }
       
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------ update_driverdevice_id-------*/
    
    /*------ update_driver latlong-------*/
    function update_driver_latlong()
    {
        include('config.php');
        $did=$_REQUEST['driver_id'];
        $lat=$_REQUEST['lat'];  
        $long=$_REQUEST['long'];  
        $rotation = $_REQUEST['rotation'];  
        $available_status=$_REQUEST['available_status'];
        
        if($available_status == 'Available')
        {
            $login_status='1';
        }
        elseif($available_status == 'UnAvailable')
        {
            $login_status='0';
        }
        
        $path="https://cisswork.com/Android/SenderApp/images/";
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date( 'Y-m-d H:i:s ', time () );
        $upd=mysqli_query($con,"UPDATE `Drivers` SET `Driver_lat`='$lat',`Driver_lng`='$long',rotation='$rotation',driver_online_time='$currentTime',login_status='$login_status',available_status='$available_status' WHERE `DriverID`='$did'");
       //die(mysqli_error($con));
        if($upd)
        {
           $message["result"]="Updated successfully";
        }
        else
        {
            $message["result"]="Unsuccess";
        }
       
        array_walk_recursive($message,function(&$item){$item=strval($item);});
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ update_driver_latlong-------*/
    
    /*------ user_write_support-------*/
    function user_write_support()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id']; 
        $fullname=$_REQUEST['fullname']; 
        $email=$_REQUEST['email']; 
        $subject=$_REQUEST['subject']; 
        $message=$_REQUEST['message']; 
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $time = date('h:i A');
        
        $ins=mysqli_query($con,"INSERT INTO `tbl_user_write_support`(`user_id`, `fullname`, `email`, `subject`, `message`,type, `date`, `time`)
                                                            VALUES('$user_id','$fullname','$email','$subject','$message','User','$date','$time')");
          
        $insert_id=mysqli_insert_id($con);
        if($insert_id==0)
        {
          $message1['result']="unsuccess";
        }
        else
        {
            $message1['id']=$insert_id;
            $message1['result']="successfully";             
        }
        echo json_encode($message1, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ user_write_support-------*/
    
    /*------ fetch_driver_notification_list------*/
    function fetch_driver_notification_list()
    {
        include('config.php');
        $user_id=$_REQUEST['driver_id'];
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `tbl_notification_list` WHERE `driver_id`='$user_id'");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["id"]=$sel['noti_id'];
            $message["driver_id"]=$sel['driver_id'];
            $message["title"]=$sel['title'];
            $message["message"]=$sel['message'];
            $message["date"]=$sel['date'];
            $message["time"]=$sel['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ fetch_driver_notification_list-------*/
    
    /*------ delete_driver_notification------*/
    function delete_driver_notification()
    {
        include('config.php');
        $user_id=$_REQUEST['driver_id'];
        $notification_id = $_REQUEST['notification_id'];
        $array= array();
        $upd=mysqli_query($con,"DELETE FROM `tbl_notification_list`  WHERE `driver_id`='$user_id' AND noti_id='$notification_id'");
        if($upd)
        {
           $message["result"]="Update successfully";
        }
        else
        {
           $message["result"]="Unsuccess";
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ delete_driver_notification-------*/
    
    /*-----fetch_user_preffered_company_list----*/
    function fetch_user_preffered_company_list()
    {
        include "config.php";
        $uid = $_REQUEST['user_id'];
        
        $array=array();
        $yu=mysqli_query($con,"select * from user_register where id='$uid'");
        $yu1=mysqli_fetch_assoc($yu);
        //$count=mysqli_num_rows($yu);
        $company_id = $yu1['company_id'];
        
        if($company_id != "")
        {
            $shift = $company_id;
            $mm_array = array();
            $est_arr=array();
            $est_array=explode(',',$shift);
            $est_arr=$est_array;
            $count = count($est_arr);
            for($i=0; $i<count($est_arr); $i++)
            {
                $b=$est_arr[$i];    
                $crf=mysqli_query($con,"select * from company_register where id='$b'");
                $msg['company_id']=$b;
                $rows=mysqli_fetch_assoc($crf);
                $msg['company_name']=$rows['fullname'];
                array_push($array,$msg);
            }
            array_walk_recursive($array,function(&$item){$item=strval($item);});
            echo json_encode($array, JSON_UNESCAPED_SLASHES);
            die;
        }
        else
        {
            echo json_encode($array, JSON_UNESCAPED_SLASHES);
            die;
        }
       
    }
    /*-----fetch_user_preffered_company_list----*/
    
    /*-----------add_user_card------------------*/
    function add_user_card()
    {
        include "config.php";
        $iUserId = $_REQUEST['user_id'];
        $card_no = $_REQUEST['card_number'];
        $account_holder_name = $_REQUEST['card_holdername'];
        $card_expiredate = $_REQUEST['card_expiredate'];
        $est_arr=array();
        $est_array=explode('/',$card_expiredate);
        $est_arr=$est_array; 
        $exp_month = $est_arr[0]; 
        $exp_year = $est_arr[1]; 
        $cvv = $_REQUEST['card_cvv'];
        $crdt=mysqli_query($con,"select * from tbl_user_card where iUserId='$iUserId' and card_no='$card_no'");
        $edt=mysqli_fetch_assoc($crdt);
        $cnum=$edt['card_no'];
        $uid=$edt['iUserId'];
        if($card_no==$cnum && $iUserId==$uid )
        {
            $result['result']='Card No Already Exits';
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
            die;
        }
        elseif($card_no!=$cnum && $iUserId!=$uid)
        {
            $ins=mysqli_query($con,"INSERT INTO `tbl_user_card`(`iUserId`, `secret_key`, `card_no`, `account_holder_name`, `exp_month`, `exp_year`, `cvv`, `vStripeToken`, `fAmount`, `StripeChargeCard`,`ChargeCardStatus`,`DefaultPaymentCard`) 
            VALUES ('$iUserId','','$card_no','$account_holder_name','$exp_month','$exp_year','$cvv','','','','No','No')");
            $id=mysqli_insert_id($con);
            if($id>0)
            {
              $result['result']='success';  
              $result['card_id']=$id;
            }
           else
            {
               $result['result']='unsuccess';   
            }   
        }
      
        //array_walk_recursive($result,function(&$item){$item=strval($item);});
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*-----------add_user_card------------------*/
    
    /*-----------fetch_user_card----------------*/
    function fetch_user_card()
    {
        include "config.php";
        $iUserId = $_REQUEST['user_id'];
        
        $array=array();
        
        $crf=mysqli_query($con,"select * from tbl_user_card where iUserId='$iUserId' ");
        while($row=mysqli_fetch_assoc($crf))
        {
            $msg['card_id']=$row['iCardId'];
            $msg['card_no']=$row['card_no'];
            $msg['account_holder_name']=$row['account_holder_name'];
            $msg['exp_month']=$row['exp_month'];
            $msg['exp_year']=$row['exp_year'];
            $msg['cvv']=$row['cvv'];
            array_push($array,$msg);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----------fetch_user_card-----------------*/
    
    /*----------delete_user_card---------------*/
    function delete_user_card()
    {
        include "config.php";
        $iUserId = $_REQUEST['user_id'];
        $iCardId = $_REQUEST['card_id'];
       
        $del=mysqli_query($con,"DELETE FROM `tbl_user_card` WHERE iUserId='$iUserId' AND iCardId ='$iCardId'");
      // die(mysqli_error($con));
        if($del)
        {
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----------delete_user_card-------------*/
    
    /*-----------add_driver_card-------------*/
    function add_driver_card()
    {
        include "config.php";
        $iDriverId = $_REQUEST['driver_id'];
        $card_no = $_REQUEST['card_number'];
        $account_holder_name = $_REQUEST['card_holdername'];
        $card_expiredate = $_REQUEST['card_expiredate'];
        $est_arr=array();
        $est_array=explode('/',$card_expiredate);
        $est_arr=$est_array; 
        $exp_month = $est_arr[0]; 
        $exp_year = $est_arr[1]; 
        $cvv = $_REQUEST['card_cvv'];
        
        $crdt=mysqli_query($con,"select * from driver_card_detail where driver_id='$iDriverId' and card_no='$card_no'");
        $edt=mysqli_fetch_assoc($crdt);
        $cnum=$edt['card_no'];
        $uid=$edt['driver_id'];
        if($card_no==$cnum && $iDriverId==$uid)
        {
            $result['result']='Card No Already Exits';
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
            die;
        }
        elseif($card_no!=$cnum && $iDriverId!=$uid)
        {
            $ins=mysqli_query($con,"INSERT INTO `driver_card_detail`( `driver_id`, `card_no`, `card_holder_name`, `expiry_month`, `expiry_year`, `cvv`, `card_type`, `cardToken`)
            VALUES ('$iDriverId','$card_no','$account_holder_name','$exp_month','$exp_year','$cvv','','')");
            $id=mysqli_insert_id($con);
            if($id>0)
            {
               $result['result']='success';  
               $result['card_id']=$id;
            }
            else
            {
               $result['result']='unsuccess';   
            }
        }
        array_walk_recursive($result,function(&$item){$item=strval($item);});
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
    }
    /*-----------add_driver_card--------------*/
    /*-----------fetch_driver_card-------------*/
    function fetch_driver_card()
    {
        include "config.php";
        $iDriverId = $_REQUEST['driver_id'];
        $array=array();
        $crf=mysqli_query($con,"select * from driver_card_detail where driver_id='$iDriverId' ");
        mysqli_num_rows($crf);
        while($row=mysqli_fetch_assoc($crf))
        {
            $msg['card_id']=$row['card_id'];
            $msg['card_no']=$row['card_no'];
            $msg['account_holder_name']=$row['card_holder_name'];
            $msg['exp_month']=$row['expiry_month'];
            $msg['exp_year']=$row['expiry_year'];
            $msg['cvv']=$row['cvv'];
            array_push($array,$msg);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----------fetch_driver_card------------*/ 
    /*----------delete_driver_card-----------*/
    function delete_driver_card()
    {
        include "config.php";
        $iDriverId = $_REQUEST['driver_id'];
        $card_id = $_REQUEST['card_id'];
       
        $del=mysqli_query($con,"DELETE FROM `driver_card_detail` WHERE driver_id='$iDriverId' AND card_id ='$card_id'");
       //die(mysqli_error($con));
        if($del)
        {
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*---------delete_driver_card-----*/
     
    /*-------fetch_driver_ride_now_list-----*/
    function fetch_driver_ride_now_list()
    {
        include('config.php');
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        
        $user_id=$_REQUEST['driver_id'];
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE (`driver_id`='$user_id' AND ride_type ='Ride_now' AND status='New Booking')");
       //mysqli_error($con);
        mysqli_num_rows($upd);
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["booking_id"]=$sel['trip_id'];
            $booking_id = $sel['trip_id'];
            
            $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['source_add'];
            $message["destination_add"]=$ss['destination_add'];
            $message["total_price"]=$sel['total_price'];
            $message["ride_type"]=$sel['ride_type'];
            // $message["distance"]=$ss['total_distance'];
            // $message["duration"]=$ss['total_duration'];
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
            //$message["time"]=$sel['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*---------fetch_driver_ride_now_list-------*/
    
     /*-------fetch_driver_ride_later_list-------*/
    function fetch_driver_ride_later_list()
    {
        include('config.php');
        $user_id=$_REQUEST['driver_id'];
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE `driver_id`='$user_id' AND ride_type ='Ride_later' AND status='New Booking'");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["booking_id"]=$sel['trip_id'];
            $booking_id = $sel['trip_id'];
            
            $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['source_add'];
            $message["destination_add"]=$ss['destination_add']; 
            $message["total_price"]=$sel['total_price'];
            $message["ride_type"]=$sel['ride_type'];
            // $message["distance"]=$ss['total_distance'];
            // $message["duration"]=$ss['total_duration'];
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
            //$message["time"]=$sel['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*--------fetch_driver_ride_later_list---------*/
    
    /*---------fetch_user_ride_now_list-------*/
    function fetch_user_ride_now_list()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $type= $_REQUEST['type'];  // All..... In_City.....Out_City
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        
        if($start_date=='' && $end_date=='')
        {
            if($type=='All')
            {
                $array= array();
               // $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (driver_status!='cancel' AND driver_status!='end_ride' AND driver_status!='Complete') AND (city_status='In City' OR city_status='Out City') ORDER BY id DESC");
               $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (city_status='In City' OR city_status='Out City') ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    // $booking_id = $sel['trip_id'];
                    // $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    // $ss = mysqli_fetch_assoc($select);
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                  //  $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                   // $message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='In_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND city_status='In City' AND ride_type ='Ride_now' AND (driver_status != 'cancel' AND driver_status != 'end_ride' AND driver_status != 'Complete') ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                    //$message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='Out_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND city_status='Out City' AND (driver_status!='cancel' AND driver_status!='end_ride' AND driver_status!='Complete') ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                   // $message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
        }
        elseif($start_date!='' && $end_date!='')
        {
            if($type=='All')
            {
                $array= array();
                //$upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (driver_status!='cancel' AND driver_status!='end_ride' AND driver_status!='Complete') AND (city_status='In City' OR city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
               $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (city_status='In City' OR city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                    //$message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='In_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (driver_status!='cancel' AND driver_status!='end_ride' AND driver_status!='Complete') AND (city_status='In City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                //die(mysqli_error($con));
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                  //  $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                   // $message["status"]=$ss['driver_status'];
                   $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='Out_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_now' AND (driver_status!='cancel' AND driver_status!='end_ride' AND driver_status!='Complete') AND (city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                 //   $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                   // $message["status"]=$ss['driver_status'];
                   $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$ss['total_fare'];
                    $message["trip_total"]=$ss['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
        }
    }
    /*---------fetch_user_ride_now_list-------*/
    
    /*---------fetch_user_ride_later_list-------*/
    function fetch_user_ride_later_list()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $type= $_REQUEST['type'];  // All..... In_City.....Out_City
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        
        if($start_date=='' && $end_date=='')
        {
            if($type=='All')
            {
                $array= array();
               // $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (driver_status='New Booking') AND (city_status='In City' OR city_status='Out City')");
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (city_status='In City' OR city_status='Out City')");
               //echo mysqli_num_rows($upd);
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    // $booking_id = $sel['trip_id'];
                    // $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    // $ss = mysqli_fetch_assoc($select);
                    //$message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                    //$message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='In_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND city_status='In City' AND ride_type ='Ride_later' AND (driver_status='New Booking')");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                   // $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                    //$message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                   // $message["status"]=$ss['driver_status'];
                   $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='Out_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (driver_status='New Booking') AND (city_status='Out City')");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                   // $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                    //$message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                  // $message["status"]=$ss['driver_status'];
                  $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
        }
        elseif($start_date!='' && $end_date!='')
        {
            if($type=='All')
            {
                $array= array();
               // $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (driver_status='New Booking') AND (city_status='In City' OR city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (city_status='In City' OR city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                  //  $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                    //$message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                    //$message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='In_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (driver_status='New Booking') AND (city_status='In City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                //die(mysqli_error($con));
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                   // $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                    //$message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            elseif($type=='Out_City')
            {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND ride_type ='Ride_later' AND (driver_status='New Booking') AND (city_status='Out City') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')) ORDER BY id DESC");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                   // $message["user_name"]=$ss['u_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    $date = $ss['ride_date'];
                    $new_date = date('m-d-Y', strtotime($date));
                    $message["ride_date"]=$new_date;
                    $message["ride_time"]=$ss['ride_time'];
                   // $message["duration"]=$ss['total_duration'];
                    $message["package_name"]=$ss['package_name'];
                  //  $message["status"]=$ss['driver_status'];
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    $message["grand_total"]=$sel['total_fare'];
                    $message["trip_total"]=$sel['trip_fare'];
                    $message["discount"]=$ss['discount'];
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
        }
    }
    /*---------fetch_user_ride_later_list-------*/
    
    /*------driver_intrested_booking_status----*/
    function driver_intrested_booking_status()
    {
        include "config.php";
        $driver_id = $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        
        $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
        $ss = mysqli_fetch_assoc($select);
        $user_id = $ss['user_id'];
        $ride_type = $ss['ride_type'];
        
        if($ride_type=='Ride_now')
        {
            $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
            if($del)
            {
                /// user Notification
                  
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase1();
                $push = new Push1();
                
                // optional payload
                $payload = array();
                $payload['team'] = 'India';
                $payload['score'] = '7.6';
                
                // notification title
                $title1= "Booking Accepted";
                // notification message
                $message1="You Booking #$booking_id has been accepted by driver";
                
               // $include_image = "";
                $push->setTitle($title);
                $push->setMessage($message);
                
                $push->setIsBackground(FALSE);
                $push->setPayload($payload);
                
                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                $number_of_rows=mysqli_num_rows($sql_userId);
                
                if($number_of_rows==0)
                {
                  // $msg["result"]="unsuccessful";
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $time = date('h:i A');
        
                    $row=mysqli_fetch_assoc($sql_userId);
                    $ds=$row['device_status'];
                    if($ds=='IOS' || $ds=='Android')
                    {
                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
           
                        $regId=$row['device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $response = $firebase->send($regId, $json);
                        
                        $deviceToken=$row['iosdevice_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $iosresponse = $firebase->send($deviceToken, $json);
                            //IOS notification code
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            
                      //The device token.
                        if($ds=='IOS')
                        {
                            $token = $deviceToken;
                        }
                        elseif($ds=='Android')
                        {
                            $token = $regId;
                        }
                        //Title of the Notification.
                        $titlez = $title1;
                        //Body of the Notification.
                        $body =$message1;
                        $type=$type;
                        //Creating the notification array.
                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                        
                        $json = json_encode($arrayToSend);
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                    }
                }
        
        
               /// Driver Notification
        
                include ('config.php');
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase1();
                $push = new Push1();
                
                // optional payload
                $payload = array();
                $payload['team'] = 'India';
                $payload['score'] = '7.6';
                
                // notification title
                $title= "Booking Accepted";
                // notification message
                $message="You accepted request for Booking #$booking_id";
                
               // $include_image = "";
                $push->setTitle($title);
                $push->setMessage($message);;
                $push->setIsBackground(FALSE);
                $push->setPayload($payload);
                
                
                $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                $number_of_rows1=mysqli_num_rows($sql_userId);
                
                if($number_of_rows1==0)
                {
                    $msg["result"]="unsuccessful";
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $time = date('h:i A');
        
                    $row1=mysqli_fetch_assoc($sql_userId);
                    $ds=$row1['device_status'];
                    if($ds=='IOS' || $ds=='Android')
                    {
                        $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                   VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
            
                        $regId=$row1['Driver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $response = $firebase->send($regId, $json);
                        
                        $deviceToken=$row1['iosDriver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $iosresponse = $firebase->send($deviceToken, $json);
                            //IOS notification code
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            
                        //The device token.
                        if($ds=='IOS')
                        {
                            $token = $deviceToken;
                        }
                        elseif($ds=='Android')
                        {
                            $token = $regId;
                        }
                        //Title of the Notification.
                        $titlez = $title;
                        //Body of the Notification.
                        $body =$message;
                        $type=$type;
                        //Creating the notification array.
                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                        
                        $json = json_encode($arrayToSend);
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                        $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                        
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                    }
                    
                }   
                    /// Driver Notification    
              $del1=mysqli_query($con,"UPDATE `notification_tbl` SET driver_id='$driver_id', driver_status='confirm' WHERE id ='$booking_id'");
          
              $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
              $result['result']='success';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        elseif($ride_type=='Ride_later')
        {
            $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
            if($del)
            {
                /// user Notification
                  
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase1();
                $push = new Push1();
                
                // optional payload
                $payload = array();
                $payload['team'] = 'India';
                $payload['score'] = '7.6';
                
                // notification title
                $title1= "Booking Accepted";
                // notification message
                $message1="You Booking #$booking_id has been accepted by driver";
                
               // $include_image = "";
                $push->setTitle($title);
                $push->setMessage($message);
                
                $push->setIsBackground(FALSE);
                $push->setPayload($payload);
                
                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                $number_of_rows=mysqli_num_rows($sql_userId);
                
                if($number_of_rows==0)
                {
                  // $msg["result"]="unsuccessful";
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $time = date('h:i A');
        
                    $row=mysqli_fetch_assoc($sql_userId);
                    $ds=$row['device_status'];
                    if($ds=='IOS' || $ds=='Android')
                    {
                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
           
                        $regId=$row['device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $response = $firebase->send($regId, $json);
                        
                        $deviceToken=$row['iosdevice_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $iosresponse = $firebase->send($deviceToken, $json);
                            //IOS notification code
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            
                      //The device token.
                        if($ds=='IOS')
                        {
                            $token = $deviceToken;
                        }
                        elseif($ds=='Android')
                        {
                            $token = $regId;
                        }
                        //Title of the Notification.
                        $titlez = $title1;
                        //Body of the Notification.
                        $body =$message1;
                        $type=$type;
                        //Creating the notification array.
                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                        
                        $json = json_encode($arrayToSend);
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                    }
                }
        
        
               /// Driver Notification
        
                include ('config.php');
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase1();
                $push = new Push1();
                
                // optional payload
                $payload = array();
                $payload['team'] = 'India';
                $payload['score'] = '7.6';
                
                // notification title
                $title= "Booking Accepted";
                // notification message
                $message="You accepted request for Booking #$booking_id";
                
               // $include_image = "";
                $push->setTitle($title);
                $push->setMessage($message);;
                $push->setIsBackground(FALSE);
                $push->setPayload($payload);
                
                
                $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                $number_of_rows1=mysqli_num_rows($sql_userId);
                
                if($number_of_rows1==0)
                {
                    $msg["result"]="unsuccessful";
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $time = date('h:i A');
        
                    $row1=mysqli_fetch_assoc($sql_userId);
                    $ds=$row1['device_status'];
                    if($ds=='IOS' || $ds=='Android')
                    {
                        $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                   VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
            
                        $regId=$row1['Driver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $response = $firebase->send($regId, $json);
                        
                        $deviceToken=$row1['iosDriver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $iosresponse = $firebase->send($deviceToken, $json);
                            //IOS notification code
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            
                        //The device token.
                        if($ds=='IOS')
                        {
                            $token = $deviceToken;
                        }
                        elseif($ds=='Android')
                        {
                            $token = $regId;
                        }
                        //Title of the Notification.
                        $titlez = $title;
                        //Body of the Notification.
                        $body =$message;
                        $type=$type;
                        //Creating the notification array.
                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                        
                        $json = json_encode($arrayToSend);
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                        $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                        
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                    }
                    
                }   
                    /// Driver Notification    
              $del1=mysqli_query($con,"UPDATE `notification_tbl` SET driver_id='$driver_id', driver_status='pending' WHERE id ='$booking_id'");
          
              $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
              $result['result']='success';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
      
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_intrested_booking_status-----*/
    
    /*------driver_cancel_booking_status----*/
    function driver_cancel_booking_status()
    {
        include "config.php";
        $driver_id = $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        $reason=$_REQUEST['reason'];
       // date_default_timezone_set('Asia/Kolkata');
       date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $com_id = $sel['company_id'];
       
        $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
       //die(mysqli_error($con));
        if($del)
        {
          $ins=mysqli_query($con,"INSERT INTO canclebooking_driver(company_id,driver_id,status,reason,booking_id,`cancel_time`, `cancel_date`) VALUES('$com_id','$driver_id','cancle','$reason','$booking_id','$time','$date')");
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_cancel_booking_status-----*/
    
    /*----user_end_driver_accepted_bid_list-----*/
    function user_end_driver_accepted_bid_list()
    {
        include "config.php";
        $path="https://cisswork.com/Android/SenderApp/images/";
        $user_id =  $_REQUEST['user_id'];
        $company_id =  $_REQUEST['company_id'];
        $distance = $_REQUEST['distance'];
        $duration = $_REQUEST['duration'];
        $rating =  $_REQUEST['rating'];
        $vehicle_type = $_REQUEST['vehicle_type_id'];
        $booking_id = $_REQUEST['booking_id'];
        $status = 'intrested';
      
        if($distance=='Near TO Far')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE `trip_id`='$booking_id' AND status='intrested' AND user_id='$user_id' AND company_id='$company_id' AND duration<='$duration' AND vehicle_type_id='$vehicle_type' order By distance ASC");
            while($sel=mysqli_fetch_assoc($upd))
            {
                $driver_id = $sel['driver_id'];
                
                $p1=mysqli_query($con,"SELECT AVG( `driver_rated`) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                if($rp1>=$rating)
                {
                    $message["rating"]=round($rp1,1);
                    $message["driver_id"]=$sel['driver_id'];
                    $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    $ss = mysqli_fetch_assoc($select);
                    
                    $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                    $row = mysqli_fetch_assoc($sql);
                    $message["driver_name"]=$row['fullname'].$row['surname'];
                    if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                    // $message["price_fare"]=strval($sel['total_price'] + $sel['tolloption_price']);
                    $message["price_fare"]=strval($sel['total_price']);
                    $message["tolloption"]=$sel['tolloption'];
                    $message["tolloption_price"]=$sel['tolloption_price'];
                    $message["distance"]=$ss['total_distance'];
                    $message["duratintime"]=$ss['total_duration'];
                    $message["car_type"]=$ss['car_type_name'];
                    array_push($array,$message);
                }
            } 
        }
        elseif($distance=='Far TO Near')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE `trip_id`='$booking_id' AND status='intrested' AND user_id='$user_id' AND company_id='$company_id' AND duration<='$duration' AND vehicle_type_id='$vehicle_type' order By distance DESC");
            while($sel=mysqli_fetch_assoc($upd))
            {
                $driver_id = $sel['driver_id'];
                
                $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                if($rp1>=$rating)
                {
                    $message["rating"]=round($rp1,1);
                    $message["driver_id"]=$sel['driver_id'];
                    $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    $ss = mysqli_fetch_assoc($select);
                    
                    $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                    $row = mysqli_fetch_assoc($sql);
                    $message["driver_name"]=$row['fullname'].$row['surname'];
                    if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                    // $message["price_fare"]=strval($sel['total_price']+$sel['tolloption_price']);
                    $message["price_fare"]=strval($sel['total_price']);
                    $message["tolloption"]=$sel['tolloption'];
                    $message["tolloption_price"]=$sel['tolloption_price'];
                    $message["distance"]=$ss['total_distance'];
                    $message["duratintime"]=$ss['total_duration'];
                    $message["car_type"]=$ss['car_type_name'];
                    array_push($array,$message);
                }
            } 
        }
        else
        {
            $array= array();
            $s = mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE trip_id='$booking_id' AND status='intrested'");
            //echo  mysqli_num_rows($s);
            while($sel=mysqli_fetch_assoc($s))
            {
                $message["driver_id"]=$sel['driver_id'];
               
                $message["booking_id"] = $sel['trip_id'];
                
                $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                $ss = mysqli_fetch_assoc($select);
                
                $driver_id= $sel['driver_id'];
                $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                $row = mysqli_fetch_assoc($sql);
                $message["driver_name"]=$row['fullname'].$row['surname'];
                if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
               // $message["price_fare"]=strval($sel['total_price']+$sel['tolloption_price']);
                $message["price_fare"]=strval($sel['total_price']);
                $message["tolloption"]=$sel['tolloption'];
                $message["tolloption_price"]=$sel['tolloption_price'];
                $message["distance"]=$ss['total_distance'];
                $message["duratintime"]=$ss['total_duration'];
                $message["car_type"]=$ss['car_type_name'];
                $p1=mysqli_query($con,"SELECT AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                if($rp1=='')
                {
                   $message["rating"]='0'; 
                }
                 else
                 {
                 $message["rating"]=round($rp1,1);
                 }
                //$message["rating"]=$sel['time'];
                array_push($array,$message);
            }
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
        
    }
    /*----user_end_driver_accepted_bid_list-----*/
    
    /*------user_reject_driver_bid_status----*/
    function user_reject_driver_bid_status()
    {
        include "config.php";
        $user_id =  $_REQUEST['user_id'];
        $driver_id = $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $com_id = $sel['company_id'];
       
        $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
       //die(mysqli_error($con));
        if($del)
        {
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----user_reject_driver_bid_status-----*/
    
    /*------user_accept_driver_bid_status----*/
    function user_accept_driver_bid_status()
    {
        include "config.php";
        $user_id =  $_REQUEST['user_id'];
        $driver_id = $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $com_id = $sel['company_id'];
        $car_id = $sel['car_id'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $wallet = $sel1['user_wallet'];
        
        $upd2=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id'");
        $sel2=mysqli_fetch_assoc($upd2);
        $lynk_id = $sel2['card_id'];
        
        $upd3=mysqli_query($con,"SELECT * FROM `tbl_user_lynk_id` WHERE `id`='$lynk_id'");
        $sel3=mysqli_fetch_assoc($upd3);
        $lynk_name = $sel3['lynk_name'];
        
        $upd_new=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
        $sel_new=mysqli_fetch_assoc($upd_new);
        $ride_type = $sel_new['ride_type'];
        $total_price = $sel_new['total_price'];
        $distance_price = $sel_new['distance_price'];
        $base_price = $sel_new['base_price'];
        $admin_commission = $sel_new['admin_commission'];
        $trip_fare = $sel_new['trip_fare'];
        $total_fare = $sel_new['total_fare'];
        $discount = $sel_new['discount'];
        $payment_mode = $sel2['payment_mode'];  // Cash ... Wallet ... Online
        $tolloption_price=$sel_new['tolloption_price'];
       // $d_amount = $total_price + $tolloption_price - $admin_commission ;
        $new_driver_amount = $tolloption_price+$total_price;
        // $new_am = $wallet-$total_price;
        $new_total = $total_price+$tolloption_price;
        $new_am = $wallet-$new_total;
        if($ride_type=='Ride_now')
        {
            if($payment_mode=='Cash')
            {
               
                $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                if($del)
                {
                                /// user Notification
                                  
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title1= "Bid Accepted";
                                // notification message
                                $message1="You accepted bid request for Booking #$booking_id";
                                
                               // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                      //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        //Title of the Notification.
                                        $titlez = $title1;
                                        //Body of the Notification.
                                        $body =$message1;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                    
                    
                                   /// Driver Notification
        
                                    include ('config.php');
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title= "Bid Accepted";
                                    // notification message
                                    $message="User accepted bid request for Booking #$booking_id";
                                    
                                   // $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);;
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                    $number_of_rows1=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows1==0)
                                    {
                                        $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
        
                                        $row1=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row1['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                       VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                
                                            $regId=$row1['Driver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row1['iosDriver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                            //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title;
                                            //Body of the Notification.
                                            $body =$message;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                            
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                        
                                    }   
                        /// Driver Notification    
                  $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='confirm',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price' WHERE id ='$booking_id'");
              
                  $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                  $result['result']='success';
                }
                else
                {
                  $result['result']='unsuccess';  
                }
            }
            elseif($payment_mode=='Wallet')
            {
                if($wallet>=$new_am)
                {
                    $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                    if($del)
                    {
                                    /// user Notification
                                      
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title1= "Bid Accepted";
                                    // notification message
                                    $message1="You accepted bid request for Booking #$booking_id";
                                    
                                   // $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);
                                    
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                    $number_of_rows=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows==0)
                                    {
                                      // $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
                        
                                        $row=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                         VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                               
                                            $regId=$row['device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row['iosdevice_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                          //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title1;
                                            //Body of the Notification.
                                            $body =$message1;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                    }
                        
                                       /// Driver Notification
            
                                        include ('config.php');
                                        require_once __DIR__ . '/firebase.php';
                                        require_once __DIR__ . '/push.php';
                                        
                                        $firebase = new Firebase1();
                                        $push = new Push1();
                                        
                                        // optional payload
                                        $payload = array();
                                        $payload['team'] = 'India';
                                        $payload['score'] = '7.6';
                                        
                                        // notification title
                                        $title= "Bid Accepted";
                                        // notification message
                                        $message="User accepted bid request for Booking #$booking_id";
                                        
                                       // $include_image = "";
                                        $push->setTitle($title);
                                        $push->setMessage($message);;
                                        $push->setIsBackground(FALSE);
                                        $push->setPayload($payload);
                                        
                                        
                                        $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                        $number_of_rows1=mysqli_num_rows($sql_userId);
                                        
                                        if($number_of_rows1==0)
                                        {
                                            $msg["result"]="unsuccessful";
                                        }
                                        else
                                        {
                                            date_default_timezone_set('Asia/Kolkata');
                                            $date = date('Y-m-d');
                                            $time = date('h:i A');
            
                                            $row1=mysqli_fetch_assoc($sql_userId);
                                            $ds=$row1['device_status'];
                                            if($ds=='IOS' || $ds=='Android')
                                            {
                                                $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                           VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                    
                                                $regId=$row1['Driver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $response = $firebase->send($regId, $json);
                                                
                                                $deviceToken=$row1['iosDriver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $iosresponse = $firebase->send($deviceToken, $json);
                                                    //IOS notification code
                                                $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                    
                                                //The device token.
                                                if($ds=='IOS')
                                                {
                                                    $token = $deviceToken;
                                                }
                                                elseif($ds=='Android')
                                                {
                                                    $token = $regId;
                                                }
                                                //Title of the Notification.
                                                $titlez = $title;
                                                //Body of the Notification.
                                                $body =$message;
                                                $type=$type;
                                                //Creating the notification array.
                                                $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                                
                                                //This array contains, the token and the notification. The 'to' attribute stores the token.
                                                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                                
                                                $json = json_encode($arrayToSend);
                                                //Setup headers:
                                                $headers = array();
                                                $headers[] = 'Content-Type: application/json';
                                                $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                                //Setup curl, add headers and post parameters.
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                                //Send the request
                                                $response = curl_exec($ch);
                                                
                                                //Close request
                                                curl_close($ch);
                                            }
                                            
                                        }   
                            /// Driver Notification    
                        $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='confirm',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price' WHERE id ='$booking_id'");
                  
                        $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                        
                        $del3=mysqli_query($con,"UPDATE `user_register` SET user_wallet='$new_am' WHERE id ='$user_id'");
                        $result['result']='success';
                    }
                    else
                    {
                      $result['result']='unsuccess';  
                    }
                }
                else
                {
                    $result['result']='Your wallet balance is less than payment amount';  
                }
            }
            elseif($payment_mode=='Online')
            {
                $data = array(
                    "client_id" => "aBoUVcFaL7b30xDhx2eODUhlYxjBKOiZ",
                    "client_secret" => "kEnQOrc7k6tDSbvIXgh308npc37XS-c17KA37RME8iCXtX6uRzhWUhMbcm9d13rO",
                    "audience" => "https://api.core-nautilus.net/payment_orders",
                    "grant_type" => "client_credentials"
                );
                
                $options = array(
                    CURLOPT_URL =>'https://auth.beta.lynk.us/oauth/token',
                    CURLOPT_HTTPHEADER => array( 'Content-Type: application/json'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($data)
                );
                $ch = curl_init();
                curl_setopt_array($ch, $options);
                 $response = curl_exec($ch);
                //if (curl_errno($ch)) { echo 'Error: ' . curl_error($ch);}
                curl_close($ch);
                $api_Data = json_decode($response, true);
                $token = $api_Data['access_token'];
                
                $data_new = array(
                    // "lynk_id" => "@lynkbiz-pay",
                    "lynk_id" => $lynk_name,
                    "account_id"  => 4255,
                    "amount_to_pay"  =>$total_price,
                    "currency"  => "JMD",
                    "description" => "Test Description",
                    "external_order_id" =>$booking_id,
                    "notification_url" => "http://123.123.123.123:54321/api"
                );
                $curl_pay = curl_init();
                $options_new = array(
                    CURLOPT_URL => 'https://non-prod-api.lynk.us/online_payments/beta_1/v1/payment-orders',
                    CURLOPT_HTTPHEADER => array( 'Content-Type: application/json','Authorization: Bearer'.' '.$token),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($data_new)
                );
                curl_setopt_array($curl_pay, $options_new);
                $response_pay = curl_exec($curl_pay);
                curl_close($curl_pay);
                $res_data = json_decode($response_pay, true);
                
                $status = $res_data['status'];
                $m_order_id = $res_data['m_order_id'];
                $external_order_id = $res_data['external_order_id'];
                $amount_to_pay = $res_data['amount_to_pay'];
                $currency = $res_data['currency'];
                $datetime = $res_data['datetime'];
                $lynk_id = $res_data['lynk_id'];
                $lynk_payment_id = $res_data['lynk_payment_id'];
                
                if($status=='RECEIVED')
                {
                    $sel=mysqli_query($con,"INSERT INTO `booking_transaction_history`(`external_order_id`, `m_order_id`, `amount_to_pay`, `currency`, `lynk_id`, `lynk_payment_id`,status, `datetime`) 
                            VALUES('$external_order_id','$m_order_id','$amount_to_pay','$currency','$lynk_id','$lynk_payment_id','$status','$datetime')");
                   
                    $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                
                    $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='confirm',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price' WHERE id ='$booking_id'");
              
                    $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                                 
                                  /// user Notification
                                  
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title1= "Bid Accepted";
                                // notification message
                                $message1="You accepted bid request for Booking #$booking_id";
                                
                               // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                      //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        
                                        //Title of the Notification.
                                        $titlez = $title1;
                                        //Body of the Notification.
                                        $body =$message1;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                       $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                                 
                                 
                                   /// Driver Notification
        
                                    include ('config.php');
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title= "Bid Accepted";
                                    // notification message
                                    $message="User accepted Bid request for Booking #$booking_id";
                                    
                                  //  $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);;
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                    $number_of_rows1=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows1==0)
                                    {
                                        $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
        
                                        $row1=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row1['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                       VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                
                                            $regId=$row1['Driver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row1['iosDriver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                            //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title;
                                            //Body of the Notification.
                                            $body =$message;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                             $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                        
                                    }   
                        /// Driver Notification
                    $result['result']='success';
                
                }
                else
                {
                    $result["result"] = "unsuccess"; 
                } 
            }
            
        }
        elseif($ride_type=='Ride_later')
        {
            if($payment_mode=='Cash')
            {
                $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                if($del)
                {
                                /// user Notification
                                  
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title1= "Bid Accepted";
                                // notification message
                                $message1="You accepted bid request for Booking #$booking_id";
                                
                               // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                      //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        //Title of the Notification.
                                        $titlez = $title1;
                                        //Body of the Notification.
                                        $body =$message1;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                        $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                    
                                   /// Driver Notification
        
                                    include ('config.php');
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title= "Bid Accepted";
                                    // notification message
                                    $message="User accepted bid request for Booking #$booking_id";
                                    
                                   // $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);;
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                    $number_of_rows1=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows1==0)
                                    {
                                        $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
        
                                        $row1=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row1['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                       VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                
                                            $regId=$row1['Driver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row1['iosDriver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                            //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title;
                                            //Body of the Notification.
                                            $body =$message;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                             $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                        
                                    }   
                        /// Driver Notification    
                  $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='pending',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price' WHERE id ='$booking_id'");
              
                  $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                  $result['result']='success';
                }
                else
                {
                  $result['result']='unsuccess';  
                }
            }
            elseif($payment_mode=='Wallet')
            {
                if($wallet>=$new_am)
                {
                    $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                    if($del)
                    {
                                    /// user Notification
                                      
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title1= "Bid Accepted";
                                    // notification message
                                    $message1="You accepted bid request for Booking #$booking_id";
                                    
                                   // $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);
                                    
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                    $number_of_rows=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows==0)
                                    {
                                      // $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
                        
                                        $row=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                         VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                               
                                            $regId=$row['device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row['iosdevice_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                          //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title1;
                                            //Body of the Notification.
                                            $body =$message1;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                    }
                        
                                       /// Driver Notification
            
                                        include ('config.php');
                                        require_once __DIR__ . '/firebase.php';
                                        require_once __DIR__ . '/push.php';
                                        
                                        $firebase = new Firebase1();
                                        $push = new Push1();
                                        
                                        // optional payload
                                        $payload = array();
                                        $payload['team'] = 'India';
                                        $payload['score'] = '7.6';
                                        
                                        // notification title
                                        $title= "Bid Accepted";
                                        // notification message
                                        $message="User accepted bid request for Booking #$booking_id";
                                        
                                       // $include_image = "";
                                        $push->setTitle($title);
                                        $push->setMessage($message);;
                                        $push->setIsBackground(FALSE);
                                        $push->setPayload($payload);
                                        
                                        
                                        $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                        $number_of_rows1=mysqli_num_rows($sql_userId);
                                        
                                        if($number_of_rows1==0)
                                        {
                                            $msg["result"]="unsuccessful";
                                        }
                                        else
                                        {
                                            date_default_timezone_set('Asia/Kolkata');
                                            $date = date('Y-m-d');
                                            $time = date('h:i A');
            
                                            $row1=mysqli_fetch_assoc($sql_userId);
                                            $ds=$row1['device_status'];
                                            if($ds=='IOS' || $ds=='Android')
                                            {
                                                $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                           VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                    
                                                $regId=$row1['Driver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $response = $firebase->send($regId, $json);
                                                
                                                $deviceToken=$row1['iosDriver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $iosresponse = $firebase->send($deviceToken, $json);
                                                    //IOS notification code
                                                $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                    
                                                //The device token.
                                                if($ds=='IOS')
                                                {
                                                    $token = $deviceToken;
                                                }
                                                elseif($ds=='Android')
                                                {
                                                    $token = $regId;
                                                }
                                                //Title of the Notification.
                                                $titlez = $title;
                                                //Body of the Notification.
                                                $body =$message;
                                                $type=$type;
                                                //Creating the notification array.
                                                $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                                
                                                //This array contains, the token and the notification. The 'to' attribute stores the token.
                                                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                                
                                                $json = json_encode($arrayToSend);
                                                //Setup headers:
                                                $headers = array();
                                                $headers[] = 'Content-Type: application/json';
                                               $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                                //Setup curl, add headers and post parameters.
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                                //Send the request
                                                $response = curl_exec($ch);
                                                
                                                //Close request
                                                curl_close($ch);
                                            }
                                            
                                        }   
                            /// Driver Notification    
                        $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='pending',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price' WHERE id ='$booking_id'");
                  
                        $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                        
                        $del3=mysqli_query($con,"UPDATE `user_register` SET user_wallet='$new_am' WHERE id ='$user_id'");
                        $result['result']='success';
                    }
                    else
                    {
                      $result['result']='unsuccess';  
                    }
                }
                else
                {
                    $result['result']='Your wallet balance is less than payment amount';  
                }
            }
            elseif($payment_mode=='Online')
            {
                $data = array(
                    "client_id" => "aBoUVcFaL7b30xDhx2eODUhlYxjBKOiZ",
                    "client_secret" => "kEnQOrc7k6tDSbvIXgh308npc37XS-c17KA37RME8iCXtX6uRzhWUhMbcm9d13rO",
                    "audience" => "https://api.core-nautilus.net/payment_orders",
                    "grant_type" => "client_credentials"
                );
                
                $options = array(
                    CURLOPT_URL =>'https://auth.beta.lynk.us/oauth/token',
                    CURLOPT_HTTPHEADER => array( 'Content-Type: application/json'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($data)
                );
                $ch = curl_init();
                curl_setopt_array($ch, $options);
                 $response = curl_exec($ch);
                //if (curl_errno($ch)) { echo 'Error: ' . curl_error($ch);}
                curl_close($ch);
                $api_Data = json_decode($response, true);
                $token = $api_Data['access_token'];
                
                $data_new = array(
                    // "lynk_id" => "@lynkbiz-pay",
                    "lynk_id" => $lynk_name,
                    "account_id"  => 4255,
                    "amount_to_pay"  =>$total_price,
                    "currency"  => "JMD",
                    "description" => "Test Description",
                    "external_order_id" =>$booking_id,
                    "notification_url" => "http://123.123.123.123:54321/api"
                );
                $curl_pay = curl_init();
                $options_new = array(
                    CURLOPT_URL => 'https://non-prod-api.lynk.us/online_payments/beta_1/v1/payment-orders',
                    CURLOPT_HTTPHEADER => array( 'Content-Type: application/json','Authorization: Bearer'.' '.$token),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($data_new)
                );
                curl_setopt_array($curl_pay, $options_new);
                $response_pay = curl_exec($curl_pay);
                curl_close($curl_pay);
                $res_data = json_decode($response_pay, true);
                
                $status = $res_data['status'];
                $m_order_id = $res_data['m_order_id'];
                $external_order_id = $res_data['external_order_id'];
                $amount_to_pay = $res_data['amount_to_pay'];
                $currency = $res_data['currency'];
                $datetime = $res_data['datetime'];
                $lynk_id = $res_data['lynk_id'];
                $lynk_payment_id = $res_data['lynk_payment_id'];
                
                if($status=='RECEIVED')
                {
                    $sel=mysqli_query($con,"INSERT INTO `booking_transaction_history`(`external_order_id`, `m_order_id`, `amount_to_pay`, `currency`, `lynk_id`, `lynk_payment_id`,status, `datetime`) 
                            VALUES('$external_order_id','$m_order_id','$amount_to_pay','$currency','$lynk_id','$lynk_payment_id','$status','$datetime')");
                   
                    $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id' AND user_id='$user_id'");
                
                    $del1=mysqli_query($con,"UPDATE `notification_tbl` SET company_id='$com_id',driver_id='$driver_id', driver_status='pending',car_id='$car_id',base_fare_cost='$base_price',per_km_cost='$distance_price',total_trip_cost='$new_total',admin_commission='$admin_commission',driver_earning='$new_driver_amount',`trip_fare`='$trip_fare',`total_fare`='$total_fare',`discount`='$discount',`tolloption_price`='$tolloption_price'WHERE id ='$booking_id'");
              
                    $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
                                 
                                  /// user Notification
                                  
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title1= "Bid Accepted";
                                // notification message
                                $message1="You accepted bid request for Booking #$booking_id";
                                
                               // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$user_id','','$title1','$message1','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                      //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        
                                        //Title of the Notification.
                                        $titlez = $title1;
                                        //Body of the Notification.
                                        $body =$message1;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                        $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                                 
                                 
                                   /// Driver Notification
        
                                    include ('config.php');
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title= "Bid Accepted";
                                    // notification message
                                    $message="User accepted Bid request for Booking #$booking_id";
                                    
                                  //  $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);;
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                    $number_of_rows1=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows1==0)
                                    {
                                        $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
        
                                        $row1=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row1['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                       VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                
                                            $regId=$row1['Driver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row1['iosDriver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                            //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title;
                                            //Body of the Notification.
                                            $body =$message;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                        
                                    }   
                        /// Driver Notification
                    $result['result']='success';
                
                }
                else
                {
                    $result["result"] = "unsuccess"; 
                } 
            }
            
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----user_accept_driver_bid_status-----*/
    
    /*------fetch_user_confirm_booking_driver_details-------*/
    function fetch_user_confirm_booking_driver_details()
    {
        include "config.php";
        $user_id =  $_REQUEST['user_id'];
        //$booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $current = (new \DateTime())->format('d-m-Y h:i A');
       // $array= array();
        $path="https://cisswork.com/Android/SenderApp/images/";
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND (driver_status='confirm'  OR driver_status='accept' OR driver_status='arrived' OR driver_status='start_ride' OR driver_status='onthe_way' OR driver_status='end_ride')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            $booking_id = $ss['id'];
            $ride_date=$ss['ride_date'];
            $ride_time=$ss['ride_time'];
            $ride_type = $ss['ride_type'];
            if(strtotime($current) <= strtotime($ride_date." ".$ride_time) && $ride_type='Ride_later')
            {
                $message["booking_id"]=$ss['id'];
                $message["driver_id"]=$ss['driver_id'];
                $driver_id = $ss['driver_id'];
                $upd=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
                $sel=mysqli_fetch_assoc($upd);
                $message["package_name"]=$ss['package_name'];
                $message["source_add"]=$ss['source_add'];
                $message["source_lat"]=$ss['source_lat'];
                $message["source_long"]=$ss['source_long'];
                $message["destination_add"]=$ss['destination_add'];
                $message["destination_lat"]=$ss['destination_lat'];
                $message["destination_long"]=$ss['destination_long'];
                $message["total_price"]=strval($ss['total_fare']);
                $message["ride_date"]=$ss['ride_date'];
                $message["ride_time"]=$ss['ride_time'];
                $message["driver_name"]=$sel['FirstName'].$sel['LastName'];
                $message["driver_contact"]=$sel['country_code'].$sel['Phone'];
                if($sel['image']=='')
                {
                   $message["Image"]='';  
                }
                else
                {
                 $message["Image"]=$path.$sel['image'];
                }
                
                $message["driver_lat"]=($sel['Driver_lat'] !="")?$sel['Driver_lat']:"";
                $message["driver_lng"]=($sel['Driver_lng'] !="")?$sel['Driver_lng']:"";
                $message["rotation"]=($sel['rotation'] !="")?$sel['rotation']:"";
                
                if($ss['ride_type']=='Ride_later')
                {
                   $message["ride_type"]='Ride Later';  
                }
                elseif($ss['ride_type']=='Ride_now')
                {
                 $message["ride_type"]='Ride Now';
                }
                
                $p1=mysqli_query($con,"SELECT AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                $new_r = round($rp1,1);
                if($rp1=='')
                {
                    $message["rating"]='0'; 
                }
                else
                {
                 $str =  strval($new_r); 
                 $message["rating"]=$str;
                 
                }
                
                $status=$ss['driver_status'];
                if($status=='confirm')
                {
                   $message["status"]= 'Your Driver is Arriving';
                }
                elseif($status=='pending')
                {
                    $message["status"] = 'Pending';
                }
                elseif($status=='accept')
                {
                    $message["status"] = 'Your Driver is Arrived';
                }
                elseif($status=='arrived')
                {
                   $message["status"] = 'Your Driver is Arrived';
                }
                elseif($status=='start_ride')
                {
                    $message["status"] = 'Your Driver Has Started Ride';
                }
                elseif($status=='onthe_way')
                {
                    $message["status"] = 'Your Driver is On the Way';     
                }
                elseif($status=='end_ride' || $status=='Complete')
                {
                   $message["status"] = 'Your Ride has Completed'; 
                }
                elseif($status=='cancel' && $ss['cancel_by']=='User')
                {
                    $message["status"] = 'Cancelled by user';
                }
                elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                {
                  $message["status"] = 'Cancelled by driver';
                }
                else
                {
                  $message["status"] = 'Pending';
                }
                $message["confirmation_code"]=$ss['confirmation_code'];
                $message["Location_url"]="https://cisswork.com/Android/SenderApp/Current_Location.php?id=".$booking_id;
            }
            elseif($ride_type='Ride_now')
            {
                $message["booking_id"]=$ss['id'];
                $message["driver_id"]=$ss['driver_id'];
                $driver_id = $ss['driver_id'];
                $upd=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
                $sel=mysqli_fetch_assoc($upd);
                $message["package_name"]=$ss['package_name'];
                $message["source_add"]=$ss['source_add'];
                $message["source_lat"]=$ss['source_lat'];
                $message["source_long"]=$ss['source_long'];
                $message["destination_add"]=$ss['destination_add'];
                $message["destination_lat"]=$ss['destination_lat'];
                $message["destination_long"]=$ss['destination_long'];
                $message["total_price"]=strval($ss['total_fare']);
                $message["ride_date"]=$ss['ride_date'];
                $message["ride_time"]=$ss['ride_time'];
                $message["driver_name"]=$sel['FirstName'].$sel['LastName'];
                $message["driver_contact"]=$sel['country_code'].$sel['Phone'];
                if($sel['image']=='')
                {
                   $message["Image"]='';  
                }
                else
                {
                 $message["Image"]=$path.$sel['image'];
                }
                
                $message["driver_lat"]=($sel['Driver_lat'] !="")?$sel['Driver_lat']:"";
                $message["driver_lng"]=($sel['Driver_lng'] !="")?$sel['Driver_lng']:"";
                $message["rotation"]=($sel['rotation'] !="")?$sel['rotation']:"";
                
                if($ss['ride_type']=='Ride_later')
                {
                   $message["ride_type"]='Ride Later';  
                }
                elseif($ss['ride_type']=='Ride_now')
                {
                 $message["ride_type"]='Ride Now';
                }
                
                $p1=mysqli_query($con,"SELECT AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                $new_r = round($rp1,1);
                if($rp1=='')
                {
                    $message["rating"]='0'; 
                }
                else
                {
                 $str =  strval($new_r); 
                 $message["rating"]=$str;
                 
                }
                
                $status=$ss['driver_status'];
                if($status=='confirm')
                {
                   $message["status"]= 'Your Driver is Arriving';
                }
                elseif($status=='pending')
                {
                    $message["status"] = 'Pending';
                }
                elseif($status=='accept')
                {
                    $message["status"] = 'Your Driver is Arrived';
                }
                elseif($status=='arrived')
                {
                   $message["status"] = 'Your Driver is Arrived';
                }
                elseif($status=='start_ride')
                {
                    $message["status"] = 'Your Driver Has Started Ride';
                }
                elseif($status=='onthe_way')
                {
                    $message["status"] = 'Your Driver is On the Way';     
                }
                elseif($status=='end_ride' || $status=='Complete')
                {
                   $message["status"] = 'Your Ride has Completed'; 
                }
                elseif($status=='cancel' && $ss['cancel_by']=='User')
                {
                    $message["status"] = 'Cancelled by user';
                }
                elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                {
                  $message["status"] = 'Cancelled by driver';
                }
                else
                {
                  $message["status"] = 'Pending';
                }
                $message["confirmation_code"]=$ss['confirmation_code'];
                $message["Location_url"]="https://cisswork.com/Android/SenderApp/Current_Location.php?id=".$booking_id;
            }
            elseif(strtotime($current) > strtotime($ride_date." ".$ride_time) && $ride_type='Ride_later')
            {
                $message["booking_id"]='';
                $message["driver_id"]='';
                $driver_id = $ss['driver_id'];
                $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                $sel=mysqli_fetch_assoc($upd);
                $message["package_name"]='';
                $message["source_add"]='';
                $message["source_lat"]='';
                $message["source_long"]='';
                $message["destination_add"]='';
                $message["destination_lat"]='';
                $message["destination_long"]='';
                $message["total_price"]='';
                $message["ride_date"]='';
                $message["ride_time"]='';
                $message["driver_name"]='';
                $message["driver_contact"]='';
                if($sel['image']=='')
                {
                   $message["Image"]='';  
                }
                
                if($ss['ride_type']=='')
                {
                   $message["ride_type"]='';  
                }
                
                $message["rating"]=''; 
                $message["status"]="";
                $message["confirmation_code"]="";
                $message["Location_url"]="";
            }
        }
        else
        {
            $message["booking_id"]='';
            $message["driver_id"]='';
            $driver_id = $ss['driver_id'];
            $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["package_name"]='';
            $message["source_add"]='';
            $message["source_lat"]='';
            $message["source_long"]='';
            $message["destination_add"]='';
            $message["destination_lat"]='';
            $message["destination_long"]='';
            $message["total_price"]='';
            $message["ride_date"]='';
            $message["ride_time"]='';
            $message["driver_name"]='';
            $message["driver_contact"]='';
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            
            if($ss['ride_type']=='')
            {
               $message["ride_type"]='';  
            }
            
            $message["rating"]=''; 
            $message["status"]="";
            $message["confirmation_code"]="";
            $message["Location_url"]="";
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*----fetch_user_confirm_booking_driver_details-----*/
    
    /*------driver_fetch_confirm_booking_user_details-------*/
    function driver_fetch_confirm_booking_user_details()
    {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $current = (new \DateTime())->format('d-m-Y h:i A');
        $path="https://cisswork.com/Android/SenderApp/images/";
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND (driver_status='confirm' OR driver_status='accept' OR driver_status='arrived' OR driver_status='start_ride' OR driver_status='onthe_way')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            $ride_date=$ss['ride_date'];
            $ride_time=$ss['ride_time'];
            $ride_type = $ss['ride_type'];
            $booking_id = $ss['id'];
            $message["booking_id"]=$ss['id'];
            $message["user_id"]=$ss['user_id'];
            $user_id = $ss['user_id'];
            $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["source_add"]=$ss['source_add'];
            $message["source_lat"]=$ss['source_lat'];
            $message["source_long"]=$ss['source_long'];
            $message["destination_add"]=$ss['destination_add'];
            $message["destination_lat"]=$ss['destination_lat'];
            $message["destination_long"]=$ss['destination_long'];
            $message["total_price"]=($ss['total_fare'] != "")?$ss['total_fare'] :0;
            if($ss['ride_type']=='Ride_later')
            {
               $message["ride_type"]='Ride Later';  
            }
            elseif($ss['ride_type']=='Ride_now')
            {
             $message["ride_type"]='Ride Now';
            }
            $message["payment_mode"]=$ss['payment_mode'];
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
            $message["user_name"]=$sel['full_name']." ".$sel['sur_name']; 
            $message["contact"]=$sel['country_code'].$sel['contact'];
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            else
            {
             $message["Image"]=$path.$sel['image'];
            }
            
            $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
            $p1f=mysqli_fetch_assoc($p1);
            $rp1=$p1f['rating'];
            $cp1=$p1f['count'];
            // $np1=$rp1/$cp1;
            if($cp1=='')
            {
                $message["rating"]='0'; 
            }
            else
            {
             $message["rating"]=round($rp1,1);
            }
            
            $status=$ss['driver_status'];
            if($status=='confirm')
            {
               $message["status"]= 'Confirmed';
            }
            elseif($status=='accept')
            {
                $message["status"] = 'Accepted';
            }
            elseif($status=='arrived')
            {
               $message["status"] = 'Arrived';
            }
            elseif($status=='start_ride')
            {
                $message["status"] = 'Start Ride';
            }
            elseif($status=='onthe_way')
            {
                $message["status"] = 'On the Way';     
            }
            elseif($status=='end_ride' || $status=='Complete')
            {
               $message["status"] = 'Complete'; 
            }
            elseif($status=='cancel' && $ss['cancel_by']=='User')
            {
                $message["status"] = 'Cancelled by user';
            }
            elseif($status=='cancel' && $ss['cancel_by']=='Driver')
            {
              $message["status"] = 'Cancelled by driver';
            }
            $message["confirmation_code"]=$ss['confirmation_code'];
            $message["Location_url"]="https://cisswork.com/Android/SenderApp/Current_Location_driver.php?id=".$booking_id;
        }
        else
        {
            $message["booking_id"]='';
            $message["user_id"]='';
            $user_id = $ss['user_id'];
            $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["source_add"]='';
            $message["source_lat"]='';
            $message["source_long"]='';
            $message["destination_add"]='';
            $message["destination_lat"]='';
            $message["destination_long"]='';
            $message["total_price"]='';
            if($ss['ride_type']=='')
            {
               $message["ride_type"]='';  
            }
           
            $message["payment_mode"]='';
            $message["ride_date"]='';
            $message["ride_time"]='';
            $message["user_name"]='';
            $message["contact"]='';
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            
            $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
            $p1f=mysqli_fetch_assoc($p1);
            $rp1=$p1f['rating'];
            $cp1=$p1f['count'];
            // $np1=$rp1/$cp1;
            if($cp1=='')
            {
                $message["rating"]=''; 
            }
            else
            {
                 $message["rating"]=round($rp1,1);
            }
            $message["status"]=''; 
            $message["confirmation_code"]='';
            $message["Location_url"]="";
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*----driver_fetch_confirm_booking_user_details-----*/
    
    /*------user_cancel_booking----*/
    function user_cancel_booking()
    {
        include "config.php";
        $user_id =  $_REQUEST['user_id'];
        $cancel_reason = $_REQUEST['cancel_reason'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id'");
        $sel=mysqli_fetch_assoc($upd);
        $driver_id = $sel['driver_id'];
        $pay_type = $sel['payment_mode'];
        
        $upd2=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel2=mysqli_fetch_assoc($upd2);
        $com_id = $sel2['company_id'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $wallet = $sel1['user_wallet'];
        $new_total =$sel['total_trip_cost'];
        $new_am = $wallet+$new_total;
       
        $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='cancel',cancel_by='User',cancel_reason='$cancel_reason',driver_earning='0' WHERE id ='$booking_id' AND user_id='$user_id'");
       //die(mysqli_error($con));
        if($del)
        {
                                /// Driver Notification
    
                                include ('config.php');
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title= "Booking Cancellation";
                                // notification message
                                $message="User has cancelled Booking #$booking_id";
                                
                               // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);;
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
                                $number_of_rows1=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows1==0)
                                {
                                    $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
    
                                    $row1=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row1['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                   VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
                                                   
                                        $sql2=mysqli_query($con,"INSERT INTO `canclebooking`(user_id,`company_id`, `driver_id`, `status`, `reason`, `booking_id`, `cancel_time`, `cancel_date`)
                                        VALUES ('$user_id','$com_id','$driver_id','cancle','$cancel_reason','$booking_id','$time','$date')");
                                         
                                        if($pay_type == 'Wallet')
                                        {
                                           $del3=mysqli_query($con,"UPDATE `user_register` SET user_wallet='$new_am' WHERE id ='$user_id'");
                                        }    
                                            
                                        $regId=$row1['Driver_device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row1['iosDriver_device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                        //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        //Title of the Notification.
                                        $titlez = $title;
                                        //Body of the Notification.
                                        $body =$message;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                    
                                }   
                    
    
    
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----user_cancel_booking-----*/
    
    /*------driver_cancel_booking----*/
    function driver_cancel_booking()
    {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id'];
        $cancel_reason = $_REQUEST['cancel_reason'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id'");
        $sel=mysqli_fetch_assoc($upd);
        $user_id = $sel['user_id'];
        $new_total = $sel['total_trip_cost'];
        $pay_type = $sel['payment_mode'];
        
        $upd2=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel2=mysqli_fetch_assoc($upd2);
        $com_id = $sel2['company_id'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $wallet = $sel1['user_wallet'];
        $new_am = $wallet+$new_total;
    
        
        
        $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='cancel',cancel_by='Driver',cancel_reason='$cancel_reason',driver_earning='0' WHERE id ='$booking_id' AND driver_id='$driver_id'");
      //die(mysqli_error($con));
        if($del)
        {
                  /// user Notification
                
                  require_once __DIR__ . '/firebase.php';
                    require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase1();
                    $push = new Push1();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                     
                    // notification title
                    $title= "Booking Cancellation";
                    // notification message
                    $message="Driver has cancelled Booking #$booking_id";
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                    $number_of_rows=mysqli_num_rows($sql_userId);
                    
                    if($number_of_rows==0)
                    {
                      // $msg["result"]="unsuccessful";
                    }
                    else
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('Y-m-d');
                        $time = date('h:i A');
        
                        $row=mysqli_fetch_assoc($sql_userId);
                        $ds=$row['device_status'];
                        if($ds=='IOS' || $ds=='Android')
                        {
                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                         VALUES ('$booking_id','$user_id','','$title','$message','$date','$time','System')");
               
                             $sql2=mysqli_query($con,"INSERT INTO `canclebooking_driver`(user_id,`company_id`, `driver_id`, `status`, `reason`, `booking_id`, `cancel_time`, `cancel_date`)
                                        VALUES ('$user_id','$com_id','$driver_id','cancle','$cancel_reason','$booking_id','$time','$date')");
                                        
                            if($pay_type == 'Wallet')
                            {
                                $del3=mysqli_query($con,"UPDATE `user_register` SET user_wallet='$new_am' WHERE id ='$user_id'");
                            } 
       
                            $regId=$row['device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $response = $firebase->send($regId, $json);
                            
                            $deviceToken=$row['iosdevice_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                                //IOS notification code
                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                            //The device token.
                            if($ds=='IOS')
                            {
                                $token = $deviceToken;
                            }
                            elseif($ds=='Android')
                            {
                                $token = $regId;
                            }
    
                            //The device token.
                            //$token = $regId;
                            //Title of the Notification.
                            $titlez = $title;
                            //Body of the Notification.
                            $body =$message;
                            $type=$type;
                            //Creating the notification array.
                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                            
                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                            
                            $json = json_encode($arrayToSend);
                          //Setup headers:
                            $headers = array();
                            $headers[] = 'Content-Type: application/json';
                             $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                            //Setup curl, add headers and post parameters.
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                            //Send the request
                            $response = curl_exec($ch);
                            
                            //Close request
                            curl_close($ch);
                        }
                    }
                /// user Notification
    
          $result['result']='success';
        }
        else
        {
          $result['result']='unsuccess';  
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_cancel_booking-----*/
     
    /*------filter_driver_bid_list----*/
    function filter_driver_bid_list() 
    {
        include "config.php";
        $path="https://cisswork.com/Android/SenderApp/images/";
        $user_id =  $_REQUEST['user_id'];
        $company_id =  $_REQUEST['company_id'];
        $distance = $_REQUEST['distance'];
        $duration = $_REQUEST['duration'];
        $rating =  $_REQUEST['rating'];
        $vehicle_type = $_REQUEST['vehicle_type_id'];
        //$booking_id = $_REQUEST['booking_id'];
       
         
        if($distance=='Near TO Far')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE status='intrested' AND user_id='$user_id' AND company_id='$company_id' AND duration<='$duration' AND vehicle_type_id='$vehicle_type' order By distance ASC");
            while($sel=mysqli_fetch_assoc($upd))
            {
                $driver_id = $sel['driver_id'];
                
                $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                $cp1=$p1f['count'];
                if($rp1>=$rating)
                {
                    $message["rating"]=round($rp1,1);
                    $message["driver_id"]=$sel['driver_id'];
                    $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    $ss = mysqli_fetch_assoc($select);
                    
                    $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                    $row = mysqli_fetch_assoc($sql);
                    $message["driver_name"]=$row['fullname'].$row['surname'];
                    if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                    $message["price_fare"]=$sel['total_price'];
                    $message["distance"]=$ss['total_distance'];
                    $message["duratintime"]=$ss['total_duration'];
                    $message["car_type"]=$ss['car_type_name'];
                    array_push($array,$message);
                }
            } 
        }
        elseif($distance=='Far TO Near')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE status='intrested' AND user_id='$user_id' AND company_id='$company_id' AND duration<='$duration' AND vehicle_type_id='$vehicle_type' order By distance DESC");
            while($sel=mysqli_fetch_assoc($upd))
            {
                $driver_id = $sel['driver_id'];
                
                $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['rating'];
                $cp1=$p1f['count'];
                if($rp1>=$rating)
                {
                    $message["rating"]=round($rp1,1);
                    $message["driver_id"]=$sel['driver_id'];
                    $select = mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
                    $ss = mysqli_fetch_assoc($select);
                    
                    $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
                    $row = mysqli_fetch_assoc($sql);
                    $message["driver_name"]=$row['fullname'].$row['surname'];
                    if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                    $message["price_fare"]=$sel['total_price'];
                    $message["distance"]=$ss['total_distance'];
                    $message["duratintime"]=$ss['total_duration'];
                    $message["car_type"]=$ss['car_type_name'];
                    array_push($array,$message);
                }
            } 
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
        
        
    }
    /*----filter_driver_bid_list-----*/
    
    /*---------fetch_driver_Ride_later_booking_list-------*/
    function fetch_driver_Ride_later_booking_list()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        date_default_timezone_set('Asia/Kolkata');
        $current = (new \DateTime())->format('d-m-Y h:i A');
        
        if($start_date=='' && $end_date=='')
        {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND ride_type='Ride_later' AND (driver_status='pending')");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_id"]=$ss['user_id'];
                    $user_id = $ss['user_id'];
                    $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
                    $sel=mysqli_fetch_assoc($upd);
                    $message["package_name"]=$ss['package_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["source_lat"]=$ss['source_lat'];
                    $message["source_long"]=$ss['source_long'];
                    $message["destination_add"]=$ss['destination_add'];
                    $message["destination_lat"]=$ss['destination_lat'];
                    $message["destination_long"]=$ss['destination_long'];
                    $status = $ss['driver_status'];
                    $message["total_price"] = ($status=='cancel')?0:strval($ss['total_fare']);
                    if($ss['ride_type']=='Ride_later')
                    {
                       $message["ride_type"]='Ride Later';  
                    }
                    elseif($ss['ride_type']=='Ride_now')
                    {
                     $message["ride_type"]='Ride Now';
                    }
                    $message["payment_mode"]=$ss['payment_mode'];
                    $message["ride_date"]=$ss['ride_date'];
                    $message["ride_time"]=$ss['ride_time'];
                    $message["ride_end_date"]=$ss['ride_end_date'];
                    $message["ride_end_time"]=$ss['ride_end_time'];
                    $message["user_name"]=$sel['full_name']." ".$sel['sur_name'];
                    if($sel['image']=='')
                    {
                       $message["Image"]='';  
                    }
                    else
                    {
                     $message["Image"]=$path.$sel['image'];
                    }
                    
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
        }
        elseif($start_date!='' && $end_date!='')
        {
                $array= array();
                $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND ride_type='Ride_later' AND (STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y'))AND (driver_status='pending')");
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["user_id"]=$ss['user_id'];
                    $user_id = $ss['user_id'];
                    $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
                    $sel=mysqli_fetch_assoc($upd);
                    $message["package_name"]=$ss['package_name'];
                    $message["source_add"]=$ss['source_add'];
                    $message["source_lat"]=$ss['source_lat'];
                    $message["source_long"]=$ss['source_long'];
                    $message["destination_add"]=$ss['destination_add'];
                    $message["destination_lat"]=$ss['destination_lat'];
                    $message["destination_long"]=$ss['destination_long'];
                    $status = $ss['driver_status'];
                    $message["total_price"] = ($status=='cancel')?0:strval($ss['total_fare']);
                    if($ss['ride_type']=='Ride_later')
                    {
                       $message["ride_type"]='Ride Later';  
                    }
                    elseif($ss['ride_type']=='Ride_now')
                    {
                     $message["ride_type"]='Ride Now';
                    }
                    $message["payment_mode"]=$ss['payment_mode'];
                    $message["ride_date"]=$ss['ride_date'];
                    $message["ride_time"]=$ss['ride_time'];
                    $message["ride_end_date"]=$ss['ride_end_date'];
                    $message["ride_end_time"]=$ss['ride_end_time'];
                    $message["user_name"]=$sel['full_name']." ".$sel['sur_name'];
                    if($sel['image']=='')
                    {
                       $message["Image"]='';  
                    }
                    else
                    {
                     $message["Image"]=$path.$sel['image'];
                    }
                    
                    $status=$ss['driver_status'];
                    if($status=='confirm')
                    {
                       $message["status"]= 'Confirmed';
                    }
                    elseif($status=='accept')
                    {
                        $message["status"] = 'Accepted';
                    }
                    elseif($status=='arrived')
                    {
                       $message["status"] = 'Arrived';
                    }
                    elseif($status=='start_ride')
                    {
                        $message["status"] = 'Start Ride';
                    }
                    elseif($status=='onthe_way')
                    {
                        $message["status"] = 'On the Way';     
                    }
                    elseif($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='User')
                    {
                        $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $row['cancel_by']=='Driver')
                    {
                      $message["status"] = 'Cancelled by driver';
                    }
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
        }
    }
    /*---------fetch_driver_Ride_later_booking_list-------*/
    
    /*------driver_update_booking_status----*/
    function driver_update_booking_status()
    {
        include "config.php"; 
        require_once 'stripe-payment/vendor/autoload.php'; // Include Stripe PHP library
    
        $driver_id =  $_REQUEST['driver_id'];
        $status = $_REQUEST['status'];
        $booking_id = $_REQUEST['booking_id'];
        $end_date = $_REQUEST['end_date'];
        $end_time = $_REQUEST['end_time'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $date1 = date('m-d-Y');
        $time = date('h:i A');
        $v_code = mt_rand(100000, 999999);
        $upd=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `id`='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $com_id = $sel['company_id'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $user_id = $sel1['user_id'];
       
        $Test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
        $Live_key = '';
    
        
        if($status=='arrived')
        {
            $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='arrived',confirmation_code='$v_code' WHERE id ='$booking_id' AND driver_id='$driver_id'");
           //die(mysqli_error($con));
            if($del)
            {
                  
                   /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase1();
                    $push = new Push1();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                     
                    // notification title
                     $title= "Driver Arrival";
                    // notification message
                    $message="Driver is arriving for Booking #$booking_id";
                    
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                    $number_of_rows=mysqli_num_rows($sql_userId);
                    
                    if($number_of_rows==0)
                    {
                      // $msg["result"]="unsuccessful";
                    }
                    else
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('Y-m-d');
                        $time = date('h:i A');
        
                        $row=mysqli_fetch_assoc($sql_userId);
                        $ds=$row['device_status'];
                        if($ds=='IOS' || $ds=='Android')
                        {
                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                         VALUES ('$booking_id','$user_id','','$title','$message','$date','$time','System')");
               
                            $regId=$row['device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $response = $firebase->send($regId, $json);
                            
                            $deviceToken=$row['iosdevice_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                                //IOS notification code
                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                            //The device token.
                            if($ds=='IOS')
                            {
                                $token = $deviceToken;
                            }
                            elseif($ds=='Android')
                            {
                                $token = $regId;
                            }
    
                            //The device token.
                            //$token = $regId;
                            //Title of the Notification.
                            $titlez = $title;
                            //Body of the Notification.
                            $body =$message;
                            $type=$type;
                            //Creating the notification array.
                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                            
                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                            
                            $json = json_encode($arrayToSend);
                          //Setup headers:
                            $headers = array();
                            $headers[] = 'Content-Type: application/json';
                             $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                            //Setup curl, add headers and post parameters.
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                            //Send the request
                            $response = curl_exec($ch);
                            
                            //Close request
                            curl_close($ch);
                        }
                    }
                /// user Notification
    
              $result['confirmation_code']=$v_code;
              $result['result']='arrived successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        elseif($status=='start_ride')
        {
            $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='start_ride' WHERE id ='$booking_id' AND driver_id='$driver_id'");
           //die(mysqli_error($con));
            if($del)
            {
               /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase1();
                    $push = new Push1();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                    // notification title
                    $title= "Ride Started";
                    // notification message
                    $message="Your ride #$booking_id has been started";
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                    $number_of_rows=mysqli_num_rows($sql_userId);
                    
                    if($number_of_rows==0)
                    {
                      // $msg["result"]="unsuccessful";
                    }
                    else
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('Y-m-d');
                        $time = date('h:i A');
        
                        $row=mysqli_fetch_assoc($sql_userId);
                        $ds=$row['device_status'];
                        if($ds=='IOS' || $ds=='Android')
                        {
                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                         VALUES ('$booking_id','$user_id','','$title','$message','$date','$time','System')");
               
                            $regId=$row['device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $response = $firebase->send($regId, $json);
                            
                            $deviceToken=$row['iosdevice_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                                //IOS notification code
                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                            //The device token.
                            if($ds=='IOS')
                            {
                                $token = $deviceToken;
                            }
                            elseif($ds=='Android')
                            {
                                $token = $regId;
                            }
    
                            //The device token.
                            //$token = $regId;
                            //Title of the Notification.
                            $titlez = $title;
                            //Body of the Notification.
                            $body =$message;
                            $type=$type;
                            //Creating the notification array.
                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                            
                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                            
                            $json = json_encode($arrayToSend);
                          //Setup headers:
                            $headers = array();
                            $headers[] = 'Content-Type: application/json';
                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                            //Setup curl, add headers and post parameters.
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                            //Send the request
                            $response = curl_exec($ch);
                            
                            //Close request
                            curl_close($ch);
                        }
                    }
                /// user Notification
    
    
              $result['result']='started ride successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        elseif($status=='onthe_way')
        {
            $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='onthe_way' WHERE id ='$booking_id' AND driver_id='$driver_id'");
            //die(mysqli_error($con));
            if($del)
            {
                /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase1();
                    $push = new Push1();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                      // notification title
                     $title= "Ride Started";
                    // notification message
                    $message="Your ride #$booking_id is on the way";
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                    $number_of_rows=mysqli_num_rows($sql_userId);
                    
                    if($number_of_rows==0)
                    {
                      // $msg["result"]="unsuccessful";
                    }
                    else
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('Y-m-d');
                        $time = date('h:i A');
        
                        $row=mysqli_fetch_assoc($sql_userId);
                        $ds=$row['device_status'];
                        if($ds=='IOS' || $ds=='Android')
                        {
                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                         VALUES ('$booking_id','$user_id','','$title','$message','$date','$time','System')");
               
                            $regId=$row['device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $response = $firebase->send($regId, $json);
                            
                            $deviceToken=$row['iosdevice_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                                //IOS notification code
                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                            //The device token.
                            if($ds=='IOS')
                            {
                                $token = $deviceToken;
                            }
                            elseif($ds=='Android')
                            {
                                $token = $regId;
                            }
    
                            //The device token.
                            //$token = $regId;
                            //Title of the Notification.
                            $titlez = $title;
                            //Body of the Notification.
                            $body =$message;
                            $type=$type;
                            //Creating the notification array.
                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                            
                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                            
                            $json = json_encode($arrayToSend);
                          //Setup headers:
                            $headers = array();
                            $headers[] = 'Content-Type: application/json';
                             $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                            //Setup curl, add headers and post parameters.
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                            //Send the request
                            $response = curl_exec($ch);
                            
                            //Close request
                            curl_close($ch);
                        }
                    }
                /// user Notification
    
              $result['result']='On The Way successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        elseif($status=='end_ride')
        {
            $select_com= mysqli_query($con,"SELECT * FROM  `notification_tbl` WHERE id='$booking_id'"); 
            $row_com=mysqli_fetch_assoc($select_com);
            $start_date = $row_com['ride_date'];
            $start_time = $row_com['ride_time'];
            $user_id = $row_com['user_id'];
            $coupon_id = $row_com['coupon_id'];
            $payment_mode =  $row_com['payment_mode'];
            $payment_id = $row_com['payment_id'];
            
            $datetime_1 = $start_date." ".$start_time; 
            $datetime_2 = $end_date." ".$end_time; 
            $from_time = strtotime($datetime_1); 
            $to_time = strtotime($datetime_2); 
            $diff_minutes = round(abs($from_time - $to_time) / 60,2);
            
            try 
            {
                $stripe = new \Stripe\StripeClient($Test_key);
                
                // Payment Intent ID
                //$paymentIntentId = 'pi_3P12NXIhs7ZBuE9x25qFxQcs'; // Replace with your actual Payment Intent ID
                 $paymentIntentId =$payment_id;
                // Capture the payment intent
                $capture = $stripe->paymentIntents->capture($paymentIntentId);
            
                // Handle capture success
                 $result['payment_status']=  "Payment intent captured successfully.";
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Handle error
                 $result['payment_status']=  "Error capturing payment intent: " . $e->getMessage();
            }
     
            $query = "UPDATE `notification_tbl` SET `total_duration`='$diff_minutes', driver_status='end_ride',`ride_end_date`='$end_date',`ride_end_time`='$end_time' WHERE id ='$booking_id' AND driver_id='$driver_id'";
            $update= mysqli_multi_query($con, $query);
            if($update)
            {
               /// Driver Notification
               
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase1();
                $push = new Push1();
                
                // optional payload
                $payload = array();
                $payload['team'] = 'India';
                $payload['score'] = '7.6';
                
                // notification title
                $title= "Regarding Booking";
                // notification message
                $message="You completed ride #$booking_id";
                
              // $include_image = "";
                $push->setTitle($title);
                $push->setMessage($message);;
                $push->setIsBackground(FALSE);
                $push->setPayload($payload);
                
                
                $sql_userId=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID ='$driver_id'");
                $number_of_rows1=mysqli_num_rows($sql_userId);
                
                if($number_of_rows1==0)
                {
                    $msg["result"]="unsuccessful";
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $time = date('h:i A');
    
                    $row1=mysqli_fetch_assoc($sql_userId);
                    $ds=$row1['device_status'];
                    if($ds=='IOS' || $ds=='Android')
                    {
                        $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                  VALUES ('$booking_id','','$driver_id','$title','$message','$date','$time','System')");
            
                        $regId=$row1['Driver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $response = $firebase->send($regId, $json);
                        
                        $deviceToken=$row1['iosDriver_device_id'];
                        $json = '';
                        $response = '';
                        $json = $push->getPush();
                        $iosresponse = $firebase->send($deviceToken, $json);
                            //IOS notification code
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            
                         //The device token.
                        if($ds=='IOS')
                        {
                            $token = $deviceToken;
                        }
                        elseif($ds=='Android')
                        {
                            $token = $regId;
                        }
                        //Title of the Notification.
                        $titlez = $title;
                        //Body of the Notification.
                        $body =$message;
                        $type=$type;
                        //Creating the notification array.
                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                        
                        $json = json_encode($arrayToSend);
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                    }
                    
                }   
                    /// Driver Notification
                    
                  /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase1();
                    $push = new Push1();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                     // notification title
                    $title= "Regarding Booking";
                    // notification message
                    $message="Your ride #$booking_id has completed";
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
                    $number_of_rows=mysqli_num_rows($sql_userId);
                    
                    if($number_of_rows==0)
                    {
                      // $msg["result"]="unsuccessful";
                    }
                    else
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('Y-m-d');
                        $time = date('h:i A');
        
                        $row=mysqli_fetch_assoc($sql_userId);
                        $ds=$row['device_status'];
                        if($ds=='IOS' || $ds=='Android')
                        {
                            $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                         VALUES ('$booking_id','$user_id','','$title','$message','$date','$time','System')");
               
                            $regId=$row['device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $response = $firebase->send($regId, $json);
                            
                            $deviceToken=$row['iosdevice_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                                //IOS notification code
                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                            //The device token.
                            if($ds=='IOS')
                            {
                                $token = $deviceToken;
                            }
                            elseif($ds=='Android')
                            {
                                $token = $regId;
                            }
    
                            //The device token.
                            //$token = $regId;
                            //Title of the Notification.
                            $titlez = $title;
                            //Body of the Notification.
                            $body =$message;
                            $type=$type;
                            //Creating the notification array.
                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                            
                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                            
                            $json = json_encode($arrayToSend);
                          //Setup headers:
                            $headers = array();
                            $headers[] = 'Content-Type: application/json';
                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                            //Setup curl, add headers and post parameters.
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                            //Send the request
                            $response = curl_exec($ch);
                            
                            //Close request
                            curl_close($ch);
                        }
                    }
                /// user Notification
    
              $result['result']='completed successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_update_booking_status-----*/
    
    /*----driver_completed_booking_data-----*/
     function driver_completed_booking_data()
     {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id']; 
        $select = mysqli_query($con,"select * from notification_tbl WHERE driver_id='$driver_id' AND (driver_status='Complete' OR driver_status='end_ride')");
        $rating=mysqli_query($con,"select count(id) as book_id, SUM(total_fare) as earning from notification_tbl WHERE driver_id='$driver_id' AND (driver_status='Complete' OR driver_status='end_ride')");
        $count = mysqli_num_rows($select);
        $row_r=mysqli_fetch_assoc($rating);
        // $rating=mysqli_query($con,"select count(id) as book_id, SUM(driver_earning) as earning from notification_tbl WHERE driver_id='$driver_id' AND driver_status ='New Booking' OR driver_status!='pending'");
       if($count>0)
       {
         $message['Total_booking'] = $row_r['book_id'];
         $message['Total_earning'] = $row_r['earning'];
       }
       else
       {
         $message['Total_booking'] =0;
         $message['Total_earning'] = 0;
       }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);
        die;
     }
    /*----driver_completed_booking_data-----*/
    
    /*---------fetch_driver_booking_history_list-------*/
    function fetch_driver_booking_history_list()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        
        if($start_date=='' && $end_date=='')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND  (driver_status='cancel' OR driver_status='end_ride' OR driver_status='Complete')");
            $count = mysqli_num_rows($upd);
            if($count>0)
            {
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    // $message["total_price"]=$ss['driver_earning']; 
                    $message["ride_type"]=$ss['ride_type'];
                    $message["ride_date"]=$ss['ride_date'];
                    $message["ride_time"]=$ss['ride_time'];
                    $message["ride_end_date"]=$ss['ride_end_date'];
                    $message["ride_end_time"]=$ss['ride_end_time'];
                    $message["package_name"]=$ss['package_name'];
                    $status =$ss['driver_status'];
                    if($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $ss['cancel_by']=='User')
                    {
                       $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                    {
                        $message["status"] = 'Cancelled by driver';
                    }
                    
                    
                    if($status=='end_ride' || $status=='Complete')
                    {
                        $message["total_price"]=strval($ss['total_fare']);
                    }
                    elseif($status=='cancel')
                    {
                        $message["total_price"]=0;
                    }
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            else
            {
               echo json_encode($array, JSON_UNESCAPED_SLASHES); 
               die;  
            }
           
        }
        elseif($start_date!='' && $end_date!='')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND (driver_status='cancel' OR driver_status='end_ride' OR driver_status='Complete') AND STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')");
           //  $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND (driver_status='cancel' OR driver_status='end_ride' OR driver_status='Complete') AND (ride_date BETWEEN '$start_date' AND '$end_date')");
            $count = mysqli_num_rows($upd);
            if($count>0)
            {
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"]=$ss['id'];
                    $message["source_add"]=$ss['source_add'];
                    $message["destination_add"]=$ss['destination_add'];
                    // $message["total_price"]=$ss['driver_earning']; 
                    $message["ride_type"]=$ss['ride_type'];
                    $message["ride_date"]=$ss['ride_date'];
                    $message["ride_time"]=$ss['ride_time'];
                    $message["ride_end_date"]=$ss['ride_end_date'];
                    $message["ride_end_time"]=$ss['ride_end_time'];
                    $message["package_name"]=$ss['package_name'];
                    $status =$ss['driver_status'];
                    if($status=='end_ride' || $status=='Complete')
                    {
                       $message["status"] = 'Complete'; 
                    }
                    elseif($status=='cancel' && $ss['cancel_by']=='User')
                    {
                       $message["status"] = 'Cancelled by user';
                    }
                    elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                    {
                        $message["status"] = 'Cancelled by driver';
                    }
                    
                    
                    if($status=='end_ride' || $status=='Complete')
                    {
                        $message["total_price"]=strval($ss['total_fare']);
                    }
                    elseif($status=='cancel')
                    {
                        $message["total_price"]=0;
                    }
                    array_push($array,$message);
                }
                array_walk_recursive($array,function(&$item){$item=strval($item);});
                echo json_encode($array, JSON_UNESCAPED_SLASHES); 
                die; 
            }
            else
            {
               echo json_encode($array, JSON_UNESCAPED_SLASHES); 
               die;  
            }
            
        }
    }
    /*---------fetch_driver_booking_history_list-------*/
    
    /*------driver_fetch_booking_details-----*/
    function driver_fetch_booking_details()
    {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $path="https://cisswork.com/Android/SenderApp/images/";
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `driver_id`='$driver_id' AND id='$booking_id'");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            $message["booking_id"]=$ss['id'];
            $message["user_id"]=$ss['user_id'];
            $user_id = $ss['user_id'];
            $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["package_name"]=$ss['package_name'];
            $message["source_add"]=$ss['source_add'];
            $message["source_lat"]=$ss['source_lat'];
            $message["source_long"]=$ss['source_long'];
            $message["destination_add"]=$ss['destination_add'];
            $message["destination_lat"]=$ss['destination_lat'];
            $message["destination_long"]=$ss['destination_long'];
            $status = $ss['driver_status'];
            $message["total_price"] = ($status=='cancel')?0:strval($ss['total_fare']);
            
           // if($status=='cancel'){ $message["total_price"]=0;}else{ $message["total_price"]=strval($ss['driver_earning']); }
           
            if($ss['ride_type']=='Ride_later')
            {
               $message["ride_type"]='Ride Later';  
            }
            elseif($ss['ride_type']=='Ride_now')
            {
             $message["ride_type"]='Ride Now';
            }
            $message["payment_mode"]=$ss['payment_mode'];
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
            $message["ride_end_date"]=$ss['ride_end_date'];
            $message["ride_end_time"]=$ss['ride_end_time'];
            $message["user_name"]=$sel['full_name']." ".$sel['sur_name'];
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            else
            {
             $message["Image"]=$path.$sel['image'];
            }
            
            $status=$ss['driver_status'];
            if($status=='confirm')
            {
               $message["status"]= 'Confirmed';
            }
            elseif($status=='accept')
            {
                $message["status"] = 'Accepted';
            }
            elseif($status=='arrived')
            {
               $message["status"] = 'Arrived';
            }
            elseif($status=='start_ride')
            {
                $message["status"] = 'Start Ride';
            }
            elseif($status=='onthe_way')
            {
                $message["status"] = 'On the Way';     
            }
            elseif($status=='end_ride' || $status=='Complete')
            {
               $message["status"] = 'Complete'; 
            }
            elseif($status=='cancel' && $row['cancel_by']=='User')
            {
                $message["status"] = 'Cancelled by user';
            }
            elseif($status=='cancel' && $row['cancel_by']=='Driver')
            {
              $message["status"] = 'Cancelled by driver';
            }
           // $message["confirmation_code"]=$ss['confirmation_code'];
        }
        else
        {
           $message["booking_id"]='';
            $message["user_id"]='';
            $user_id = $ss['user_id'];
            $upd=mysqli_query($con,"SELECT * FROM `user_register` WHERE `id`='$user_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["car_type_name"]='';
            $message["source_add"]='';
            $message["source_lat"]='';
            $message["source_long"]='';
            $message["destination_add"]='';
            $message["destination_lat"]='';
            $message["destination_long"]='';
            $message["total_price"]='';
            $message["tolloption"]='';
            $message["tolloption_price"]='';
            if($ss['ride_type']=='')
            {
               $message["ride_type"]='';  
            }
           
            $message["payment_mode"]='';
            $message["distance"]='';
            $message["ride_date"]='';
            $message["ride_time"]='';
            $message["duration"]='';
            $message["user_name"]='';
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            
            // $p1=mysqli_query($con,"SELECT count(id) as count, SUM( `rating` ) AS rating FROM driver_rating_tbl WHERE driver_id='$driver_id'");   // changed
            // $p1f=mysqli_fetch_assoc($p1);
            // $rp1=$p1f['rating'];
            // $cp1=$p1f['count'];
            // // $np1=$rp1/$cp1;
            // if($cp1=='')
            // {
            //     $message["rating"]=''; 
            // }
            $message["status"]=''; 
          //  $message["confirmation_code"]='';
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;  
    }
    /*------driver_fetch_booking_details-----*/
    
    /*---------fetch_user_booking_history_list-------*/
    function fetch_user_booking_history_list()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $path="https://cisswork.com/Android/SenderApp/images/";
        
        if($start_date=='' && $end_date=='')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND  (driver_status='cancel' OR driver_status='end_ride' OR driver_status='Complete') ORDER BY id DESC");
            while($ss=mysqli_fetch_assoc($upd))
            {
                $message["booking_id"]=$ss['id'];
                $message["user_name"]=$ss['u_name'];
                $message["source_add"]=$ss['source_add'];
                $message["destination_add"]=$ss['destination_add'];
                $date = $ss['ride_date'];
                $new_date = date('m-d-Y', strtotime($date));
                $message["ride_date"]=$new_date;
                
                $message["ride_time"]=$ss['ride_time'];
                $message["package_name"]=$ss['package_name'];
                $message["status"]=$ss['driver_status'];
                $message["payment_mode"]=$ss['payment_mode'];
                $message["grand_total"]=$ss['total_fare'];
                $message["trip_total"]=$ss['trip_fare'];
                $message["discount"]=$ss['discount'];
                $message["ride_type"]=$ss['ride_type'];
                $message["ride_date"]=$ss['ride_date'];
                $message["ride_time"]=$ss['ride_time'];
                $message["ride_end_date"]=$ss['ride_end_date'];
                $message["ride_end_time"]=$ss['ride_end_time'];
                $status =$ss['driver_status'];
                if($status=='end_ride' || $status=='Complete')
                {
                   $message["status"] = 'Complete'; 
                }
                elseif($status=='cancel' && $ss['cancel_by']=='User')
                {
                   $message["status"] = 'Cancelled by user';
                }
                elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                {
                    $message["status"] = 'Cancelled by driver';
                }
                $driver_id= $ss['driver_id'];
                $message["driver_id"] =$ss['driver_id'];
                $sql=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
                $row = mysqli_fetch_assoc($sql);
                $message["driver_name"]=$row['FirstName'].$row['LastName'];
                if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                $p1=mysqli_query($con,"SELECT `driver_rated` FROM tbl_rating  WHERE driver_id='$driver_id' AND user_id='$user_id' AND booking_id='$booking_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['driver_rated'];
                $cp1=$p1f['count'];
                if($rp1==''){$message["rating"]='0'; } else{$message["rating"]=round($rp1,1);}
                array_push($array,$message);
            }
            array_walk_recursive($array,function(&$item){$item=strval($item);});
            echo json_encode($array, JSON_UNESCAPED_SLASHES); 
            die;   
        }
        elseif($start_date!='' && $end_date!='')
        {
            $array= array();
            $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `user_id`='$user_id' AND  (driver_status='cancel' OR driver_status='end_ride' OR driver_status='Complete') AND STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y') ORDER BY id DESC");
            while($ss=mysqli_fetch_assoc($upd))
            {
                $message["booking_id"]=$ss['id'];
                $message["user_name"]=$ss['u_name'];
                $message["source_add"]=$ss['source_add'];
                $message["destination_add"]=$ss['destination_add'];
                $date = $ss['ride_date'];
                $new_date = date('m-d-Y', strtotime($date));
                $message["ride_date"]=$new_date;
                $message["ride_time"]=$ss['ride_time'];
                $message["package_name"]=$ss['package_name'];
                $message["status"]=$ss['driver_status'];
                $message["payment_mode"]=$ss['payment_mode'];
                $message["grand_total"]=$ss['total_fare'];
                $message["trip_total"]=$ss['trip_fare'];
                $message["discount"]=$ss['discount'];
                $message["ride_type"]=$ss['ride_type'];
                $message["ride_date"]=$ss['ride_date'];
                $message["ride_time"]=$ss['ride_time'];
                $message["ride_end_date"]=$ss['ride_end_date'];
                $message["ride_end_time"]=$ss['ride_end_time'];
                $status =$ss['driver_status'];
                if($status=='end_ride' || $status=='Complete')
                {
                   $message["status"] = 'Complete'; 
                }
                elseif($status=='cancel' && $ss['cancel_by']=='User')
                {
                   $message["status"] = 'Cancelled by user';
                }
                elseif($status=='cancel' && $ss['cancel_by']=='Driver')
                {
                    $message["status"] = 'Cancelled by driver';
                }
                $driver_id= $ss['driver_id'];
                $message["driver_id"] =$ss['driver_id'];
                $sql=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
                $row = mysqli_fetch_assoc($sql);
                $message["driver_name"]=$row['FirstName'].$row['LastName'];
                if($row['image']==''){$message["driverimage"]='';}else{$message["driverimage"]=$path.$row['image'];}
                $p1=mysqli_query($con,"SELECT `driver_rated` FROM tbl_rating  WHERE driver_id='$driver_id' AND user_id='$user_id' AND booking_id='$booking_id'");   // changed
                $p1f=mysqli_fetch_assoc($p1);
                $rp1=$p1f['driver_rated'];
                $cp1=$p1f['count'];
                if($rp1==''){$message["rating"]='0'; } else{$message["rating"]=round($rp1,1);}
                array_push($array,$message);
            }
            array_walk_recursive($array,function(&$item){$item=strval($item);});
            echo json_encode($array, JSON_UNESCAPED_SLASHES); 
            die; 
        }
    }
    /*---------fetch_user_booking_history_list-------*/
    
    /*------driver_start_booking----*/
    function driver_start_booking()
    {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
        $format = 'h:i A';
        $v_code = mt_rand(100000, 999999);
        $current = (new \DateTime())->format('d-m-Y h:i A');
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE id ='$booking_id' AND driver_id='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $com_id = $sel['company_id'];
        $ride_date=$sel['ride_date'];
        $ride_time=$sel['ride_time'];
        $new_time= date($format, strtotime('-30 minutes', strtotime($ride_time)));
        $ride_type = $sel['ride_type'];
        if(strtotime($current) < strtotime($ride_date." ".$new_time))
        {
            $result['result']='unsuccess';  
        }
        elseif(strtotime($current) >= strtotime($ride_date." ".$new_time))
        {
            $del=mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='confirm' WHERE id ='$booking_id' AND driver_id='$driver_id'");
           //die(mysqli_error($con));
            if($del)
            {
              $result['result']='arrived successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_start_booking-----*/
    
    /*----fetch_driver_rating_list-----*/
    function fetch_driver_rating_list()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $path="https://cisswork.com/Android/SenderApp/images/";
        $array= array();
        
        $p1=mysqli_query($con,"SELECT count(rate_id) as count, AVG( `driver_rated` ) AS rating FROM tbl_rating WHERE driver_id='$driver_id'");   // changed
        $p1f=mysqli_fetch_assoc($p1);
        $total_rating=number_format($p1f['rating'], 2);
        
        $rat1=mysqli_query($con,"SELECT count(rate_id) as count1 FROM tbl_rating WHERE driver_id='$driver_id' AND (driver_rated BETWEEN '1.0' AND '1.5')");   // changed
        $rat1_fetch=mysqli_fetch_assoc($rat1);
        $total_rating1=number_format($rat1_fetch['count1'], 1);
        
         $rat2=mysqli_query($con,"SELECT count(rate_id) as count2 FROM tbl_rating WHERE driver_id='$driver_id' AND driver_rated BETWEEN '2.0' AND '2.5'");   // changed
        $rat2_fetch=mysqli_fetch_assoc($rat2);
        $total_rating2=number_format($rat2_fetch['count2'], 1);
        
        $rat3=mysqli_query($con,"SELECT count(rate_id) as count3 FROM tbl_rating WHERE driver_id='$driver_id' AND driver_rated BETWEEN '3.0' AND '3.5'");   // changed
        $rat3_fetch=mysqli_fetch_assoc($rat3);
        $total_rating3=number_format($rat3_fetch['count3'], 1);
        
        $rat4=mysqli_query($con,"SELECT count(rate_id) as count4 FROM tbl_rating WHERE driver_id='$driver_id' AND driver_rated BETWEEN '4.0' AND '4.5'");   // changed
        $rat4_fetch=mysqli_fetch_assoc($rat4);
        $total_rating4=number_format($rat4_fetch['count4'],1);
        
        $rat5=mysqli_query($con,"SELECT count(rate_id) as count5 FROM tbl_rating WHERE driver_id='$driver_id' AND driver_rated BETWEEN '5.0' AND '5.5'");   // changed
        $rat5_fetch=mysqli_fetch_assoc($rat5);
        $total_rating5=number_format($rat5_fetch['count5'], 1);
         
        if($total_rating=='')
        {
            $msg['total_rating']= ""; 
        }
        else
        {
            $msg['total_rating']= $total_rating; 
        }
        
        if($total_rating1=='')
        {
            $msg['rating1']= ""; 
        }
        else
        {
            $msg['rating1']= $total_rating1; 
        }
        
        if($total_rating2=='')
        {
            $msg['rating2']= ""; 
        }
        else
        {
            $msg['rating2']= $total_rating2; 
        }
        
        if($total_rating3=='')
        {
            $msg['rating3']= ""; 
        }
        else
        {
            $msg['rating3']= $total_rating3; 
        }
        
        if($total_rating4=='')
        {
            $msg['rating4']= ""; 
        }
        else
        {
            $msg['rating4']= $total_rating4; 
        }
        
        if($total_rating5=='')
        {
            $msg['rating5']= ""; 
        }
        else
        {
            $msg['rating5']= $total_rating5; 
        }
        $upd=mysqli_query($con,"SELECT * FROM `tbl_rating` WHERE `driver_id`='$driver_id'");
        while($sel=mysqli_fetch_assoc($upd))
        {
            $message["rate_id "]=$sel['rate_id'];
            $user_id = $sel['user_id'];
            
            $select = mysqli_query($con,"SELECT * FROM user_register WHERE id='$user_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"]=$ss['full_name']." ".$ss['sur_name']; 
            //$message["user_pic"]=$ss['image'];
            $iim=$ss['image'];
             if($iim=='')
             {
              $message["image"]="https://cisswork.com/Android/SenderApp/user.png";
             }
             else
             {
             $message["image"]=$path.$iim;
             }
            
            $message["feedback"]=$sel['u_feedback_to_driver'];
            $message["rating"]=$sel['driver_rated'];
            $message["date"]=$sel['date'];
            $message["time"]=$sel['time'];
           
            //$message["time"]=$sel['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
         $msg['list']= $array;       
        echo json_encode($msg, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*----fetch_driver_rating_list-----*/
    
    
    /*------add_driver_complain----*/
    function add_driver_complain()
    {
            include('config.php');
            $driver_id=$_REQUEST['driver_id'];
           // $user_id=$_REQUEST['user_id'];
            $booking_id=$_REQUEST['booking_id'];
            $complain =$_REQUEST['complain'];  
            $title=$_REQUEST['title'];
            date_default_timezone_set('Asia/Kolkata');
            $time=date('h:i A');
            $date=date('Y-m-d');
            
            $filename3=$_FILES['image']['name'];
            $tmpname3=$_FILES["image"]["tmp_name"];
            $ext3=substr($filename3,strpos($filename3,"."));
            $str3="ABCDEFGHijklmnopqrstuvwxyz0123456789";
            $finame=substr(str_shuffle($str3),5,10)."_".time().$ext3;
            if(move_uploaded_file($tmpname3,"../images/$finame"));
           
            $sql=mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='booking_id'");
            $row=mysqli_fetch_assoc($sql);
            $user_id= $row['user_id'];
            
            $update=mysqli_query($con,"INSERT INTO `tbl_complain_list`(`driver_id`, `user_id`, `booking_id`, `title`, `compain_text`, `image`, `type`, `date`, `time`) 
            VALUES ('$driver_id','$user_id','$booking_id','$title','$complain','$finame','Driver','$date','$time')");
            if($update)
            {
                $message["result"] = "success";   
            }
            else
            {
                $message["result"] = "unsuccess"; 
            }
            echo json_encode($message, JSON_UNESCAPED_SLASHES);   
            die; 
        }
    /*------add_driver_complain----*/
    
    /*------add_user_complain----*/
    function add_user_complain ()
    {
        include('config.php');
       // $driver_id=$_REQUEST['driver_id'];
        $user_id=$_REQUEST['user_id'];
        $booking_id=$_REQUEST['booking_id'];
        $complain =$_REQUEST['complain'];  
        $title=$_REQUEST['title'];
        date_default_timezone_set('Asia/Kolkata');
        $time=date('h:i A');
        $date=date('Y-m-d');
        
        $filename3=$_FILES['image']['name'];
        $tmpname3=$_FILES["image"]["tmp_name"];
        $ext3=substr($filename3,strpos($filename3,"."));
        $str3="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str3),5,10)."_".time().$ext3;
        if(move_uploaded_file($tmpname3,"../images/$finame"));
       
        $sql=mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='booking_id'");
        $row=mysqli_fetch_assoc($sql);
        $driver_id= $row['driver_id'];
        
        $update=mysqli_query($con,"INSERT INTO `tbl_complain_list`(`driver_id`, `user_id`, `booking_id`, `title`, `compain_text`, `image`, `type`, `date`, `time`) 
        VALUES ('$driver_id','$user_id','$booking_id','$title','$complain','$finame','User','$date','$time')");
        if($update)
        {
            $message["result"] = "success";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------add_user_complain----*/
    
    /*------add_driver_panic_notification----*/
    function add_driver_panic_notification ()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
       // $user_id=$_REQUEST['user_id'];
        $booking_id=$_REQUEST['booking_id'];
        $complain =$_REQUEST['alert_message'];  
        $location=$_REQUEST['location'];
        $latitude=$_REQUEST['latitude'];
        $longitude=$_REQUEST['longitude'];
        
        date_default_timezone_set('Asia/Kolkata');
        $time=date('h:i A');
        $date=date('Y-m-d');
       
        $sql=mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
        $row=mysqli_fetch_assoc($sql);
        $user_id= $row['user_id'];
        
        $sql_user=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
        //echo mysqli_num_rows($sql_user);
        $row_user=mysqli_fetch_assoc($sql_user);
        $name1 = $row_user['full_name']." ".$row_user['middle_name']." ".$row_user['sur_name'];
        $email1 = $row_user['email'];
        $contact1 = $row_user['country_code']." ".$row_user['contact'];
        
        $sql_driver=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
        $row_driver=mysqli_fetch_assoc($sql_driver);
        $name2 = $row_driver['fullname']." ".$row_driver['middle_name']." ".$row_driver['surname'];
        $email2 = $row_driver['email'];
        $contact2 = $row_driver['country_code']." ".$row_driver['contact'];
        $license2 = $row_driver['vehicle_type'] ." ".$row_driver['vehicle_name'];
        $vehicle_number = $row_driver['vehicle_no'];
        $vehicle_color = $row_driver['colour'];
       // $model2 = $row_driver['email'];
        
        $sqls=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin_new'");
        $row1=mysqli_fetch_assoc($sqls);
        $email= $row1['email'];
       
        
        $update=mysqli_query($con,"INSERT INTO `penic_notification_list`(`booking_id`, `user_id`, `driver_id`, `alert_msg`, `current_location`, `lat`, `lng`, `type`, `date`, `time`)
        VALUES ('$booking_id','$user_id','$driver_id','There is a problem ,Please help !!','$location','$latitude','$longitude','Driver','$date','$time')");
        if($update)
        {
            $to_email = $email;
            $subject = 'Penic Notification by Driver';
          // $msg .= '<b> Upload : </b>' . $upload . '<br/>';
            $txt ='<html>
                <body>
                <section class="section" style=" margin: 0px;">
              <div class="card-list" style=" display: flex;flex-wrap: wrap;gap: 16px;container-type: inline-size; resize: horizontal;overflow: auto;">
                <div class="card-list__item card" style=" width: 100%; border: 2px solid gray;border-radius: 16px;">
                  <h3 class="card__title" style="font-size: 18px; text-align: center;">Penic Notification Details</h3>
                  <div class="card__content" style="margin-top: 1rem; display: flex;flex-direction: row;gap: 1rem;flex-grow: 1;">
                    <div class="card__text" style="font-family: serif; width: 100%;">
                            <div style="border:1px solid #ccc;border-radius:5px;padding: 6px 6px 6px 6px;">
                                <center><p style="margin: 4px 0 -7px;font-size: 20px;"><b>Driver Details For Ride No :'.$booking_id.'</b></p></center>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 23%;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td style="width: 100%;">Driver  Name :</td>
                                            <td style="width: 100%;">'.$name2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Email :</td>
                                            <td style="width: 100%;">'.$email2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Telephone Number :</td>
                                            <td style="width: 100%;">'.$contact2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Make & Model :</td>
                                            <td style="width: 100%;">'.$license2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Number:</td>
                                            <td style="width: 100%;">'.$vehicle_number.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Color:</td>
                                            <td style="width: 100%;">'.$vehicle_color.'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                  </div>
                  
                  
                  <div class="card__content" style="margin-top: 1rem; display: flex;flex-direction: row;gap: 1rem;flex-grow: 1;">
                    <div class="card__text" style="font-family: serif; width: 100%;">
                         <div style="border:1px solid #ccc;border-radius:5px;padding: 6px 6px 6px 6px;">
                                <center><p style="margin: 4px 0 -7px;font-size: 20px;"><b>Passenger Details For Ride No :'.$booking_id.'</b></p></center>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 23%;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td style="width: 100%;">Passenger  Name    :</td>
                                            <td style="width: 100%;">'.$name1.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Email   :</td>
                                            <td style="width: 100%;">'.$email1.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Telephone Number    :</td>
                                            <td style="width: 100%;">'.$contact1.'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                  </div>
                  <div class="card__button-wrapper" style="margin-top: 1rem;text-align: center; ">
                    <button class="card__button" style="appearance: none;border: none;background-color: #4B7CB6;color: white;padding: 1rem;min-width: 50%;border-radius: 100vh; cursor: pointer;"><a style="color:#fff;" href="https://cisswork.com/Android/Cerber_taxi/table_location.php?pb='.$location.'">Show Current Location</a></button>
                  </div>
                </div>
             </div>
            </section>
            </body>
            </html>'; 
           
            // Mail headers
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            //$headers .= 'From: yourmail@gmail.com' . "\r\n";
            $headers .= "from:barkhapatelciss@gmail.com" . "\r\n" .
            //"CC: somebodyelse@example.com";
            'X-Mailer: PHP/' . phpversion(); 
            $user_email=mail($to_email,$subject,$txt,$headers);
            $message["result"] = "success";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------add_driver_panic_notification----*/
    
    /*------add_user_panic_notification----*/
    function add_user_panic_notification ()
    {
        include('config.php');
       // $driver_id=$_REQUEST['driver_id'];
        $user_id=$_REQUEST['user_id'];
        $booking_id=$_REQUEST['booking_id'];
        $complain =$_REQUEST['alert_message'];  
        $location=$_REQUEST['location'];
        $latitude=$_REQUEST['latitude'];
        $longitude=$_REQUEST['longitude'];
        
        date_default_timezone_set('Asia/Kolkata');
        $time=date('h:i A');
        $date=date('Y-m-d');
       
        $sql=mysqli_query($con,"SELECT * FROM notification_tbl WHERE id='$booking_id'");
       // echo mysqli_num_rows($sql);
        $row=mysqli_fetch_assoc($sql);
        $driver_id= $row['driver_id'];
        
        $sql_user=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
        //echo mysqli_num_rows($sql_user);
        $row_user=mysqli_fetch_assoc($sql_user);
        $name1 = $row_user['full_name']." ".$row_user['middle_name']." ".$row_user['sur_name'];
        $email1 = $row_user['email'];
        $contact1 = $row_user['country_code']." ".$row_user['contact'];
        
        $sql_driver=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$driver_id'");
        $row_driver=mysqli_fetch_assoc($sql_driver);
        $name2 = $row_driver['fullname']." ".$row_driver['middle_name']." ".$row_driver['surname'];
        $email2 = $row_driver['email'];
        $contact2 = $row_driver['country_code']." ".$row_driver['contact'];
        $license2 = $row_driver['vehicle_type'] ." ".$row_driver['vehicle_name'];
        $vehicle_number = $row_driver['vehicle_no'];
        $vehicle_color = $row_driver['colour'];
        
        $sqls=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin_new'");
        $row1=mysqli_fetch_assoc($sqls);
        $email= $row1['email'];
       
        
        $update=mysqli_query($con,"INSERT INTO `penic_notification_list`(`booking_id`, `user_id`, `driver_id`, `alert_msg`, `current_location`, `lat`, `lng`, `type`, `date`, `time`)
        VALUES ('$booking_id','$user_id','$driver_id','There is a problem ,Please help !!','$location','$latitude','$longitude','User','$date','$time')");
        if($update)
        {
            $to_email = $email;
            $subject = 'Penic Notification by User';
          // $msg .= '<b> Upload : </b>' . $upload . '<br/>';
            $txt ='<html>
                <body>
                <section class="section" style=" margin: 0px;">
              <div class="card-list" style=" display: flex;flex-wrap: wrap;gap: 16px;container-type: inline-size; resize: horizontal;overflow: auto;">
                <div class="card-list__item card" style=" width: 100%; border: 2px solid gray;border-radius: 16px;">
                  <h3 class="card__title" style="font-size: 18px; text-align: center;">Penic Notification Details</h3>
                  <div class="card__content" style="margin-top: 1rem; display: flex;flex-direction: row;gap: 1rem;flex-grow: 1;">
                    <div class="card__text" style="font-family: serif; width: 100%;">
                            <div style="border:1px solid #ccc;border-radius:5px;padding: 6px 6px 6px 6px;">
                                <center><p style="margin: 4px 0 -7px;font-size: 20px;"><b>Driver Details For Ride No :'.$booking_id.'</b></p></center>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 23%;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td style="width: 100%;">Driver  Name :</td>
                                            <td style="width: 100%;">'.$name2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Email :</td>
                                            <td style="width: 100%;">'.$email2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Telephone Number    :</td>
                                            <td style="width: 100%;">'.$contact2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Make & Model :</td>
                                            <td style="width: 100%;">'.$license2.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Number:</td>
                                            <td style="width: 100%;">'.$vehicle_number.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Vehicle Color:</td>
                                            <td style="width: 100%;">'.$vehicle_color.'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                  </div>
                  
                  
                  <div class="card__content" style="margin-top: 1rem; display: flex;flex-direction: row;gap: 1rem;flex-grow: 1;">
                    <div class="card__text" style="font-family: serif; width: 100%;">
                         <div style="border:1px solid #ccc;border-radius:5px;padding: 6px 6px 6px 6px;">
                                <center><p style="margin: 4px 0 -7px;font-size: 20px;"><b>Passenger Details For Ride No :'.$booking_id.'</b></p></center>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 23%;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td style="width: 100%;">Passenger  Name    :</td>
                                            <td style="width: 100%;">'.$name1.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Email   :</td>
                                            <td style="width: 100%;">'.$email1.'</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">Telephone Number    :</td>
                                            <td style="width: 100%;">'.$contact1.'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                  </div>
                  <div class="card__button-wrapper" style="margin-top: 1rem;text-align: center; ">
                    <button class="card__button" style="appearance: none;border: none;background-color: #4B7CB6;color: white;padding: 1rem;min-width: 50%;border-radius: 100vh; cursor: pointer;"><a style="color:#fff;" href="https://cisswork.com/Android/Cerber_taxi/table_location.php?pb='.$location.'">Show Current Location</a></button>
                  </div>
                </div>
             </div>
            </section>
            </body>
            </html>'; 
           
            // Mail headers
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            //$headers .= 'From: yourmail@gmail.com' . "\r\n";
            $headers .= "from:barkhapatelciss@gmail.com" . "\r\n" .
            //"CC: somebodyelse@example.com";
            'X-Mailer: PHP/' . phpversion(); 
            $user_email=mail($to_email,$subject,$txt,$headers);
            $message["result"] = "success";   
        }
        else
        {
            $message["result"] = "unsuccess"; 
        }
        echo json_encode($message, JSON_UNESCAPED_SLASHES);   
        die; 
    }
    /*------add_user_panic_notification----*/
    
    /*------------fetch_user_chat_list----------*/
    function fetch_user_chat_list()
    {
        include "config.php";
        $user_id = $_REQUEST['user_id'];
        $array = array();
        
       $path="https://cisswork.com/Android/SenderApp/images/";
        $select_driver = mysqli_query($con,"SELECT DISTINCT host_id FROM `chat_info` WHERE user_id = '$user_id' AND user='0'");
        $driver_count =mysqli_num_rows($select_driver);
        if( $driver_count > 0)
        {
            //$fetch_driver = mysqli_fetch_assoc($select_driver);
            while($fetch_driver = mysqli_fetch_assoc($select_driver))
            {
                $message['id'] = $fetch_driver['host_id'];
                $did =$fetch_driver['host_id'];
                $select_d= mysqli_query($con,"SELECT * FROM `driver_register` WHERE id = '$did'");
                $fetch_d= mysqli_fetch_assoc($select_d);
                
                $message['name'] = $fetch_d['fullname'].' '.$fetch_d['last_name'];
                
                if($fetch_d['image']=='')
                {
                    $message["image"]=''; 
                }
                else
                {
                    $message["image"]=$path.$fetch_d['image'];
                }
                
                
                $select_msg = mysqli_query($con,"SELECT * FROM `messages` WHERE (incoming_msg_id ='$did' AND outgoing_msg_id ='$user_id') OR (incoming_msg_id ='$user_id' AND outgoing_msg_id ='$did') order by msg_id Desc");
                $fetch_driver = mysqli_fetch_assoc($select_msg);
                $driver_count =mysqli_num_rows($select_msg);
                
                if($driver_count > 0)
                {
                     $message["last_message"] = $fetch_driver['msg'];
                     $message["last_message_time"] = $fetch_driver['time'];
                }
                else
                {
                    $message["last_message"]="";
                    $message["last_message_time"] ="";
                }
            
             array_push($array, $message);
            }
            echo json_encode($array,JSON_UNESCAPED_SLASHES);
            die;
        }
        else
        {
            $message["result"]= "No Data Available";
            echo json_encode($message,JSON_UNESCAPED_SLASHES);
            die;
        }
        
        //  $select_msg = mysqli_query($con,"SELECT * FROM `messages` WHERE (outgoing_msg_id ='$user_id') OR (incoming_msg_id ='$user_id') order by msg_id Desc ");
        //     while($fetch_driver = mysqli_fetch_assoc($select_msg))
        //     {
        //         if($fetch_driver['outgoing_msg_id'] =='$user_id')
        //         {
        //             $did =$fetch_driver['incoming_msg_id'];
        //         }
        //         else
        //         {
        //              $did =$fetch_driver['outgoing_msg_id'];
        //         }
                
        //         $message['id'] =$did;
        //         $select_d= mysqli_query($con,"SELECT * FROM `driver_register` WHERE id ='$did'");
        //         $fetch_d= mysqli_fetch_assoc($select_d);
                
        //         $message['name'] = $fetch_d['fullname'].' '.$fetch_d['last_name'];
                
        //         if($fetch_d['image']=='')
        //         {
        //             $message["image"]=''; 
        //         }
        //         else
        //         {
        //             $message["image"]=$path.$fetch_d['image'];
        //         }
        //         $driver_count =mysqli_num_rows($select_msg);
                
        //         if($driver_count > 0)
        //         {
        //              $message["last_message"] = $fetch_driver['msg'];
        //              $message["last_message_time"] = $fetch_driver['time'];
        //         }
        //         else
        //         {
        //             $message["last_message"]="";
        //             $message["last_message_time"] ="";
        //         }
                
                
            
        //      array_push($array, $message);
        //     }
        //     echo json_encode($array,JSON_UNESCAPED_SLASHES);
        //     die;
    }
    /*------------fetch_user_chat_list----------*/
    
    /*------------fetch_driver_chat_list----------*/
    function fetch_driver_chat_list()
    {
        include "config.php";
        $host_id = $_REQUEST['driver_id'];
        $array = array();
        
        $path="https://cisswork.com/Android/SenderApp/images/";
        $select_driver = mysqli_query($con,"SELECT DISTINCT  user_id FROM `chat_info` WHERE host_id = '$host_id'  AND owner='0'");
        //$fetch_driver = mysqli_fetch_assoc($select_driver);
        $driver_count =mysqli_num_rows($select_driver);
        if( $driver_count > 0)
        {
            while($fetch_driver = mysqli_fetch_assoc($select_driver))
            {
                $message['id'] = $fetch_driver['user_id'];
                $did =$fetch_driver['user_id'];
                $select_d= mysqli_query($con,"SELECT * FROM `user_register` WHERE id = '$did'");
                $fetch_d= mysqli_fetch_assoc($select_d);
                
                $message['name'] = $fetch_d['full_name'].' '.$fetch_d['last_name'];
                
                //$message['user_contact'] = $fetch_d['contact'];
              // $message['user_email'] = $fetch_d['email'];
                if($fetch_d['image']=='')
                {
                    $message["image"]=''; 
                }
                else
                {
                    $message["image"]=$path.$fetch_d['image'];
                }
                
                
                $select_msg = mysqli_query($con,"SELECT * FROM `messages` WHERE (incoming_msg_id ='$did' AND outgoing_msg_id ='$host_id') OR (incoming_msg_id ='$host_id' AND outgoing_msg_id ='$did') order by msg_id Desc");
                $fetch_driver = mysqli_fetch_assoc($select_msg);
                $driver_count =mysqli_num_rows($select_msg);
                
                
                if($driver_count > 0)
                {
                     $message["last_message"] = $fetch_driver['msg'];
                     $message["last_message_time"] = $fetch_driver['time'];
                }
                else
                {
                    $message["last_message"]="";
                    $message["last_message_time"] ="";
                }
             array_push($array, $message);
            }
            
            echo json_encode($array,JSON_UNESCAPED_SLASHES);
            die;
        }
        else
        {
            $message["result"]= "No Data Available";
            echo json_encode($message,JSON_UNESCAPED_SLASHES);
            die;
        }
        
        //  $select_msg = mysqli_query($con,"SELECT * FROM `messages` WHERE (outgoing_msg_id ='$host_id') OR (incoming_msg_id ='$host_id') order by msg_id Desc ");
        //     while($fetch_driver = mysqli_fetch_assoc($select_msg))
        //     {
        //         if($fetch_driver['outgoing_msg_id'] =='$host_id')
        //         {
        //           echo   $did =$fetch_driver['incoming_msg_id'];
        //         }
        //         else
        //         {
        //               $did =$fetch_driver['outgoing_msg_id'];
        //         }
                
        //         $message['id'] =$did;
        //         $select_d= mysqli_query($con,"SELECT * FROM `user_register` WHERE id = '$did'");
        //         $fetch_d= mysqli_fetch_assoc($select_d);
                
        //         $message['name'] = $fetch_d['full_name'].' '.$fetch_d['last_name'];
        //         if($fetch_d['image']=='')
        //         {
        //             $message["image"]=''; 
        //         }
        //         else
        //         {
        //             $message["image"]=$path.$fetch_d['image'];
        //         }
        //         $driver_count =mysqli_num_rows($select_msg);
                
        //         if($driver_count > 0)
        //         {
        //              $message["last_message"] = $fetch_driver['msg'];
        //              $message["last_message_time"] = $fetch_driver['time'];
        //         }
        //         else
        //         {
        //             $message["last_message"]="";
        //             $message["last_message_time"] ="";
        //         }
        //      array_push($array, $message);
        //     }
        //     echo json_encode($array,JSON_UNESCAPED_SLASHES);
        //     die;
    }
    /*------------fetch_driver_chat_list----------*/
    
    /*------------driver_send_msg----------*/
    function driver_send_msg ()
    {
        include "config.php";
        $user_id = $_REQUEST['user_id'];
        $send_id = $_REQUEST['send_id'];
        $message1 = $_REQUEST['message'];
        date_default_timezone_set('Asia/Kolkata');
        $date=date('d-m-Y');
        $time = date( 'h:i A');
        $select_u= mysqli_query($con,"SELECT * FROM `user_register` WHERE id = '$user_id'");
        $fetch_u= mysqli_fetch_assoc($select_u);
        $u_name = $fetch_u['full_name'].' '.$fetch_u['last_name'];
         
        $select_d= mysqli_query($con,"SELECT * FROM `driver_register` WHERE id = '$send_id'");
        $fetch_d= mysqli_fetch_assoc($select_d);
        $d_name = $fetch_d['fullname'].' '.$fetch_d['surname'];
        
        
        $sql = mysqli_query($con,"INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,date,time)  VALUES ('$user_id','$send_id', '$message1','$date','$time')") ;
        if($sql)
        {
            require_once __DIR__ . '/firebase.php';
            require_once __DIR__ . '/push.php';
            
            $firebase = new Firebase1();
            $push = new Push1();
            
            // optional payload
            $payload = array();
            $payload['team'] = 'India';
            $payload['score'] = '7.6';
            
            // notification title
              $title= $d_name;
            // notification message
             $message = $message1;
            
           // $include_image = "";
            $push->setTitle($title);
            $push->setMessage($message);
            
            $push->setIsBackground(FALSE);
            $push->setPayload($payload);
            
            $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$user_id'");
            $number_of_rows=mysqli_num_rows($sql_userId);
            
            if($number_of_rows==0)
            {
              // $msg["result"]="unsuccessful";
            }
            else
            {
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y-m-d');
                $time = date('h:i A');
    
                $row=mysqli_fetch_assoc($sql_userId);
                $ds=$row['device_status'];
                if($ds=='IOS' || $ds=='Android')
                {
                    $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                 VALUES ('','$user_id','','$title','$message','$date','$time','System')");
       
                    $regId=$row['device_id'];
                    $json = '';
                    $response = '';
                    $json = $push->getPush();
                    $response = $firebase->send($regId, $json);
                    
                    $deviceToken=$row['iosdevice_id'];
                    $json = '';
                    $response = '';
                    $json = $push->getPush();
                    $iosresponse = $firebase->send($deviceToken, $json);
                        //IOS notification code
                    $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                    
                    //The device token.
                    if($ds=='IOS')
                    {
                        $token = $deviceToken;
                    }
                    elseif($ds=='Android')
                    {
                        $token = $regId;
                    }
    
                    //The device token.
                    //$token = $regId;
                    //Title of the Notification.
                    $titlez = $title;
                    //Body of the Notification.
                    $body =$message;
                    $type=$type;
                    //Creating the notification array.
                    $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                    
                    //This array contains, the token and the notification. The 'to' attribute stores the token.
                    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                    
                    $json = json_encode($arrayToSend);
                  //Setup headers:
                    $headers = array();
                    $headers[] = 'Content-Type: application/json';
                     $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                    //Setup curl, add headers and post parameters.
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                    //Send the request
                    $response = curl_exec($ch);
                    
                    //Close request
                    curl_close($ch);
                }
            }
            $msg['result']="success";
            
        }
        else
        {
            $msg['result']="unsuccess";
        }
        
        echo json_encode($msg,JSON_UNESCAPED_SLASHES);
        die;
    }
    /*------------driver_send_msg----------*/
    
    /*------------user_send_msg----------*/
    function user_send_msg ()
    {
        include "config.php";
        //$host_id = $_REQUEST['host_id'];
        $user_id = $_REQUEST['user_id'];
        $send_id = $_REQUEST['driverid'];
        $message1 = $_REQUEST['message'];
        date_default_timezone_set('Asia/Kolkata');
        $date=date('d-m-Y');
        $time = date( 'h:i A');
        $select_u= mysqli_query($con,"SELECT * FROM `user_register` WHERE id = '$user_id'");
        $fetch_u= mysqli_fetch_assoc($select_u);
        $u_name = $fetch_u['full_name'].' '.$fetch_u['last_name'];
         
        $select_d= mysqli_query($con,"SELECT * FROM `driver_register` WHERE id = '$send_id'");
        $fetch_d= mysqli_fetch_assoc($select_d);
        $d_name = $fetch_d['fullname'].' '.$fetch_d['surname'];
        
        $sql = mysqli_query($con,"INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,date,time)  VALUES ('$send_id','$user_id','$message1','$date','$time')") ;
        if($sql)
        {
               /// Driver Notification
    
                                include ('config.php');
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                $title= $u_name;
                                // notification message
                                $message=$message1;
                                
                              //  $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);;
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `driver_register` WHERE id='$send_id'");
                                $number_of_rows1=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows1==0)
                                {
                                    $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
    
                                    $row1=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row1['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                   VALUES ('','','$send_id','$title','$message','$date','$time','System')");
                            
                                        $regId=$row1['Driver_device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row1['iosDriver_device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                            
                                        //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                                        //Title of the Notification.
                                        $titlez = $title;
                                        //Body of the Notification.
                                        $body =$message;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                        //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                    
                                }   
            $smg['result']="success";
        }
        else
        {
            $smg['result']="unsuccess";
        }
        
        echo json_encode($smg,JSON_UNESCAPED_SLASHES);
        die;
    }
    /*------------user_send_msg---------*/
    
    /*-----------fetch_driver_send_msg----------*/
    function fetch_driver_send_msg()
    {
        include "config.php";
        $user_id = $_REQUEST['user_id']; 
        $send_id = $_REQUEST['send_id'];
        $array =array();
        
        
        $sql = "SELECT * FROM messages WHERE (outgoing_msg_id = '$user_id' AND incoming_msg_id ='$send_id') OR (outgoing_msg_id = '$send_id' AND incoming_msg_id = '$user_id')  ORDER BY msg_id ";
       // $sql = "SELECT * FROM messages LEFT JOIN user_register ON user_register.id = messages.outgoing_msg_id WHERE outgoing_msg_id = $outgoing_id OR outgoing_msg_id = $incoming_id LEFT JOIN driver_register ON driver_register.id = messages.incoming_msg_id WHERE incoming_msg_id =$outgoing_id OR incoming_msg_id = $incoming_id ORDER BY msg_id";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                //$message['id']=$row['msg_id'];
                if($row['outgoing_msg_id'] === $user_id)
                {
                   $message['id']=$user_id;
                      $message["msg_id"] = $row['msg_id'];
                   $message["message"] = $row['msg'];
                   $message["message_time"] = $row['time'];
                }
                else  
                {
                    $message['id']=$send_id;
                    $message["msg_id"] = $row['msg_id'];
                    $message["message"] = $row['msg'];
                    $message["message_time"] = $row['time'];
                }
            array_push($array,$message);
            }
            array_walk_recursive($array,function(&$item){$item=strval($item);});
            echo json_encode($array,JSON_UNESCAPED_SLASHES);
        }
        else
        {
           $message["message"] = "No messages are available. Once you send message they will appear here.";
           echo json_encode($message,JSON_UNESCAPED_SLASHES);
           die;
        }
    }
    /*------------fetch_driver_send_msg----------*/
    
    /*-----------fetch_user_send_msg----------*/
    function fetch_user_send_msg()
    {
        include "config.php";
        $user_id = $_REQUEST['user_id']; 
        $send_id = $_REQUEST['driver_id']; 
        $array =array();
        
        $sql = "SELECT * FROM messages WHERE (outgoing_msg_id = '$user_id' AND incoming_msg_id ='$send_id') OR (outgoing_msg_id = '$send_id' AND incoming_msg_id = '$user_id')  ORDER BY msg_id ";
       // $sql = "SELECT * FROM messages LEFT JOIN user_register ON user_register.id = messages.outgoing_msg_id WHERE outgoing_msg_id = $outgoing_id OR outgoing_msg_id = $incoming_id LEFT JOIN driver_register ON driver_register.id = messages.incoming_msg_id WHERE incoming_msg_id =$outgoing_id OR incoming_msg_id = $incoming_id ORDER BY msg_id";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                // $message['id']=$row['msg_id'];
                if($row['outgoing_msg_id'] === $user_id)
                {
                   $message['id']=$user_id;
                   $message["msg_id"] = $row['msg_id'];
                   $message["message"] = $row['msg'];
                   $message["message_time"] = $row['time'];
                }
                else  
                {
                    $message['id']=$send_id;
                    $message["msg_id"] = $row['msg_id'];
                    $message["message"] = $row['msg'];
                    $message["message_time"] = $row['time'];
                }
                array_push($array,$message);
            }
            array_walk_recursive($array,function(&$item){$item=strval($item);});
            echo json_encode($array,JSON_UNESCAPED_SLASHES);
        }
        else
        {
           $message["message"] = "No messages are available. Once you send message they will appear here.";
           echo json_encode($message,JSON_UNESCAPED_SLASHES);
           die;
        }
    }
    /*------------fetch_user_send_msg----------*/
    
    /*------------insert_driver_rating---------*/
    function insert_driver_rating()
    {
        include "config.php";
        $booking_id = $_REQUEST['booking_id'];
        $user_id = $_REQUEST['user_id'];
        $driver_id = $_REQUEST['driverid']; 
        $rating=$_REQUEST['rating']; 
        $feedback=$_REQUEST['feedback'];
        
        $sql1=mysqli_query($con,"SELECT * FROM driver_register WHERE id='$driver_id'");
        $res1=mysqli_fetch_assoc($sql1);
         $company_id = $res1['company_id'];           
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $time = date('h:i A');
                                           
        $sql=mysqli_query($con,"INSERT INTO `tbl_rating`(company_id,`user_id`, `driver_id`, `booking_id`, `u_feedback_to_driver`,`driver_rated`, `date`, `time`)
                                     VALUES ('$company_id','$user_id','$driver_id','$booking_id','$feedback','$rating','$date','$time')");
        // die(mysqli_error($con));
        if($sql)
        {
            $update= mysqli_query($con,"UPDATE `notification_tbl` SET driver_status='Complete' WHERE id ='$booking_id' AND driver_id='$driver_id'");
            $message['result']="success";
        }
        else
        {
            $message['result']="unsuccess";
        }
        
        echo json_encode($message,JSON_UNESCAPED_SLASHES);
        die;
    }
    /*------------insert_driver_rating---------*/
    
    /*---------fetch_user_amount_transaction_list-------*/
    function fetch_user_amount_transaction_list()
    {
        include('config.php');
        $user_id=$_REQUEST['user_id'];
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `user_withdraw_request` WHERE `user_id`='$user_id'");
        while($ss=mysqli_fetch_assoc($upd))
        {
            $message["id"]=$ss['withdraw_id'];
            $message["amount"]=$ss['withdraw_credit'];
            $message["title"]=$ss['status'];
            $message["date"]=$ss['date'];
            $message["time"]=$ss['time'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
    }
    /*---------fetch_user_amount_transaction_list-------*/   
    
    /*------ driver_login_recheck-------*/
    function driver_login_recheck()
    {
       include('config.php');
       $driver_id=$_REQUEST['driver_id'];
       $login_key=$_REQUEST['login_device_key'];
       $access_token=$_REQUEST['access_token'];
       
       $path="https://cisswork.com/Android/SenderApp/images/";  
       $sel=mysqli_query($con,"SELECT * FROM `Drivers` WHERE `DriverID`='$driver_id'");
       $row=mysqli_fetch_assoc($sel);
       $log=$row['login_device_key'];
       $access_token1=$row['access_token'];
       
        if($log!=$login_key && $access_token!=$access_token1)
        {
          $message["result"]="You Are Already Logged-in In Other Device"; 
        }
        elseif($log==$login_key && $access_token!=$access_token1)
        {
          $message["result"]="Success";
        }
        elseif($log==$login_key && $access_token==$access_token1)
        {
          $message["result"]="Success";
        }
         
       echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;     
    }
    /*------ driver_login_recheck-------*/
    
    /*------ driver_signup_recheck-------*/
    function driver_signup_recheck()
    {
        include('config.php');
        $email=$_REQUEST['email'];
        $contact_no=$_REQUEST['contact_no'];
        $country_code=$_REQUEST['country_code'];
        $code = $_REQUEST['referral_code'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        
        $sql=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `country_code`='$country_code' AND contact='$contact_no'");
        $row1=mysqli_num_rows($sql);
        
        $sql1=mysqli_query($con,"SELECT * FROM `driver_register` WHERE `email`='$email'");
        $row11=mysqli_num_rows($sql1);
       // $row_fetch=mysqli_fetch_assoc($sql);
       // $code = $row_fetch['referral_code'];
        
        $sql2=mysqli_query($con,"SELECT * FROM `driver_register` WHERE invite_code=$code AND code_end_date>=$date");
       //die(mysqli_error($con));
        $row2=mysqli_fetch_assoc($sql2);
        $code1 = $row2['invite_code'];
        if($row1>0)
        {
            $message['result']="Contact already exist";
            echo json_encode($message);
        }
        elseif($row11>0)
        {
            $message['result']="Email already exist";
            echo json_encode($message);
        }
        elseif($row1==0 && $row11==0 && $code!=$code1 )
        {
            $message['result']="invalid referral code";
            echo json_encode($message);
        }
        elseif($row1==0 && $row11==0  && $code==$code1)
        {
            $message['result']="Success";
            echo json_encode($message);
        }
    
        // if($code!=$code1)
        // {
        //   $message["result"]="invalid referral code"; 
        // }
        // elseif($code==$code1)
        // {
        //   $message['result']="Success";
        // }
    }
    /*------ driver_signup_recheck-------*/
    
    /*------ driver_write_support-------*/
    function driver_write_support()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id']; 
        $fullname=$_REQUEST['fullname']; 
        $email=$_REQUEST['email']; 
        $subject=$_REQUEST['subject']; 
        $message=$_REQUEST['message']; 
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $time = date('h:i A');
        
        $ins=mysqli_query($con,"INSERT INTO `tbl_user_write_support`(`driver_id`, `fullname`, `email`, `subject`, `message`,type, `date`, `time`)
                                                            VALUES('$driver_id','$fullname','$email','$subject','$message','Driver','$date','$time')");
          
        $insert_id=mysqli_insert_id($con);
        if($insert_id==0)
        {
          $message1['result']="unsuccess";
        }
        else
        {
            $message1['id']=$insert_id;
            $message1['result']="successfully";             
        }
        echo json_encode($message1, JSON_UNESCAPED_SLASHES); 
        die;
    }
    /*------ driver_write_support-------*/
    
    /*------coupon_validation-------*/
    function coupon_validation()
    {
        include('config.php');
        $coupon_id=$_REQUEST['coupon_id'];
        $total_price=$_REQUEST['total_price'];
        
        $select_coupon = mysqli_query($con, "SELECT * FROM tbl_coupon WHERE id='$coupon_id'");
        $fetch_coupon = mysqli_fetch_array($select_coupon);
        $discount=$fetch_coupon['discount'];
        $min_amount=$fetch_coupon['remaining_amount'];
            
        $total_discount = ($discount*$total_price)/100;
       
        if($min_amount >= $total_discount)
        {
            $message['result']="Success";
            echo json_encode($message);
        }
        elseif($min_amount<$total_discount)
        {
            $message['result']="Invalid coupon code";
            echo json_encode($message);
        }
    }
    /*------ coupon_validation-------*/
    
    /*------ update_userlatlong-------*/
    function update_userlatlong()
    {
        include('config.php');
        $booking_id=$_REQUEST['booking_id'];
        $lat=$_REQUEST['lat'];  
        $long=$_REQUEST['lng'];  
        $lat_long_key="AIzaSyD6KJOHKQLUWMAh9Yl5NQrEAI9bxrvYCqQ";
       
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&sensor=false'.'&key='.$lat_long_key);
        $output= json_decode($geocode);
        
        $destination_city =  $output->results[1]->formatted_address;
        
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id' AND (driver_status!='cancel' AND driver_status!='Complete')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
           $upd=mysqli_query($con,"UPDATE `notification_tbl` SET `user_lat`='$lat',`user_lng`='$long',u_address='$destination_city' WHERE (`id`='$booking_id' AND driver_status != 'cancel') AND (`id`='$booking_id' AND driver_status !='Complete')");
          // die(mysqli_error($con));
           if($upd)
           {
               $message["Location_url"]="https://cisswork.com/Android/SenderApp/Current_Location.php?id=".$booking_id;
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
        }
        else
        {
           $message["result"]="Unsuccess";
        }
       echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;
    }
    /*------ update_userlatlong-------*/
    
    /*------ update_driverlatlong-------*/
    function update_driverlatlong()
    {
        include('config.php');
        $booking_id=$_REQUEST['booking_id'];
        $lat=$_REQUEST['lat'];  
        $long=$_REQUEST['lng'];  
        $lat_long_key="AIzaSyD6KJOHKQLUWMAh9Yl5NQrEAI9bxrvYCqQ";
       
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&sensor=false'.'&key='.$lat_long_key);
        $output= json_decode($geocode);
        
        $destination_city =  $output->results[1]->formatted_address;
        
        $upd=mysqli_query($con,"SELECT * FROM `notification_tbl` WHERE `id`='$booking_id' AND (driver_status!='cancel' AND driver_status!='Complete')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            
           $upd=mysqli_query($con,"UPDATE `notification_tbl` SET `driver_lat`='$lat',`driver_lng`='$long',d_address='$destination_city' WHERE `id`='$booking_id'");
           //  die(mysqli_error($con));
           if($upd)
           {
               $message["Location_url"]="https://cisswork.com/Android/SenderApp/Current_Location_driver.php?id=".$booking_id;
               $message["result"]="Update successfully";
           }
           else
           {
               $message["result"]="Unsuccess";
           }
        }
        else
        {
           $message["result"]="Unsuccess";
        }
       echo json_encode($message, JSON_UNESCAPED_SLASHES); 
             die;
    }
    /*------ update_driverlatlong-------*/
    
    /*------------tantative_booking_price---------*/
    function tantative_booking_price()
    {
        include ('config.php');
    
        $uid=$_REQUEST['user_id'];
        $vehicle_type_id=$_REQUEST['vehicle_type_id'];
        $source_lat= $_REQUEST['pickup_lat'];
        $source_long= $_REQUEST['pickup_lng'];
        $destination_lat= $_REQUEST['drop_lat'];
        $destination_lng= $_REQUEST['drop_lng'];
        $array = array();
        $lat_long_key="AIzaSyD6KJOHKQLUWMAh9Yl5NQrEAI9bxrvYCqQ";
        
        $curl = curl_init();
        $url ='https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$source_lat.','.$source_long.'&destinations='.$destination_lat.','.$destination_lng.'&callback=initMap'.'&key='.$lat_long_key.'&travelMode=driving';
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST=>true
        ));
        $response = curl_exec($curl);
        $stats = json_decode($response, true);
        $distance1 = $stats['rows'][0]['elements'][0]['distance']['text'];
        $year=$distance1; 
        $est_arr1=array();
        $est_array1=explode(' ',$year);
        $est_arr1=$est_array1;
        $distance=$est_arr1[0];
        
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$source_lat.','.$source_long.'&sensor=false'.'&key='.$lat_long_key);
        $output= json_decode($geocode);
        for($j=0;$j<count($output->results[0]->address_components);$j++)
        {
            $cn=array($output->results[0]->address_components[$j]->types[0]);
            if(in_array("locality", $cn))
            {
                $source_city= $output->results[0]->address_components[$j]->long_name; 
            }
        }                                                                                                                                         
        
        
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$destination_lat.','.$destination_lng.'&sensor=false'.'&key='.$lat_long_key);
        $output= json_decode($geocode);
        for($j=0;$j<count($output->results[0]->address_components);$j++)
        {
            $cn=array($output->results[0]->address_components[$j]->types[0]);
            if(in_array("locality", $cn))
            {
                $destination_city= $output->results[0]->address_components[$j]->long_name; 
            }
        }
    
        // Remove numbers from city names
        $source_city = preg_replace('/\d+/', '', $source_city);
        $destination_city = preg_replace('/\d+/', '', $destination_city);
        
        // Trim whitespaces
        $source_city = trim($source_city);
        $destination_city = trim($destination_city);
        
        // // Case-insensitive comparison
        // if (strcasecmp($source_city, $destination_city) == 0) {
        //      $city_status = 'In City';
        // } else {
        //      $city_status = 'Out City';
        // }
        if($source_city == $destination_city){ $city_status='In City';}elseif($source_city!=$destination_city){  $city_status='Out City';}
       
        $fetch=mysqli_query($con,"SELECT * FROM  `company_car_tbl` WHERE car_id='$vehicle_type_id'"); 
        $rows=mysqli_num_rows($fetch);
        if($rows>0)
        {
            while($row=mysqli_fetch_assoc($fetch))
            {
    			$em=$row['id'];
    		    $comp_id = $row['company_id'];
    		 
                $distance_fare = $row['distance_fare'];
                $base_fare = $row['base_fare'];
                
                $select_com= mysqli_query($con,"SELECT * FROM  `company_register` WHERE id='$comp_id'"); 
                $row_com=mysqli_fetch_assoc($select_com);
                $admin_commission = $row_com['admin_commission'];
    		   
                $select_single = mysqli_query($con,"SELECT * FROM  `tbl_fair_cost` WHERE (city1_name='$source_city' AND city2_name='$destination_city' AND company_id='$comp_id') OR (city1_name='$destination_city' AND city2_name='$source_city' AND company_id='$comp_id')"); 
                $row_single=mysqli_fetch_assoc($select_single);
                 $count = mysqli_num_rows($select_single);
                //  echo "<br>";
              
                
            //     if($city_status =='Out City')
            //     {  
            //         $ride_com = round(($ride_price*$admin_commission)/100, -1);
        		  //  $ride_com_new = round($ride_price+$ride_com,-1);
        		  //  $ride_com_discount =round(($discount*$ride_com_new)/100, -1); 
        		  //  $tot_price_ride_com = round($ride_com_new-$ride_com_discount,-1);
        		    
        	   // 	$ms['trip_fare'] = $ride_price;
            //         $trip_fare = $ride_price;
    		      //  $commission= $ride_com; 
    		      //  $grand_total = $ride_com_new;
    		      //  $discount = $ride_com_discount;
    		      //  $total_price=$tot_price_ride_com;
            //     }
            //     elseif($city_status =='In City')
            //     {
            //         $bp1 = $base_fare;
            //         $bp = round(($base_fare*$admin_commission)/100, -1);
        		  //  $bp_new = round($base_fare+$bp,-1);
        		  //  $bp_discount =round(($discount*$bp_new)/100, -1); 
        		  //  $tot_price_bp = round($bp_new-$bp_discount,-1);
                    
            //         $dp1 = $distance_fare*$distance;
            //         $dp = round((($distance_fare*$distance)*$admin_commission)/100, -1);
        		  //  $dp_new = round($distance_fare*$distance+$dp,-1);
        		  //  $dp_discount =round(($discount*$dp_new)/100, -1); 
        		  //  $tot_price_dp = round($dp_new-$dp_discount,-1);
        		    
        		  //  if($bp1>$dp1)
        		  //  {
        		  //      $ms['trip_fare'] = $bp1;
        		  //      $trip_fare = $bp1;
        		  //      $commission= $bp; 
        		  //      $grand_total = $bp_new;
        		  //      $discount = $bp_discount;
        		  //      $total_price=$tot_price_bp;
        		  //  }
        		  //  elseif($dp1>$bp1)
        		  //  {
        		  //      $ms['trip_fare'] = $dp1;
        		  //      $trip_fare = $dp1;
        		  //      $commission= $dp; 
        		  //      $grand_total = $dp_new;
        		  //      $discount = $dp_discount;
        		  //      $total_price=$tot_price_dp;
        		  //  }
            //     }
                
                
                if($city_status =='Out City')
                {  
                    if($count>0){$ride_price = $row_single['ride_share_ride']; } else {$ride_price ='0'; }
            	    $ms['trip_fare'] = $ride_price;
                }
                elseif($city_status =='In City')
                {
                     $bp1 = $base_fare;
                //  echo "<br>"; 
                    $dp1 =ceil($distance_fare*$distance);
                  // echo "<br>"; 
                    
                    if($bp1>$dp1)
                    {
                        $ms['trip_fare'] = $bp1;
                    }
                    elseif($dp1>$bp1)
                    {
                        $ms['trip_fare'] = $dp1;
                    }
                }
                array_push($array,$ms);
            }
            $max = max(array_column($array, 'trip_fare'));
            if($max == "")
            {
                $msg['max_trip_cost']= "0";
            }
            else
            {
                $msg['max_trip_cost']= strval($max);
            }
            
        //   echo "<br>";
            $min = min(array_column($array, 'trip_fare'));
            if($min == "")
            {
                $msg['min_trip_cost'] = "0";
            }
            else
            {
                $msg['min_trip_cost'] = strval($min);
            }
            
           $msg['city_type']= $city_status;
        } 
        else
        {
            $msg['max_trip_cost']= "0";
            $msg['min_trip_cost'] = "0";
            $msg['city_type']= $city_status;
        }
        echo json_encode($msg, JSON_UNESCAPED_SLASHES); 
         die;
    }
    /*------------tantative_booking_price---------*/
    
    
    /*--------delete_user-------*/
    function delete_user()
    {
    include "config.php";
    $user_id=$_REQUEST['user_id'];
    
    $delete = mysqli_query($con,"DELETE FROM `user_register` WHERE id='$user_id'");
    if($delete)
    {
        $message['result']="success";
    }
    else
    {
        $message['result']="unsuccess";
    }
    echo json_encode($message, JSON_UNESCAPED_SLASHES);
    die;     
    }
    /*--------delete_user--------*/  
    
    /*--------delete_driver-------*/
    function delete_driver()
    {
    include "config.php";
    $driver_id=$_REQUEST['driver_id'];
    
    $delete = mysqli_query($con,"DELETE FROM `Drivers` WHERE DriverID ='$driver_id'");
    if($delete)
    {
        $message['result']="success";
    }
    else
    {
        $message['result']="unsuccess";
    }
    echo json_encode($message, JSON_UNESCAPED_SLASHES);
    die;     
    }
    /*--------delete_driver--------*/  
    
    /*----- social_login_fb_gmail ---------*/
    function social_login_fb_gmail()
    {
        include "config.php";
       
        $type=$_REQUEST['log_type'];
        $fbid=$_REQUEST['fb_id'];
        $apid=$_REQUEST['ap_id'];
        $google_id=$_REQUEST['google_id'];
        $fname = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $contact = $_REQUEST['contact'];
        
        $filename=$_FILES['image_url']['name'];
        $tmpname=$_FILES["image_url"]["tmp_name"];
        $ext=substr($filename,strpos($filename,"."));
        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
        $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
        if(move_uploaded_file($tmpname,"../images/$finame"));
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        
        if($type=='Google')
        {
            $select=mysqli_query($con, "SELECT * FROM `user_register` where email='$email' OR social_id='$google_id'");
            $row=mysqli_num_rows($select);
            $result=mysqli_fetch_assoc($select);
            $email1=$result['email'];
            $code1=$result['country_code'];
            $contact1=$result['contact'];
            if($email==$email1) 
            {
                $message['result']="This email id already exists.";
                $message['insert_id']=$result['id'];
            }
           
            else
            {
                $ins=mysqli_query($con,"INSERT INTO `user_register`(`full_name`, `middle_name`, `sur_name`, `gender`, `email`, `password`, `country_code`, `contact`, `wrok`, `image`, `device_id`, `iosdevice_id`, `device_status`, `address`, `lat`, `long`, `status`, `date`, `user_wallet`, `user_status`, `access_token`, `booking_cancel_time`, `type`, `google_token`, `facebook_token`, `apple_token`, `created_at`, `updated_at`, `secret_key`, `firebase_id`, `invite_code`, `company_id`, `generated_code`, `code_start_date`, `code_end_date`, `country_flag`, `id_proof_image`, `id_expiry_date`, `social_id`, `social_type`)
                                     VALUES('$fname','','','','$email','','','$contact','','$finame','','','','','','','Approve','$date','','','','','','','','','','','','','','','','','','','','','$google_id','Google')");
          // die(mysqli_error($con));
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0)
                {                    
                    $message['result']="success";
                    $message['insert_id']="$insert_id";
                  
                }
                else
                {
                    $message['result']="Oops something went wrong please try again later or use other login types.";
                }
            }
            echo json_encode($message,JSON_UNESCAPED_SLASHES);
            die;
        }
        elseif($type=='Facebook')
        {
            $sql_google=mysqli_query($con,"SELECT * FROM user_register WHERE email='$email' OR social_id='$fbid'");
            $row_fecth_google=mysqli_fetch_assoc($sql_google);
            $count=mysqli_num_rows($sql_google);
            $user_id_google=$row_fecth_google['id'];
            $f_email_google=$row_fecth_google['email'];
            $f_fb_id=$row_fecth_google['social_id'];
            if($fbid==$f_fb_id)
            {
                $message['result']="This facebook id already exists.";
                $message['insert_id']="$user_id_google";
            }
            elseif($email==$f_email_google)
            {
                $message['result']="This email id already exists.";
                $message['insert_id']="$user_id_google";
            }
           
            else
            {
               $ins=mysqli_query($con,"INSERT INTO `user_register`(`full_name`, `middle_name`, `sur_name`, `gender`, `email`, `password`, `country_code`, `contact`, `wrok`, `image`, `device_id`, `iosdevice_id`, `device_status`, `address`, `lat`, `long`, `status`, `date`, `user_wallet`, `user_status`, `access_token`, `booking_cancel_time`, `type`, `google_token`, `facebook_token`, `apple_token`, `created_at`, `updated_at`, `secret_key`, `firebase_id`, `invite_code`, `company_id`, `generated_code`, `code_start_date`, `code_end_date`, `country_flag`, `id_proof_image`, `id_expiry_date`, `social_id`, `social_type`)
                                     VALUES('$fname','','','','$email','','','$contact','','$finame','','','','','','','Approve','$date','','','','','','','','','','','','','','','','','','','','','$fbid','Facebook')");
           
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0)
                {
                    $message['result']="success";
                    $message['insert_id']="$insert_id";
                }
                else
                {
                    $message['result']="Oops something went wrong please try again later or use other login types.";
                }
            }
            echo json_encode($message,JSON_UNESCAPED_SLASHES);
            die; 
        }
        elseif($type=='Apple')
        {
            $sql_google=mysqli_query($con,"SELECT * FROM user_register WHERE email='$email' OR social_id='$apid'");
            $row_fecth_google=mysqli_fetch_assoc($sql_google);
            $count=mysqli_num_rows($sql_google);
            $user_id_google=$row_fecth_google['id'];
            $f_email_google=$row_fecth_google['email'];
            $f_ap_id=$row_fecth_google['social_id'];
            if($apid==$f_ap_id)
            {
                $message['result']="This apple id already exists.";
                $message['insert_id']="$user_id_google";
            }
            elseif($email==$f_email_google)
            {
                $message['result']="This email id already exists.";
                $message['insert_id']="$user_id_google";
            }
            // elseif($contact==$contact1 &&  $code1== $code ) 
            // {
            //     $message['result']="This contact already exists.";
            //     $message['insert_id']=$result['id'];
            // }
            else
            {
                $ins=mysqli_query($con,"INSERT INTO `user_register`(`full_name`, `middle_name`, `sur_name`, `gender`, `email`, `password`, `country_code`, `contact`, `wrok`, `image`, `device_id`, `iosdevice_id`, `device_status`, `address`, `lat`, `long`, `status`, `date`, `user_wallet`, `user_status`, `access_token`, `booking_cancel_time`, `type`, `google_token`, `facebook_token`, `apple_token`, `created_at`, `updated_at`, `secret_key`, `firebase_id`, `invite_code`, `company_id`, `generated_code`, `code_start_date`, `code_end_date`, `country_flag`, `id_proof_image`, `id_expiry_date`, `social_id`, `social_type`)
                                     VALUES('$fname','','','','$email','','','$contact','','$finame','','','','','','','Approve','$date','','','','','','','','','','','','','','','','','','','','','$apid','Apple')");
           
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0)
                {
                    $message['result']="success";
                    $message['insert_id']="$insert_id";
                }
                else
                {
                    $message['result']="Oops something went wrong please try again later or use other login types.";
                }
            }
            echo json_encode($message,JSON_UNESCAPED_SLASHES);
            die; 
        }
    }
    /*----- social_login_fb_gmail ---------*/
    
     
     /*------fetch_package_price-----*/
    function fetch_package_price()
    {
        include('config.php');
        $array = array();
        $path="https://cisswork.com/Android/SenderApp/car_img/";
        
        $Package_name = $_REQUEST['Package_name']; // Mini Small Large Extra Large
        $FromArea1 = $_REQUEST['FromArea'];
        $FromArea = strtolower($FromArea1);
        
        $ToArea1 = $_REQUEST['ToArea'];
        $ToArea = strtolower($ToArea1);
        
        $ZipCode1 = $_REQUEST['ZipCode1'];
        $ZipCode2 = $_REQUEST['ZipCode2'];
        
        $sql_source=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$ZipCode1'");
        $count_source=mysqli_num_rows($sql_source);
        $fetch_source=mysqli_fetch_assoc($sql_source);
        $source_area = $fetch_source['AreaName'];
        
        $sql_destination=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$ZipCode2'");
        $count_destination=mysqli_num_rows($sql_destination);
        $fetch_destination=mysqli_fetch_assoc($sql_destination);
        $destination_area = $fetch_destination['AreaName'];
        
        if($count_source >0 && $count_destination > 0)
        {
            $sql_route = mysqli_query($con, "SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area')");
            $fetch_sql_route = mysqli_fetch_assoc($sql_route);
            $a = $fetch_sql_route['Price1']; 
            $b = $fetch_sql_route['Price2']; 
            $c = $fetch_sql_route['Price3']; 
            $d = $fetch_sql_route['Price4']; 
            $count_sql_route = mysqli_num_rows($sql_route);
            if($count_sql_route > 0)
            {
                if($Package_name == 'Mini')
                {
                    $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                    $row=mysqli_fetch_assoc($sql);
                    $message['result']="Success";
                    $message['package_id']= $row['id'];
                    $message['package_name']= $row['package_name'];
                    if($row['image']=='')
                    {
                      $message["Image"]=$path."user.png";
                    }
                    else
                    {
                      $message["image"]=$path.$row['image'];
                    }
                    $message['capacity']= $row['capacity'] . "Kg";
                    $message['size']= $row['size'];
                    $message['service_charge']= $a;
                }
                elseif($Package_name == 'Small')
                {
                    $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                    $row=mysqli_fetch_assoc($sql);
                    $message['result']="Success";
                    $message['package_id']= $row['id'];
                    $message['package_name']= $row['package_name'];
                    if($row['image']=='')
                    {
                      $message["Image"]=$path."user.png";
                    }
                    else
                    {
                      $message["image"]=$path.$row['image'];
                    }
                    $message['capacity']= $row['capacity'] . "Kg";
                    $message['size']= $row['size'];
                    $message['service_charge']= $b;
                }
                elseif($Package_name == 'Large')
                {
                    $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                    $row=mysqli_fetch_assoc($sql);
                    $message['result']="Success";
                    $message['package_id']= $row['id'];
                    $message['package_name']= $row['package_name'];
                    if($row['image']=='')
                    {
                      $message["Image"]=$path."user.png";
                    }
                    else
                    {
                      $message["image"]=$path.$row['image'];
                    }
                    $message['capacity']= $row['capacity'] . "Kg";
                    $message['size']= $row['size'];
                    $message['service_charge']= $c;
                }
                elseif($Package_name == 'Extra Large')
                {
                    $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                    $row=mysqli_fetch_assoc($sql);
                    $message['result']="Success";
                    $message['package_id']= $row['id'];
                    $message['package_name']= $row['package_name'];
                    if($row['image']=='')
                    {
                      $message["Image"]=$path."user.png";
                    }
                    else
                    {
                      $message["image"]=$path.$row['image'];
                    }
                    $message['capacity']= $row['capacity'] . "Kg";
                    $message['size']= $row['size'];
                    $message['service_charge']= $d;
                }
            }
            else
            {
                 $message['result']="These Area Name are not added. Please try with different Area Names!!"; 
            }
        }
        else
        {
             $message['result']="These ZipCode are not added. Please try with different ZipCode!!";
        }
    
        echo json_encode($message, JSON_UNESCAPED_SLASHES); 
        die;
    }
     /*------fetch_package_price-----*/
     
    /*------------user_booking---------*/
       function user_booking()
       {
            include ('config.php');
            // Include Stripe library
            require_once 'stripe-payment/vendor/autoload.php'; // Include Stripe PHP library
            $card_id=$_REQUEST['card_id'];
            $uid=$_REQUEST['user_id'];
            $coupen_id=$_REQUEST['coupen_id'];
            $package_id=$_REQUEST['parcel_type'];
            $package_name=$package_id;
            $ride_time1=$_REQUEST['ride_time'];
            $ride_date1=$_REQUEST['ride_date'];
            $pay_mode=$_REQUEST['payment_mode'];   //Card  Cash
            $source= $_REQUEST['pickup_address'];
            $source_zipcode=$_REQUEST['source_zipcode'];
            $destination_zipcode=$_REQUEST['destination_zipcode'];
            $source_lat= $_REQUEST['pickup_lat'];
            $source_long= $_REQUEST['pickup_lng'];
            $destination= $_REQUEST['drop_address'];
            $destination_lat= $_REQUEST['drop_lat'];
            $destination_lng= $_REQUEST['drop_lng'];
            $ride_type=$_REQUEST['ride_type'];     //Ride_now ..Ride_later
            $pickup_contact = $_REQUEST['pickup_contact'];  //preffered_company == '1' ... open_to_all=== '0'
            $drop_contact = $_REQUEST['drop_contact'];
            $amount = $_REQUEST['amount'];  //original price
            $discount_amount = $_REQUEST['discount_amount']; //discounted Price
            $total_amount = $_REQUEST['total_amount']; // (original price-discounted Price)
            $notes = $_REQUEST['notes']; 
            $payment_id = $_REQUEST['payment_id']; 
            $payment_method_id = $_REQUEST['payment_method_id']; 
            
            
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y');
            $time = date('h:i A');
            $lat_long_key="AIzaSyD6KJOHKQLUWMAh9Yl5NQrEAI9bxrvYCqQ";
            $current = (new \DateTime())->format('d-m-Y h:i A');
            
            
            $test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
            $Live_key = '';
                    
            
            $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$source_lat.','.$source_long.'&sensor=false'.'&key='.$lat_long_key);
            $output= json_decode($geocode);
            for($j=0;$j<count($output->results[0]->address_components);$j++)
            {
                $cn=array($output->results[0]->address_components[$j]->types[0]);
                if(in_array("locality", $cn))
                {
                   $source_city= $output->results[0]->address_components[$j]->long_name; 
                }
            }                                                                                                                                         
            
            $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$destination_lat.','.$destination_lng.'&sensor=false'.'&key='.$lat_long_key);
            $output= json_decode($geocode);
            for($j=0;$j<count($output->results[0]->address_components);$j++)
            {
                $cn=array($output->results[0]->address_components[$j]->types[0]);
                if(in_array("locality", $cn))
                {
                    $destination_city= $output->results[0]->address_components[$j]->long_name; 
                }
            }
        
            // Remove numbers from city names
            $source_city = preg_replace('/\d+/', '', $source_city);
            $destination_city = preg_replace('/\d+/', '', $destination_city);
            
            // Trim whitespaces
            $source_city = trim($source_city);
            $source_city = strtolower($source_city);
            $destination_city = trim($destination_city);
            $destination_city = strtolower($destination_city);
        
        
            if($source_city==$destination_city){$city_status='In City';}elseif($source_city!=$destination_city){$city_status='Out City';}
            
            if($ride_type=='Ride_now'){ $ride_time=$time; $ride_date=$date; }elseif($ride_type=='Ride_later'){ $ride_time=$ride_time1; $ride_date=$ride_date1; }
            
            $sql_source=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$source_zipcode'");
            $count_source=mysqli_num_rows($sql_source);
            $fetch_source=mysqli_fetch_assoc($sql_source);
            $source_area = $fetch_source['AreaName'];
            
            $sql_destination=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$destination_zipcode'");
            $count_destination=mysqli_num_rows($sql_destination);
            $fetch_destination=mysqli_fetch_assoc($sql_destination);
            $destination_area = $fetch_destination['AreaName'];
            
            if($count_source >0 && $count_destination > 0)
            {
                $select = mysqli_query($con,"SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area')");
                $count_area = mysqli_num_rows($select);
                $fetch_area = mysqli_fetch_assoc($select);
                $route_id = $fetch_area['RouteID'];
            }
            
            $yu=mysqli_query($con,"select * from user_register where id='$uid'");
            $yu1=mysqli_fetch_assoc($yu);
            $name= $yu1['full_name']." ".$yu1['middle_name']." ".$yu1['sur_name'];
            $email= $yu1['email'];
            $ccode=$yu1['country_code'];
            $contact= $yu1['contact'];
           
            // $sql="SELECT * FROM tbl_package WHERE id='$package_id'";
            // $res=mysqli_query($con,$sql);
            // $row=mysqli_fetch_assoc($res);
            // $package_name= $row['package_name'];
            
            if(strtotime($current) <= strtotime($ride_date." ".$ride_time))
            {
                if($pay_mode=='Cash')
                {
                    if($count_area == '0')
                    {
        	            $msg1["result"] = "Currently we are not offering for these areas. Please check other areas!"; 
                    }
                    else
                    {
                        $sel=mysqli_query($con,"INSERT INTO `notification_tbl`(`user_id`, `u_name`, `email`, `country_code`, `u_contact`, `ride_type`, `package_id`, `package_name`, `car_id`, `payment_mode`, `booking_type`, `card_id`, `ride_date`, `ride_time`, `start_time`, `complete_time`, `source_add`, `destination_add`, `driver_id`, `message`, `source_lat`, `source_long`, `destination_lat`, `destination_long`, `driver_status`, `confirmation_code`, `type_name`, `admin_commission`, `driver_earning`, `cancel_by`, `coupon_id`, `date`, `time`, `source_city`, `destination_city`, `city_status`, `cancel_reason`, `ride_end_date`, `ride_end_time`, `trip_fare`, `total_fare`, `discount`, `pickup_contact`, `drop_contact`,notes,payment_id)
                                                                VALUES('$uid','$name','$email','$ccode','$contact','$ride_type','$package_id','$package_name','','$pay_mode','$booking_type','$card_id','$ride_date','$ride_time','','','$source','$destination','','','$source_lat','$source_long','$destination_lat','$destination_lng','New Booking','','','','','','$coupen_id','$date','$time','$source_city','$destination_city','$city_status','','','','$amount','$total_amount','$discount_amount','$pickup_contact','$drop_contact','$notes','$payment_id')");
                        //die(mysqli_error($con));
                    	$insert_id=mysqli_insert_id($con);
                    	
                    	$fetch = mysqli_query($con, "SELECT * FROM `Drivers` WHERE Driver_lat != '0' AND Driver_lng != '0' AND Status = '1' AND NotifyType ='1' AND FIND_IN_SET('$route_id', zipcode_list) > 0 ORDER BY DriverID  ASC");
                        $rows=mysqli_num_rows($fetch);
                        if($rows>0)
                        {
                            while($row=mysqli_fetch_assoc($fetch))
                            {
                    			$em=$row['DriverID'];
                                
                                $select_com= mysqli_query($con,"SELECT * FROM  `company_register` WHERE id='$comp_id'"); 
                                $row_com=mysqli_fetch_assoc($select_com);
                                $admin_commission = $row_com['admin_commission'];
                    		   
                    		    // $ride_com = round(($ride_price*$admin_commission)/100, -1);
                        		//  $ride_com_new = round($ride_price+$ride_com,-1);
                        	    //  $ride_com = round(($ride_price * $admin_commission) / 100);
                                //  $ride_com_new = round($ride_price + $ride_com, -1);
                        		//  $ride_com_discount =round(($discount*$ride_com_new)/100, -1); 
                        		//  $tot_price_ride_com = round($ride_com_new-$ride_com_discount,-1);
                        	
                        	   //    $trip_fare = $ride_price;
                    		      //  $commission= $ride_com; 
                    		      //  $grand_total = $ride_com_new;
                    		      //  $discount = $ride_com_discount;
                    		      //  $total_price=$tot_price_ride_com;
                    		        $trip_fare = 0;
                    		        $commission= 0; 
                    		        $grand_total = $amount;
                    		        $discount = $discount_amount;
                    		        $total_price=$total_amount;
                    		        
                                    $sql2=mysqli_query($con,"INSERT INTO `panding_booking_request_driver`(`trip_id`, `user_id`, `driver_id`, `total_price`, `ride_type`, `source_city`, `destination_city`, `city_status`, `status`, `date`, `time`, `admin_commission`, `trip_fare`, `total_fare`, `discount`, `coupen_id`,notes)
                                                VALUES ('$insert_id','$uid','$em','$total_price','$ride_type','$source_city','$destination_city','$city_status','New Booking','$date','$time','','','$grand_total','$discount','$coupen_id','$notes')");
                                                
                                    require_once __DIR__ . '/firebase.php';
                                    require_once __DIR__ . '/push.php';
                                    
                                    $firebase = new Firebase1();
                                    $push = new Push1();
                                    
                                    // optional payload
                                    $payload = array();
                                    $payload['team'] = 'India';
                                    $payload['score'] = '7.6';
                                    
                                    // notification title
                                    $title= "New Booking Request!";
                                    // notification message
                                    $message="Booking #$insert_id successfully placed";
                                    
                                  // $include_image = "";
                                    $push->setTitle($title);
                                    $push->setMessage($message);;
                                    $push->setIsBackground(FALSE);
                                    $push->setPayload($payload);
                                    
                                    
                                    $sql_userId=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID='$em'");
                                    $number_of_rows1=mysqli_num_rows($sql_userId);
                                    
                                    if($number_of_rows1==0)
                                    {
                                        $msg["result"]="unsuccessful";
                                    }
                                    else
                                    {
                                        //date_default_timezone_set('Asia/Kolkata');
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d');
                                        $time = date('h:i A');
        
                                        $row1=mysqli_fetch_assoc($sql_userId);
                                        $ds=$row1['device_status'];
                                        if($ds=='IOS' || $ds=='Android')
                                        {
                                            $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                      VALUES ('$insert_id','','$em','$title','$message','$date','$time','System')");
                                
                                            $regId=$row1['Driver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $response = $firebase->send($regId, $json);
                                            
                                            $deviceToken=$row1['iosDriver_device_id'];
                                            $json = '';
                                            $response = '';
                                            $json = $push->getPush();
                                            $iosresponse = $firebase->send($deviceToken, $json);
                                                //IOS notification code
                                            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                
                                             //The device token.
                                            if($ds=='IOS')
                                            {
                                                $token = $deviceToken;
                                            }
                                            elseif($ds=='Android')
                                            {
                                                $token = $regId;
                                            }
                                            //Title of the Notification.
                                            $titlez = $title;
                                            //Body of the Notification.
                                            $body =$message;
                                            $type=$type;
                                            //Creating the notification array.
                                            $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                            
                                            //This array contains, the token and the notification. The 'to' attribute stores the token.
                                            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                            
                                            $json = json_encode($arrayToSend);
                                            //Setup headers:
                                            $headers = array();
                                            $headers[] = 'Content-Type: application/json';
                                            $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here 
                                            //Setup curl, add headers and post parameters.
                                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                            //Send the request
                                            $response = curl_exec($ch);
                                            
                                            //Close request
                                            curl_close($ch);
                                        }
                                        
                                    }                  
                            }
                        } 
            
                        $select_com = mysqli_query($con,"SELECT * FROM `panding_booking_request_driver` WHERE trip_id='$insert_id'");
                        $number_com =mysqli_num_rows($select_com);
                        if($number_com > '0')
                        {
                            $msg1['booking_id']=$insert_id;
                        	$msg1["result"] = "successfully"; 
                        
                            // $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                            //                          VALUES ('$insert_id','$uid','','New booking request','Booking #$insert_id successfully placed','$date','$time','System')");
                            
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                  $title= "New booking request";
                                // notification message
                                 $message = "Booking #$insert_id successfully placed";
                                
                              // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$uid'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    //date_default_timezone_set('Asia/Kolkata');
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$uid','','New booking request','Booking #$insert_id successfully placed','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                        
                                        //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                
                                        //The device token.
                                        //$token = $regId;
                                        //Title of the Notification.
                                        $titlez = $title;
                                        //Body of the Notification.
                                        $body =$message;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                      //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                         $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                        
                        }
                        else
                        {
                            $update = mysqli_query($con," DELETE FROM `notification_tbl` WHERE id='$insert_id'");
                        	$msg1["result"] = "there is no driver available for this vehicle's category , Please select different vehicle category!!";
                        }
                    }
                }
                elseif($pay_mode=='Card')
                { 
                    if($count_area == '0')
                    {
        	            $msg1["result"] = "Currently we are not offering for these areas. Please check other areas!"; 
                    }
                    else
                    {
                        try 
                        {
                            $con->autocommit(FALSE); // Turn off autocommit
                            // Replace 'sk_test_...' with your actual secret API key
                            $stripe = new \Stripe\StripeClient($test_key);
                            $paymentIntentId = $payment_id;
                            // Confirm the PaymentIntent
                             $paymentIntent = $stripe->paymentIntents->confirm(
                                $paymentIntentId,
                                [
                                  //  'payment_method' => 'pm_1P142PIhs7ZBuE9xcfHZhsog'
                                    'payment_method' => $payment_method_id
                                ] // Replace with the payment method ID or card details
                            );
    
                            // Handle confirmation success
                           // $msg1["result"] = "Payment intent confirmed successfully.";
                           
                            $sel=mysqli_query($con,"INSERT INTO `notification_tbl`(`user_id`, `u_name`, `email`, `country_code`, `u_contact`, `ride_type`, `package_id`, `package_name`, `car_id`, `payment_mode`, `booking_type`, `card_id`, `ride_date`, `ride_time`, `start_time`, `complete_time`, `source_add`, `destination_add`, `driver_id`, `message`, `source_lat`, `source_long`, `destination_lat`, `destination_long`, `driver_status`, `confirmation_code`, `type_name`, `admin_commission`, `driver_earning`, `cancel_by`, `coupon_id`, `date`, `time`, `source_city`, `destination_city`, `city_status`, `cancel_reason`, `ride_end_date`, `ride_end_time`, `trip_fare`, `total_fare`, `discount`, `pickup_contact`, `drop_contact`,notes,payment_id,payment_method_id, `source_zipcode`, `destination_zipcode`)
                                                                VALUES('$uid','$name','$email','$ccode','$contact','$ride_type','$package_id','$package_name','','$pay_mode','$booking_type','$card_id','$ride_date','$ride_time','','','$source','$destination','','','$source_lat','$source_long','$destination_lat','$destination_lng','New Booking','','','','','','$coupen_id','$date','$time','$source_city','$destination_city','$city_status','','','','$amount','$total_amount','$discount_amount','$pickup_contact','$drop_contact','$notes','$payment_id','$payment_method_id','$source_zipcode','$destination_zipcode')");
                            //die(mysqli_error($con));
                        	$insert_id=mysqli_insert_id($con);
                        	if($insert_id > '0')
                        	{
                        	    $fetch = mysqli_query($con, "SELECT * FROM `Drivers` WHERE Status = '1' AND FIND_IN_SET('$route_id', zipcode_list) > 0 ORDER BY DriverID  ASC");
                                $rows=mysqli_num_rows($fetch);
                                if($rows>0)
                                {
                                    while($row=mysqli_fetch_assoc($fetch))
                                    {
                            			$em=$row['DriverID'];
                                        
                                        $select_com= mysqli_query($con,"SELECT * FROM  `company_register` WHERE id='$comp_id'"); 
                                        $row_com=mysqli_fetch_assoc($select_com);
                                        $admin_commission = $row_com['admin_commission'];
                        		        $trip_fare = 0;
                        		        $commission= 0; 
                        		        $grand_total = $amount;
                        		        $discount = $discount_amount;
                        		        $total_price=$total_amount;
                        		        
                                        $sql2=mysqli_query($con,"INSERT INTO `panding_booking_request_driver`(`trip_id`, `user_id`, `driver_id`, `total_price`, `ride_type`, `source_city`, `destination_city`, `city_status`, `status`, `date`, `time`, `admin_commission`, `trip_fare`, `total_fare`, `discount`, `coupen_id`,notes)
                                                    VALUES ('$insert_id','$uid','$em','$total_price','$ride_type','$source_city','$destination_city','$city_status','New Booking','$date','$time','','','$grand_total','$discount','$coupen_id','$notes')");
                                                    
                                        require_once __DIR__ . '/firebase.php';
                                        require_once __DIR__ . '/push.php';
                                        
                                        $firebase = new Firebase1();
                                        $push = new Push1();
                                        
                                        // optional payload
                                        $payload = array();
                                        $payload['team'] = 'India';
                                        $payload['score'] = '7.6';
                                        
                                        // notification title
                                        $title= "New Booking Request!";
                                        // notification message
                                        $message="Booking #$insert_id successfully placed";
                                        
                                        $push->setTitle($title);
                                        $push->setMessage($message);;
                                        $push->setIsBackground(FALSE);
                                        $push->setPayload($payload);
                                        
                                        
                                        $sql_userId=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID='$em'");
                                        $number_of_rows1=mysqli_num_rows($sql_userId);
                                        
                                        if($number_of_rows1==0)
                                        {
                                            $msg["result"]="unsuccessful";
                                        }
                                        else
                                        {
                                            date_default_timezone_set('Asia/Kolkata');
                                            $date = date('Y-m-d');
                                            $time = date('h:i A');
            
                                            $row1=mysqli_fetch_assoc($sql_userId);
                                            $ds=$row1['device_status'];
                                            if($ds=='IOS' || $ds=='Android')
                                            {
                                                $sql1=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time ,`type`)
                                                          VALUES ('$insert_id','','$em','$title','$message','$date','$time','System')");
                                    
                                                $regId=$row1['Driver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $response = $firebase->send($regId, $json);
                                                
                                                $deviceToken=$row1['iosDriver_device_id'];
                                                $json = '';
                                                $response = '';
                                                $json = $push->getPush();
                                                $iosresponse = $firebase->send($deviceToken, $json);
                                                    //IOS notification code
                                                $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                    
                                                 //The device token.
                                                if($ds=='IOS')
                                                {
                                                    $token = $deviceToken;
                                                }
                                                elseif($ds=='Android')
                                                {
                                                    $token = $regId;
                                                }
                                                //Title of the Notification.
                                                $titlez = $title;
                                                //Body of the Notification.
                                                $body =$message;
                                                $type=$type;
                                                //Creating the notification array.
                                                $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                                
                                                //This array contains, the token and the notification. The 'to' attribute stores the token.
                                                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                                
                                                $json = json_encode($arrayToSend);
                                                //Setup headers:
                                                $headers = array();
                                                $headers[] = 'Content-Type: application/json';
                                                 $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                                //Setup curl, add headers and post parameters.
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                                //Send the request
                                                $response = curl_exec($ch);
                                                
                                                //Close request
                                                curl_close($ch);
                                            }
                                            
                                        }                  
                                    }
                                } 
                                        
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase1();
                                $push = new Push1();
                                
                                // optional payload
                                $payload = array();
                                $payload['team'] = 'India';
                                $payload['score'] = '7.6';
                                
                                // notification title
                                  $title= "New booking request";
                                // notification message
                                 $message = "Booking #$insert_id successfully placed";
                                
                              // $include_image = "";
                                $push->setTitle($title);
                                $push->setMessage($message);
                                
                                $push->setIsBackground(FALSE);
                                $push->setPayload($payload);
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$uid'");
                                $number_of_rows=mysqli_num_rows($sql_userId);
                                
                                if($number_of_rows==0)
                                {
                                  // $msg["result"]="unsuccessful";
                                }
                                else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d');
                                    $time = date('h:i A');
                    
                                    $row=mysqli_fetch_assoc($sql_userId);
                                    $ds=$row['device_status'];
                                    if($ds=='IOS' || $ds=='Android')
                                    {
                                        $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`,time, `type`)
                                                     VALUES ('$insert_id','$uid','','New booking request','Booking #$insert_id successfully placed','$date','$time','System')");
                           
                                        $regId=$row['device_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $response = $firebase->send($regId, $json);
                                        
                                        $deviceToken=$row['iosdevice_id'];
                                        $json = '';
                                        $response = '';
                                        $json = $push->getPush();
                                        $iosresponse = $firebase->send($deviceToken, $json);
                                            //IOS notification code
                                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                        
                                        //The device token.
                                        if($ds=='IOS')
                                        {
                                            $token = $deviceToken;
                                        }
                                        elseif($ds=='Android')
                                        {
                                            $token = $regId;
                                        }
                
                                        //Title of the Notification.
                                        $titlez = $title;
                                        //Body of the Notification.
                                        $body =$message;
                                        $type=$type;
                                        //Creating the notification array.
                                        $notification = array('title' =>$titlez , 'body' => $body, 'sound' => 'default', 'badge' => '1');
                                        
                                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                                        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                                        
                                        $json = json_encode($arrayToSend);
                                      //Setup headers:
                                        $headers = array();
                                        $headers[] = 'Content-Type: application/json';
                                        $headers[] = 'Authorization: key= AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                                        //Setup curl, add headers and post parameters.
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//to comment auto response 
                                        //Send the request
                                        $response = curl_exec($ch);
                                        
                                        //Close request
                                        curl_close($ch);
                                    }
                                }
                                // Commit the transaction if both operations are successful
                                $msg1['booking_id']=$insert_id;
                            	$msg1["result"] = "successfully"; 
                                $con->commit();
                        	}
                            else
                            {
                                $con->rollback();
                                // Display a database error message
                                $msg1["result"] = "Database error: " . mysqli_error($con);
                            }
                            $con->close();
                        } catch (\Stripe\Exception\ApiErrorException $e) {
                            // Handle error
                            $msg1["result"] = "Error confirming payment intent: " . $e->getMessage();
                        }
                    }
                }
            }
            elseif(strtotime($current)  > strtotime($ride_date." ".$ride_time))
            {
                $msg1["result"] = "Please select future time.";  
            }
            
            echo json_encode($msg1,JSON_UNESCAPED_SLASHES); 
            die;
        }
    /*------------user_booking---------*/

}
?>