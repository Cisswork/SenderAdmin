<?php
class Sender
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
             
            $car_type_id = $row['zipcode_list'];
            $array1  = array();
            if($car_type_id != "")
            {
                $shift = $car_type_id;
                $mm_array = array();
                $est_arr=array();
                $est_array=explode(',',$shift);
                $est_arr=$est_array;
                $count = count($est_arr);
                for($i=0; $i<count($est_arr); $i++)
                {
                    $b=$est_arr[$i];
                    $crf=mysqli_query($con,"select * from AreaFromTo where RouteID='$b'");
                    $rows=mysqli_fetch_assoc($crf);
                    $msg['id']= $rows['id'];
                    $msg['RouteID']= $rows['RouteID'];
                    $msg['FromArea']= $rows['FromArea'];
                    $msg['ToArea']= $rows['ToArea'];
                    array_push($array1,$msg);
                }
            }
            else
            {
                array_push($array1);
            }
            $message["route_list"]=$array1;
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
     
    /*------update_driver_route_list---------*/
    function update_driver_route_list()
    {
        include('config.php');
        $driver_id=$_REQUEST['driver_id'];
        $route_id_list = $_REQUEST['route_id_list'];
        
        $update="UPDATE `Drivers` SET zipcode_list='$route_id_list'  WHERE `DriverID`='$driver_id'";
        $res=mysqli_query($con,$update);
       // die(mysqli_error($con));
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
    /*-------update_driver_route_list--------*/ 
     
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
    
    /*------fetch_vehicle_type_list-----*/
    function fetch_vehicle_type_list()
    {
        include('config.php');
        $array = array();
        $path="https://cisswork.com/Android/SenderApp/car_img/";
        $sql="SELECT * FROM tbl_package WHERE status='Approve' ORDER BY id DESC";
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
    
    /*------user_signup-------------*/
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
        $name = $fname." ".$sname;
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
        
        $sql=mysqli_query($con,"SELECT * FROM `Senders` WHERE country_code='$country_code' AND Phone='$phn'");
        $row=mysqli_num_rows($sql);
        $sql1=mysqli_query($con,"SELECT * FROM `Senders` WHERE Email='$em'");
        $row1=mysqli_num_rows($sql1);
        
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
            $randomid = mt_rand(100000,999999);
            $FriendlyID='SEND'.$randomid;
                    
            $ins=mysqli_query($con,"INSERT INTO `Senders`(`FriendlyID`, `UserName`, `Password`, `FirstName`, `LastName`, `Address`, `Address2`, `City`, `State`, `Zip`, `Email`, `Phone`, `Phone2`, `Phone3`, `Status`, `PreferredPayment`, `ForceAuth`, `NotifyType`, `TimeStampCreated`, `LastUpdated`, `Stripe_CustomerId`, `country_code`, `country_flag`, `user_wallet`, `device_id`, `iosdevice_id`, `device_status`, `id_proof_image`, `id_expiry_date`,gender)
                                                  VALUES ('$FriendlyID','','$ps','$fname','$sname','$address','','','','','$em','$phn','','','Approve','','','','$date','','$customerId','$country_code','$CountryFlag','0','','','','$finame','$expiry_date','$gender')");
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
            	$to_email = $em;
                $subject = 'Welcome to Sender';
                $txt ="Hello $name"."\r\n"; 
                $txt.="Welcome to Sender "."\r\n";
                $txt.="Thanks"."\r\n";
                $txt.="Sender "."\r\n";
                $headers = "from:barkhapatelciss@gmail.com" . "\r\n" .
                 'X-Mailer: PHP/' . phpversion(); 
                $user_email=mail($to_email,$subject,$txt,$headers);
            }
            echo json_encode($message, JSON_UNESCAPED_SLASHES); 
            die;
        }
    }
    /*------user_signup-------------*/
    
    /*------ user_login-------*/
    function user_login()
    {
        include('config.php');
        $path="https://cisswork.com/Android/SenderApp/images/";
        $em=$_REQUEST['email'];
        $ps=$_REQUEST['password']; 
        
        $sel=mysqli_query($con,"SELECT * FROM `Senders` WHERE `Email`='$em' AND Password='$ps'");
        $count=mysqli_num_rows($sel);
        $row=mysqli_fetch_assoc($sel);
        $user_id = $row['SenderID'];
        $email = $row['Email'];
        $password = $row['Password'];
        $user_status= $row['Status'];
         
        if($count=='0')
        {
            $message["result"] = "Email or Password is incorrect";   
        }
        elseif($user_status=='D')
        {
            $message["result"] = "Your account is disapprove";   
        }
        else
        { 
            $message["result"] = "success"; 
            $message["user_id"] = $user_id; 
            $uid=$row['SenderID '];
            $message["first_name"]=$row['FirstName'];
            $message['last_name'] = $row['LastName'];
            $message["email"]=$row['Email']; 
            $message['country_code']=$row['country_code'];
            $message["password"]=$row['Password']; 
            $message["contact"]=$row['Phone'];
            $message['gender']= $row['gender'];
            $message["invite_code"]="";
            $message["Address"]=$row['Address'];
            $iim=$row['image'];
            if($iim=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
             $message["Image"]=$path.$iim;
            }
            $message["status"]=$row['Status']; 
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
        $sel=mysqli_query($con,"SELECT * FROM `Senders` WHERE `SenderID`='$user_id'");
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
            $upd=mysqli_query($con,"UPDATE Senders SET device_id='',iosdevice_id='',device_status='' WHERE `SenderID`='$user_id'");
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
    /*------ update_user_password-------*/
    function update_user_password()
    {
          include('config.php');
          $uid=$_REQUEST['userid'];
          $plaintext_password=$_REQUEST['password'];
          $new_password=password_hash($plaintext_password, PASSWORD_DEFAULT);
          $sel=mysqli_query($con,"SELECT * FROM Senders WHERE id='$uid'");
          $fetch=mysqli_fetch_assoc($sel);
          $count = mysqli_num_rows($sel);
          if($count==0)
          {
             $message["result"]="Unsuccess";
          }
          else
          {
            $upd=mysqli_query($con,"UPDATE `Senders` SET `Password`='$plaintext_password' WHERE id='$uid'");
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
           $upd=mysqli_query($con,"UPDATE `Senders` SET `device_id`='$device_id',`iosdevice_id`='',device_status='Android' WHERE `SenderID`='$email'");
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
           $upd=mysqli_query($con,"UPDATE `Senders` SET `device_id`='',`iosdevice_id`='$device_id',device_status='IOS'  WHERE `id`='$email'");
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
        $upd=mysqli_query($con,"SELECT * FROM `Senders` WHERE `SenderID`='$user_id'");
       
        if($sel=mysqli_fetch_assoc($upd))
        {
            $message["result"]="successfully";
            $message["id"]=$sel['SenderID'];
            $message["first_name"]=$sel['FirstName'];
            $message['last_name'] = $sel['LastName'];
            $message["email"]=$sel['Email']; 
            $message['country_code']=$sel['country_code'];
            $message["password"]=$sel['Password']; 
            $message["contact"]=$sel['Phone'];
            $message['gender']= $sel['gender'];
            $message["invite_code"]="";
            $message["Address"]=$sel['Address'];
            $message['CountryFlag']=$sel['country_flag'];
            if($sel['image']=='')
            {
              $message["Image"]=$path."user.png";
            }
            else
            {
              $message["Image"]=$path.$sel['image'];
            }
            $message["status"]=$sel['Status'];
            
            if($sel['id_proof_image']=='')
            {
              $message["id_proof_image"]=$path."user.png";
            }
            else
            {
              $message["id_proof_image"]=$path.$sel['id_proof_image'];
            }
            $message["id_expiry_date"]=$sel['id_expiry_date'];
            $message["customerID"]=$sel['Stripe_CustomerId'];
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
                    $update="UPDATE `Senders` SET `FirstName`='$first_name',LastName='$last_name',country_code='$ccode',company_id='$company_id',`Phone`='$phn',`Email`= '$email',country_flag='$countryflag',id_expiry_date='$expiry_date'  WHERE `SenderID`='$user_id'";
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
                    $update="UPDATE `Senders` SET `FirstName`='$first_name',LastName='$last_name',country_code='$ccode',company_id='$company_id',`Phone`='$phn',`Email`= '$email',country_flag='$countryflag',id_proof_image='$finame',id_expiry_date='$expiry_date'  WHERE `SenderID`='$user_id'";
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
                    $update="UPDATE `Senders` SET `FirstName`='$first_name',LastName='$last_name',country_code='$ccode',company_id='$company_id',`Phone`='$phn',`Email`= '$email',Password ='$password',country_flag='$countryflag',id_expiry_date='$expiry_date'  WHERE `SenderID`='$user_id'";
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
                    $update="UPDATE `Senders` SET `FirstName`='$first_name',LastName='$last_name',country_code='$ccode',company_id='$company_id',`Phone`='$phn',`Email`= '$email',Password ='$password',country_flag='$countryflag',id_proof_image='$finame',id_expiry_date='$expiry_date'  WHERE `SenderID`='$user_id'";
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
        
        $update="UPDATE `Senders` SET `image`='$finame' WHERE  `SenderID`='$user_id'";
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
            
            $select = mysqli_query($con,"SELECT * FROM Senders WHERE SenderID='$user_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"] = $ss['FirstName'] . " " . $ss['LastName']; 
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
                $select_d= mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID = '$did'");
                $fetch_d= mysqli_fetch_assoc($select_d);
           
                $message['name'] = $fetch_d['FirstName'].' '.$fetch_d['LastName'];
                
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
                $select_d= mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID = '$did'");
                $fetch_d= mysqli_fetch_assoc($select_d);
                
                $message['name'] = $fetch_d['FirstName'].' '.$fetch_d['LastName'];
                
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
        $select_u= mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID = '$user_id'");
        $fetch_u= mysqli_fetch_assoc($select_u);
        $u_name = $fetch_u['FirstName'].' '.$fetch_u['LastName'];
        
         
        $select_d= mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID = '$send_id'");
        $fetch_d= mysqli_fetch_assoc($select_d);
        $d_name = $fetch_d['FirstName'].' '.$fetch_d['LastName'];
       
        
        $sql = mysqli_query($con,"INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,date,time)  VALUES ('$user_id','$send_id', '$message1','$date','$time')") ;
        if($sql)
        {
            require_once __DIR__ . '/firebase.php';
            require_once __DIR__ . '/push.php';
            
            $firebase = new Firebase();
            $push = new Push();
            
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
            
            $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
        $select_u= mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID = '$user_id'");
        $fetch_u= mysqli_fetch_assoc($select_u);
        $u_name = $fetch_u['FirstName'].' '.$fetch_u['LastName'];
       
         
        $select_d= mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID = '$send_id'");
        $fetch_d= mysqli_fetch_assoc($select_d);
        $d_name = $fetch_d['FirstName'].' '.$fetch_d['LastName'];
      
        $sql = mysqli_query($con,"INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,date,time)  VALUES ('$send_id','$user_id','$message1','$date','$time')") ;
        if($sql)
        {
               /// Driver Notification
    
                                include ('config.php');
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase();
                                $push = new Push();
                                
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
                                
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID='$send_id'");
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
           
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $time = date('h:i A');
                                           
        $sql=mysqli_query($con,"INSERT INTO `tbl_rating`(company_id,`user_id`, `driver_id`, `booking_id`, `u_feedback_to_driver`,`driver_rated`, `date`, `time`)
                                     VALUES ('','$user_id','$driver_id','$booking_id','$feedback','$rating','$date','$time')");
        // die(mysqli_error($con));
        if($sql)
        {
            $update= mysqli_query($con,"UPDATE `Trips` SET driver_status='Complete' WHERE TripID  ='$booking_id' AND driver_id='$driver_id'");
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
 
    /*--------delete_user-------*/
    function delete_user()
    {
        include "config.php";
        $user_id=$_REQUEST['user_id'];
    
        $delete = mysqli_query($con,"DELETE FROM `Senders` WHERE SenderID='$user_id'");
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
         $RequestTime = $ride_date." ".$ride_time;
         $TimeStampCreated = $date." ".$time;
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
         
         $yu=mysqli_query($con,"select * from Senders where SenderID ='$uid'");
         $yu1=mysqli_fetch_assoc($yu);
         $name= $yu1['FirstName']." ".$yu1['LastName'];
         $email= $yu1['Email'];
         $ccode=$yu1['country_code'];
         $contact= $yu1['Phone'];
         
         if(strtotime($current) <= strtotime($ride_date." ".$ride_time))
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
                    $stripe = new \Stripe\StripeClient($test_key);
                    $paymentIntentId = $payment_id;
                    // Confirm the PaymentIntent
                    $paymentIntent = $stripe->paymentIntents->confirm(
                        $paymentIntentId,
                        [
                            'payment_method' => $payment_method_id
                        ]
                     );
                    
                    $sel=mysqli_query($con,"INSERT INTO `Trips`(`DriverID`, `SenderID`, `u_name`, `FromAddress`, `FromAddress2`, `FromCity`, `FromState`, `FromZip`, `source_lat`, `source_long`, `ToAddress`, `ToAddress2`, `ToCity`, `ToState`, `ToZip`, `destination_lat`, `destination_long`, `RequestTime`, `AcceptTime`, `PickupTime`, `DropoffTime`, `Status`, `PayStatus`, `TimeStampCreated`, `LastUpdated`, `Notes`, `InternalNotes`, `Silent`, `RouteID`, `PkgID`, `package_name`, `Cost`, `Price`, `discount`, `coupon_id`, `payment_mode`, `Paid`, `payment_id`, `CaptureID`, `ride_type`, `city_status`, `confirmation_code`, `cancel_by`, `cancel_reason`, `pickup_contact`, `drop_contact`, `driver_lat`, `driver_lng`, `d_address`, `user_lat`, `user_lng`, `u_address`, `total_duration`) 
                                                         VALUES ('','$uid','$name','$source','','$source_city','','$source_zipcode','$source_lat','$source_long','$destination','','$destination_city','','$destination_zipcode','$destination_lat','$destination_lng','$RequestTime','','','','R','','$TimeStampCreated','','$notes','','','$route_id','$package_id','$package_name','$amount','$total_amount','$discount_amount','$coupen_id','$pay_mode','','$payment_id','$payment_method_id','$ride_type','$city_status','','','','$pickup_contact','$drop_contact','','','','','','','')");
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
                                 $grand_total = $amount;
                                 $discount = $discount_amount;
                                 $total_price=$total_amount;
                                 
                                 $sql2=mysqli_query($con,"INSERT INTO `panding_booking_request_driver`(`trip_id`, `user_id`, `driver_id`, `total_price`, `ride_type`, `source_city`, `destination_city`, `city_status`, `status`, `date`, `time`, `admin_commission`, `trip_fare`, `total_fare`, `discount`, `coupen_id`,notes)
                                             VALUES ('$insert_id','$uid','$em','$total_price','$ride_type','$source_city','$destination_city','$city_status','New Booking','$date','$time','','','$grand_total','$discount','$coupen_id','$notes')");
                                             
                                 require_once __DIR__ . '/firebase.php';
                                 require_once __DIR__ . '/push.php';
                                 
                                 $firebase = new Firebase();
                                 $push = new Push();
                                 
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
                                 
                                 
                                 $sql_userId1=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID='$em'");
                                 $number_of_rows1=mysqli_num_rows($sql_userId1);
                                 
                                 if($number_of_rows1==0)
                                 {
                                     $msg["result"]="unsuccessful";
                                 }
                                 else
                                 {
                                     date_default_timezone_set('Asia/Kolkata');
                                     $date = date('Y-m-d');
                                     $time = date('h:i A');
        
                                     $row1=mysqli_fetch_assoc($sql_userId1);
                                     $ds1=$row1['device_status'];
                                     // if($ds1=='IOS' || $ds1=='Android')
                                     // {
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
                                         if($ds1=='IOS')
                                         {
                                             $token = $deviceToken;
                                         }
                                         elseif($ds1=='Android')
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
                                     // }
                                     
                                 }                  
                             }
                         } 
                                 
                         require_once __DIR__ . '/firebase.php';
                         require_once __DIR__ . '/push.php';
                         
                         $firebase = new Firebase();
                         $push = new Push();
                         
                         // optional payload
                         $payload = array();
                         $payload['team'] = 'India';
                         $payload['score'] = '7.6';
                         
                         // notification title
                           $title= "New booking";
                         // notification message
                          $message = "Your Booking #$insert_id successfully placed";
                         
                       // $include_image = "";
                         $push->setTitle($title);
                         $push->setMessage($message);
                         
                         $push->setIsBackground(FALSE);
                         $push->setPayload($payload);
                         
                         $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID ='$uid'");
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
                                 
                                 $deviceToken1=$row['iosdevice_id'];
                                 $json = '';
                                 $response = '';
                                 $json = $push->getPush();
                                 $iosresponse = $firebase->send($deviceToken1, $json);
                                     //IOS notification code
                                 $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                                 
                                 //The device token.
                                 if($ds=='IOS')
                                 {
                                     $token = $deviceToken1;
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
         elseif(strtotime($current)  > strtotime($ride_date." ".$ride_time))
         {
             $msg1["result"] = "Please select future time.";  
         }
         
         echo json_encode($msg1,JSON_UNESCAPED_SLASHES); 
         die;
     }
    /*------------user_booking---------*/

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
            
            $select = mysqli_query($con,"SELECT * FROM Trips WHERE TripID ='$booking_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['FromAddress'];
            $message["destination_add"]=$ss['ToAddress'];
            $message["total_price"]=$sel['total_price'];
            $message["ride_type"]=$sel['ride_type'];
            $message["notes"]=$ss['Notes'];
            $message["pickup_contact"]=$ss['pickup_contact'];
            $message["drop_contact"]=$ss['drop_contact'];
            
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("Y-m-d", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
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
            
            $select = mysqli_query($con,"SELECT * FROM Trips WHERE TripID ='$booking_id'");
            $ss = mysqli_fetch_assoc($select);
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['FromAddress'];
            $message["destination_add"]=$ss['ToAddress'];
            $message["total_price"]=$sel['total_price'];
            $message["ride_type"]=$sel['ride_type'];
            $message["notes"]=$ss['Notes'];
            $message["pickup_contact"]=$ss['pickup_contact'];
            $message["drop_contact"]=$ss['drop_contact'];
            
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("Y-m-d", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            $message["ride_date"]=$ss['ride_date'];
            $message["ride_time"]=$ss['ride_time'];
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
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `SenderID`='$user_id' AND ride_type ='Ride_now' AND (Status!='N' AND Status!='B' AND Status!='C') AND (city_status='In City' OR city_status='Out City') ORDER BY TripID DESC");
        //die(mysqli_error($con));
        while($ss=mysqli_fetch_assoc($upd))
        {
            $message["booking_id"]=$ss['TripID'];
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['FromAddress'];
            $message["destination_add"]=$ss['ToAddress'];
            
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("m-d-Y", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            
            $message["package_name"]=$ss['package_name'];
            $status=$ss['Status'];
            
            $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
            $fetch_status = mysqli_fetch_assoc($select_status);
            $message["status"]= $fetch_status['trip_status_name'];
         
            $message["grand_total"]=$ss['Price']; // total fare
            $message["trip_total"]=$ss['Cost']; //trip fare
            $message["discount"]=$ss['discount'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
      
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
        
        $array= array();
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `SenderID`='$user_id' AND ride_type ='Ride_later' AND (Status='R') AND (city_status='In City' OR city_status='Out City')");
        while($ss=mysqli_fetch_assoc($upd))
        {
            $message["booking_id"]=$ss['TripID'];
            $message["user_name"]=$ss['u_name'];
            $message["source_add"]=$ss['FromAddress'];
            $message["destination_add"]=$ss['ToAddress'];
            
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("m-d-Y", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            
            $message["package_name"]=$ss['package_name'];
            $status=$ss['Status'];
            
            $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
            $fetch_status = mysqli_fetch_assoc($select_status);
            $message["status"]= $fetch_status['trip_status_name'];
         
            $message["grand_total"]=$ss['Price']; // total fare
            $message["trip_total"]=$ss['Cost']; //trip fare
            $message["discount"]=$ss['discount'];
            array_push($array,$message);
        }
        array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
    }    
    /*---------fetch_user_ride_later_list-------*/
    
    /*------driver_intrested_booking_status----*/
    function driver_intrested_booking_status()
    {
        include "config.php";
        $driver_id = $_REQUEST['driver_id'];
        $booking_id = $_REQUEST['booking_id'];
        
        $select = mysqli_query($con,"SELECT * FROM Trips WHERE TripID='$booking_id'");
        $ss = mysqli_fetch_assoc($select);
        $user_id = $ss['SenderID'];
        $ride_type = $ss['ride_type'];
        
        if($ride_type=='Ride_now')
        {
            $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
        }
        elseif($ride_type=='Ride_later')
        {
            $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='accept' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
        }
        if($del)
        {
            /// user Notification
              
            require_once __DIR__ . '/firebase.php';
            require_once __DIR__ . '/push.php';
            
            $firebase = new Firebase();
            $push = new Push();
            
            // optional payload
            $payload = array();
            $payload['team'] = 'India';
            $payload['score'] = '7.6';
            
            // notification title
            $title1= "Booking Accepted";
            // notification message
            $message1="You Booking #$booking_id has been accepted by driver";
            
           // $include_image = "";
            $push->setTitle($title1);
            $push->setMessage($message1);
            
            $push->setIsBackground(FALSE);
            $push->setPayload($payload);
            
            $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
                // if($ds=='IOS' || $ds=='Android')
                // {
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
                   // $type=$type;
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
                   // curl_close($ch);
                // }
            }
  
          $del1=mysqli_query($con,"UPDATE `Trips` SET DriverID ='$driver_id', Status='A' WHERE TripID ='$booking_id'");
      
          $del2=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE trip_id ='$booking_id' AND status!='accept'");
          $upd=mysqli_query($con,"SELECT * FROM `canclebooking_driver_new` WHERE `driver_id`='$driver_id' AND booking_id='$booking_id'");
          $booking_count =  mysqli_num_rows($upd);
          if($booking_count>0)
          {
             $del3=mysqli_query($con,"DELETE FROM `canclebooking_driver_new` WHERE driver_id='$driver_id' AND booking_id ='$booking_id'");
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
        
        $upd1=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $ride_type = $sel1['ride_type'];
       
        $del=mysqli_query($con,"UPDATE `panding_booking_request_driver` SET status='cancel' WHERE driver_id='$driver_id' AND trip_id ='$booking_id'");
       //die(mysqli_error($con));
        if($del)
        {
          $ins=mysqli_query($con,"INSERT INTO `canclebooking_driver_new`(`driver_id`, `status`, `type`, `booking_id`, `cancel_time`, `cancel_date`)
                                                                  VALUES('$driver_id','cancle','$ride_type','$booking_id','$time','$date')");
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
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id'");
        $sel=mysqli_fetch_assoc($upd);
        $driver_id = $sel['DriverID'];
        $pay_type = $sel['payment_mode'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `Senders` WHERE `SenderID`='$user_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $wallet = $sel1['user_wallet'];
        $new_total =$sel['Price'];
        $new_am = $wallet+$new_total;
       
        $del=mysqli_query($con,"UPDATE `Trips` SET Status='N',cancel_by='User',cancel_reason='$cancel_reason' WHERE TripID ='$booking_id' AND SenderID ='$user_id'");
       //die(mysqli_error($con));
        if($del)
        {
                                /// Driver Notification
    
                                include ('config.php');
                                require_once __DIR__ . '/firebase.php';
                                require_once __DIR__ . '/push.php';
                                
                                $firebase = new Firebase();
                                $push = new Push();
                                
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
                                
                                
                                $sql_userId=mysqli_query($con,"SELECT * FROM `Drivers` WHERE DriverID='$driver_id'");
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
                                        VALUES ('$user_id','','$driver_id','cancle','$cancel_reason','$booking_id','$time','$date')");
                                         
                                        if($pay_type == 'Wallet')
                                        {
                                           $del3=mysqli_query($con,"UPDATE `Senders` SET user_wallet='$new_am' WHERE SenderID ='$user_id'");
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
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id'");
        $sel=mysqli_fetch_assoc($upd);
        $user_id = $sel['SenderID'];
        $new_total = $sel['Price'];
        $pay_type = $sel['payment_mode'];
        
        $upd1=mysqli_query($con,"SELECT * FROM `Senders` WHERE `SenderID`='$user_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $wallet = $sel1['user_wallet'];
        $new_am = $wallet+$new_total;
    
        $del=mysqli_query($con,"UPDATE `Trips` SET Status='B',cancel_by='Driver',cancel_reason='$cancel_reason' WHERE TripID ='$booking_id' AND DriverID='$driver_id'");
      //die(mysqli_error($con));
        if($del)
        {
                  /// user Notification
                
                    require_once __DIR__ . '/firebase.php';
                    require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase();
                    $push = new Push();
                    
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
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
                                        VALUES ('$user_id','','$driver_id','cancle','$cancel_reason','$booking_id','$time','$date')");
                                        
                            if($pay_type == 'Wallet')
                            {
                                $del3=mysqli_query($con,"UPDATE `Senders` SET user_wallet='$new_am' WHERE SenderID ='$user_id'");
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

    /*----driver_completed_booking_data-----*/
     function driver_completed_booking_data()
     {
        include "config.php";
        $driver_id =  $_REQUEST['driver_id']; 
        $select = mysqli_query($con,"select * from Trips WHERE DriverID ='$driver_id' AND (Status='D' OR Status='C')");
        $rating=mysqli_query($con,"select count(TripID ) as book_id, SUM(Price) as earning from Trips WHERE DriverID ='$driver_id' AND (Status='D' OR Status='C')");
        $count = mysqli_num_rows($select);
        $row_r=mysqli_fetch_assoc($rating);
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
            $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `DriverID`='$driver_id' AND  (Status='B' OR Status='D' OR Status='C' OR Status='N')");
            $count = mysqli_num_rows($upd);
            if($count>0)
            {
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"] = $ss['TripID'];
                    $message["source_add"] = $ss['FromAddress'];
                    $message["destination_add"] = $ss['ToAddress'];
                    $message["package_name"]=$ss['package_name'];
                    $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
                    $RequestTime = $ss['RequestTime'];
                    $ride_date = date("d-m-Y", strtotime($RequestTime));
                    $ride_time = date("h:i A", strtotime($RequestTime));
                    $message["ride_date"] = $ride_date;
                    $message["ride_time"] = $ride_time;
                    
                    $DropoffTime = $ss['DropoffTime'];
                    $ride_end_date = date("d-m-Y", strtotime($DropoffTime));
                    $ride_end_time = date("h:i A", strtotime($DropoffTime));
                    $message["ride_end_date"] = $ride_end_date;
                    $message["ride_end_time"] = $ride_end_time;
            
                    $status=$ss['Status'];
                    if($status=='D' || $status=='C')
                    {
                        $message["total_price"]=strval($ss['Price']);
                    }
                    elseif($status=='N' || $status=='B')
                    {
                        $message["total_price"]=0;
                    }
                    
                    $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
                    $fetch_status = mysqli_fetch_assoc($select_status);
                    $message["status"]= $fetch_status['trip_status_name'];
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
            $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `DriverID`='$driver_id' AND  (Status='B' OR Status='D' OR Status='C' OR Status='N') AND STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y')");
            $count = mysqli_num_rows($upd);
            if($count>0)
            {
                while($ss=mysqli_fetch_assoc($upd))
                {
                    $message["booking_id"] = $ss['TripID'];
                    $message["source_add"] = $ss['FromAddress'];
                    $message["destination_add"] = $ss['ToAddress'];
                    $message["package_name"]=$ss['package_name'];
                    $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
                    $RequestTime = $ss['RequestTime'];
                    $ride_date = date("d-m-Y", strtotime($RequestTime));
                    $ride_time = date("h:i A", strtotime($RequestTime));
                    $message["ride_date"] = $ride_date;
                    $message["ride_time"] = $ride_time;
                    
                    $DropoffTime = $ss['DropoffTime'];
                    $ride_end_date = date("d-m-Y", strtotime($DropoffTime));
                    $ride_end_time = date("h:i A", strtotime($DropoffTime));
                    $message["ride_end_date"] = $ride_end_date;
                    $message["ride_end_time"] = $ride_end_time;
            
                    $status=$ss['Status'];
                    if($status=='D' || $status=='C')
                    {
                        $message["total_price"]=strval($ss['Price']);
                    }
                    elseif($status=='N' || $status=='B')
                    {
                        $message["total_price"]=0;
                    }
                    
                    $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
                    $fetch_status = mysqli_fetch_assoc($select_status);
                    $message["status"]= $fetch_status['trip_status_name'];
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
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `driver_id`='$driver_id' AND TripID='$booking_id'");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            $message["booking_id"]=$ss['TripID'];
            $message["user_id"]=$ss['SenderID '];
            $user_id = $ss['SenderID '];
            $upd=mysqli_query($con,"SELECT * FROM `Senders` WHERE `SenderID`='$user_id'");
            $sel=mysqli_fetch_assoc($upd);
            $message["package_name"]=$ss['package_name'];
            $message["source_add"]=$ss['FromAddress'];
            $message["source_lat"]=$ss['source_lat'];
            $message["source_long"]=$ss['source_long'];
            $message["destination_add"]=$ss['ToAddress'];
            $message["destination_lat"]=$ss['destination_lat'];
            $message["destination_long"]=$ss['destination_long'];
            $message["payment_mode"]=$ss['payment_mode'];
            $message["user_name"] = $sel['FirstName'] . " " . $sel['LastName']; 
            $message["contact"] = $sel['country_code'] . $sel['Phone'];
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            else
            {
             $message["Image"]=$path.$sel['image'];
            }
            $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("d-m-Y", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            
            $DropoffTime = $ss['DropoffTime'];
            $ride_end_date = date("d-m-Y", strtotime($DropoffTime));
            $ride_end_time = date("h:i A", strtotime($DropoffTime));
            $message["ride_end_date"] = $ride_end_date;
            $message["ride_end_time"] = $ride_end_time;
    
            $status=$ss['Status'];
            if($status=='D' || $status=='C')
            {
                $message["total_price"]=strval($ss['Price']);
            }
            elseif($status=='N' || $status=='B')
            {
                $message["total_price"]=0;
            }
            
            $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
            $fetch_status = mysqli_fetch_assoc($select_status);
            $message["status"]= $fetch_status['trip_status_name'];
            array_push($array,$message);
        }
        else
        {
           $message["booking_id"]='';
            $message["user_id"]='';
            
            $message["package_name"]='';
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
            $message["distance"]='';
            $message["ride_date"]='';
            $message["ride_time"]='';
            $message["duration"]='';
            $message["user_name"]='';
            if($sel['image']=='')
            {
               $message["Image"]='';  
            }
            $message["status"]=''; 
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
            $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `SenderID`='$user_id' AND  (Status='B' OR Status='D' OR Status='C' OR Status='N') ORDER BY TripID DESC");
            while($ss=mysqli_fetch_assoc($upd))
            {
                $booking_id = $ss['TripID'];
                $message["booking_id"]=$ss['TripID'];
                $message["user_name"]=$ss['u_name'];
                $message["source_add"] = $ss['FromAddress'];
                $message["destination_add"] = $ss['ToAddress'];
                $message["package_name"]=$ss['package_name'];
                $message["payment_mode"]=$ss['payment_mode'];
                $message["grand_total"]=$ss['Price'];
                $message["trip_total"]=$ss['Cost'];
                $message["discount"]=$ss['discount'];
                    
                $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
                $RequestTime = $ss['RequestTime'];
                $ride_date = date("m-d-Y", strtotime($RequestTime));
                $ride_time = date("h:i A", strtotime($RequestTime));
                $message["ride_date"] = $ride_date;
                $message["ride_time"] = $ride_time;
                
                $DropoffTime = $ss['DropoffTime'];
                $ride_end_date = date("m-d-Y", strtotime($DropoffTime));
                $ride_end_time = date("h:i A", strtotime($DropoffTime));
                $message["ride_end_date"] = $ride_end_date;
                $message["ride_end_time"] = $ride_end_time;
        
                $status=$ss['Status'];
                $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
                $fetch_status = mysqli_fetch_assoc($select_status);
                $message["status"]= $fetch_status['trip_status_name'];
                
                $driver_id= $ss['DriverID'];
                $message["driver_id"] =$ss['DriverID'];
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
            $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `SenderID`='$user_id' AND  (Status='B' OR Status='D' OR Status='C' OR Status='N') AND STR_TO_DATE(ride_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%d-%m-%Y') AND STR_TO_DATE('$end_date', '%d-%m-%Y') ORDER BY TripID DESC");
            while($ss=mysqli_fetch_assoc($upd))
            {
                $booking_id = $ss['TripID'];
                $message["booking_id"]=$ss['TripID'];
                $message["user_name"]=$ss['u_name'];
                $message["source_add"] = $ss['FromAddress'];
                $message["destination_add"] = $ss['ToAddress'];
                $message["package_name"]=$ss['package_name'];
                $message["payment_mode"]=$ss['payment_mode'];
                $message["grand_total"]=$ss['Price'];
                $message["trip_total"]=$ss['Cost'];
                $message["discount"]=$ss['discount'];
                    
                $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
                $RequestTime = $ss['RequestTime'];
                $ride_date = date("m-d-Y", strtotime($RequestTime));
                $ride_time = date("h:i A", strtotime($RequestTime));
                $message["ride_date"] = $ride_date;
                $message["ride_time"] = $ride_time;
                
                $DropoffTime = $ss['DropoffTime'];
                $ride_end_date = date("m-d-Y", strtotime($DropoffTime));
                $ride_end_time = date("h:i A", strtotime($DropoffTime));
                $message["ride_end_date"] = $ride_end_date;
                $message["ride_end_time"] = $ride_end_time;
        
                $status=$ss['Status'];
                $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
                $fetch_status = mysqli_fetch_assoc($select_status);
                $message["status"]= $fetch_status['trip_status_name'];
                
                $driver_id= $ss['DriverID'];
                $message["driver_id"] =$ss['DriverID'];
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
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE TripID ='$booking_id' AND DriverID ='$driver_id'");
        $sel=mysqli_fetch_assoc($upd);
        $RequestTime = $sel['RequestTime'];
        $ride_date = date("d-m-Y", strtotime($RequestTime));
        $ride_time = date("h:i A", strtotime($RequestTime));
                
        $new_time= date($format, strtotime('-30 minutes', strtotime($ride_time)));
        $ride_type = $sel['ride_type'];
        if(strtotime($current) < strtotime($ride_date." ".$new_time))
        {
            $result['result']='unsuccess';  
        }
        elseif(strtotime($current) >= strtotime($ride_date." ".$new_time))
        {
            $del=mysqli_query($con,"UPDATE `Trips` SET Status='A' WHERE TripID ='$booking_id' AND DriverID='$driver_id'");
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
       
        $sql=mysqli_query($con,"SELECT * FROM Trips WHERE TripID='booking_id'");
        $row=mysqli_fetch_assoc($sql);
        $user_id= $row['SenderID'];
        
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
       
        $sql=mysqli_query($con,"SELECT * FROM Trips WHERE TripID='booking_id'");
        $row=mysqli_fetch_assoc($sql);
        $driver_id= $row['DriverID'];
        
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
        
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id' AND (Status!='N' AND Status!='B' AND Status!='C')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
           $upd=mysqli_query($con,"UPDATE `Trips` SET `user_lat`='$lat',`user_lng`='$long',u_address='$destination_city' WHERE `TripID`='$booking_id'");
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
        
        $upd=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id' AND  (Status!='N' AND Status!='B' AND Status!='C')");
        $ss=mysqli_fetch_assoc($upd);
        $count= mysqli_num_rows($upd);
        if($count>0)
        {
            
           $upd=mysqli_query($con,"UPDATE `Trips` SET `driver_lat`='$lat',`driver_lng`='$long',d_address='$destination_city' WHERE `TripID`='$booking_id'");
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

    /*----driver_fetch_all_ride_now_booking----*/
    function driver_fetch_all_ride_now_booking()
    {
        include "config.php";
        $driver_id = $_REQUEST['driver_id'];
    
        date_default_timezone_set('Asia/Kolkata');
        $path = "https://cisswork.com/Android/SenderApp/images/";
        
        $ride_query = mysqli_query($con, "SELECT * FROM `Trips` WHERE `DriverID` = '$driver_id' AND ride_type = 'Ride_now' AND (Status IN ('A', 'M', 'P', 'D'))");
    
        $array = array();
        while ($ss = mysqli_fetch_assoc($ride_query)) 
        {
            $message = array();
            $booking_id = $ss['TripID'];
            
            $user_query = mysqli_query($con, "SELECT * FROM `Senders` WHERE `SenderID` = '{$ss['SenderID']}'");
            $sel = mysqli_fetch_assoc($user_query);
    
            // Fill message with data from the notification and user tables
            $message["booking_id"] = $ss['TripID'];
            $message["user_id"] = $ss['SenderID'];
            $message["source_add"] = $ss['FromAddress'];
            $message["source_lat"] = $ss['source_lat'];
            $message["source_long"] = $ss['source_long'];
            $message["destination_add"] = $ss['ToAddress'];
            $message["destination_lat"] = $ss['destination_lat'];
            $message["destination_long"] = $ss['destination_long'];
            $message["total_price"] = $ss['Price'] ?: 0;
            $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
            $message["payment_mode"] = $ss['payment_mode'];
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("m-d-Y", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            $message["user_name"] = $sel['FirstName'] . " " . $sel['LastName']; 
            $message["contact"] = $sel['country_code'] . $sel['Phone'];
            $message["Image"] = $sel['image'] ? $path . $sel['image'] : '';
    
            // Get driver rating
            $rating_query = mysqli_query($con, "SELECT count(rate_id) as count, AVG(`driver_rated`) AS rating FROM tbl_rating WHERE driver_id = '$driver_id'");
            $rating_result = mysqli_fetch_assoc($rating_query);
            $message["rating"] = round($rating_result['rating'] ?: 0, 1);
    
            $status=$ss['Status'];
            $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
            $fetch_status = mysqli_fetch_assoc($select_status);
            $message["status"]= $fetch_status['trip_status_name'];
            $message["confirmation_code"] = $ss['confirmation_code'];
            $message["note"] = $ss['Notes'];
            $message["pickup_contact"] = $ss['pickup_contact'];
            $message["dropoff_contact"] = $ss['drop_contact'];
            $message["Location_url"] = "https://cisswork.com/Android/SenderApp/Current_Location_driver.php?id=" . $booking_id;
    
            $array[] = $message;
        }
        array_walk_recursive($array, function(&$item) {
            $item = strval($item);
        });
    
        echo json_encode($array, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_fetch_all_ride_now_booking-----*/

    /*----driver_fetch_all_ride_later_booking----*/
    function driver_fetch_all_ride_later_booking() 
    {
        include "config.php";
        $driver_id = $_REQUEST['driver_id'];
    
        date_default_timezone_set('Asia/Kolkata');
        $path = "https://cisswork.com/Android/SenderApp/images/";
        
        // $ride_query = mysqli_query($con, "SELECT * FROM `Trips` WHERE `driver_id` = '$driver_id' AND ride_type = 'Ride_later' AND (driver_status IN ('confirm', 'accept', 'arrived', 'start_ride', 'onthe_way'))");
       $ride_query = mysqli_query($con, "SELECT * FROM `Trips` WHERE `driver_id` = '$driver_id' AND ride_type = 'Ride_later' AND (Status IN ('A', 'M', 'P', 'D'))");
    
        $array = array();
        while($ss = mysqli_fetch_assoc($ride_query))
        {
            $message = array();
             $booking_id = $ss['TripID'];
            
            $user_query = mysqli_query($con, "SELECT * FROM `Senders` WHERE `SenderID` = '{$ss['SenderID']}'");
            $sel = mysqli_fetch_assoc($user_query);
    
            // Fill message with data from the notification and user tables
            $message["booking_id"] = $ss['TripID'];
            $message["user_id"] = $ss['SenderID'];
            $message["source_add"] = $ss['FromAddress'];
            $message["source_lat"] = $ss['source_lat'];
            $message["source_long"] = $ss['source_long'];
            $message["destination_add"] = $ss['ToAddress'];
            $message["destination_lat"] = $ss['destination_lat'];
            $message["destination_long"] = $ss['destination_long'];
            $message["total_price"] = $ss['Price'] ?: 0;
            $message["ride_type"] = ($ss['ride_type'] == 'Ride_later') ? 'Ride Later' : 'Ride Now';
            $message["payment_mode"] = $ss['payment_mode'];
            $RequestTime = $ss['RequestTime'];
            $ride_date = date("m-d-Y", strtotime($RequestTime));
            $ride_time = date("h:i A", strtotime($RequestTime));
            $message["ride_date"] = $ride_date;
            $message["ride_time"] = $ride_time;
            $message["user_name"] = $sel['FirstName'] . " " . $sel['LastName']; 
            $message["contact"] = $sel['country_code'] . $sel['Phone'];
            $message["Image"] = $sel['image'] ? $path . $sel['image'] : '';
    
            // Get driver rating
            $rating_query = mysqli_query($con, "SELECT count(rate_id) as count, AVG(`driver_rated`) AS rating FROM tbl_rating WHERE driver_id = '$driver_id'");
            $rating_result = mysqli_fetch_assoc($rating_query);
            $message["rating"] = round($rating_result['rating'] ?: 0, 1);
    
            $status=$ss['Status'];
            $select_status = mysqli_query($con,"SELECT * FROM `sys_trip_status` WHERE `trip_status_id`='$status'");
            $fetch_status = mysqli_fetch_assoc($select_status);
            $message["status"]= $fetch_status['trip_status_name'];
            $message["confirmation_code"] = $ss['confirmation_code'];
            $message["note"] = $ss['Notes'];
            $message["pickup_contact"] = $ss['pickup_contact'];
            $message["dropoff_contact"] = $ss['drop_contact'];
            $message["Location_url"] = "https://cisswork.com/Android/SenderApp/Current_Location_driver.php?id=" . $booking_id;
    
            $array[] = $message;
        }
        array_walk_recursive($array, function(&$item) {
            $item = strval($item);
        });
    
        echo json_encode($array, JSON_UNESCAPED_SLASHES);
        die;
    }
    /*----driver_fetch_all_ride_later_booking-----*/
    
    /*----driver_fetch_cancelled_booking_list-----*/
    function driver_fetch_cancelled_booking_list()
    {
        include('config.php');
        $driver_id = $_REQUEST['driver_id'];
        $upd=mysqli_query($con,"SELECT * FROM `canclebooking_driver_new` WHERE `driver_id`='$driver_id'");
        $array= array();
       //mysqli_error($con);
       $count = mysqli_num_rows($upd);
       if($count >0)
       {
        while($sel=mysqli_fetch_assoc($upd))
        {
            $booking_id = $sel['booking_id'];
            $select = mysqli_query($con,"SELECT * FROM Trips WHERE TripID ='$booking_id'");
            $ss = mysqli_fetch_assoc($select);
            $status = $ss['Status'];
            if($status=='R')
            {
                $message["booking_id"]=$sel['booking_id'];
                $message["user_name"]=$ss['u_name'];
                $message["source_add"]=$ss['FromAddress'];
                $message["destination_add"]=$ss['ToAddress'];
                $message["total_price"]=$ss['Price'];
                $message["ride_type"]=$ss['ride_type'];
                $RequestTime = $ss['RequestTime'];
                $ride_date = date("m-d-Y", strtotime($RequestTime));
                $ride_time = date("h:i A", strtotime($RequestTime));
                $message["ride_date"] = $ride_date;
                $message["ride_time"] = $ride_time;
            }
            array_push($array,$message);
        }
        //array_walk_recursive($array,function(&$item){$item=strval($item);});
        echo json_encode($array, JSON_UNESCAPED_SLASHES); 
        die; 
       }
       else
       {   $msg =[];
           echo json_encode($msg, JSON_UNESCAPED_SLASHES); 
           die;
       }
    }
    /*----driver_fetch_cancelled_booking_list-----*/
    
    /*------driver_update_booking_status----*/
    function driver_update_booking_status()
    {
        include "config.php"; 
        require_once 'stripe-payment/vendor/autoload.php'; // Include Stripe PHP library
    
        $driver_id = $_REQUEST['driver_id'];
        $status = $_REQUEST['status'];
        $booking_id = $_REQUEST['booking_id'];
        $end_date = $_REQUEST['end_date'];
        $end_time = $_REQUEST['end_time'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $date1 = date('m-d-Y');
        $time = date('h:i A');
        $CurrentTime =  date('m-d-Y  h:i A');
        $v_code = mt_rand(100000, 999999);
        
        $upd1=mysqli_query($con,"SELECT * FROM `Trips` WHERE `TripID`='$booking_id'");
        $sel1=mysqli_fetch_assoc($upd1);
        $user_id = $sel1['SenderID'];
        
        $select_com= mysqli_query($con,"SELECT * FROM  `Trips` WHERE TripID='$booking_id'"); 
        $row_com=mysqli_fetch_assoc($select_com);
        $coupon_id = $row_com['coupon_id'];
        $payment_mode =  $row_com['payment_mode'];
        $payment_id = $row_com['payment_id'];
        $RequestTime = $row_com['RequestTime'];
    
        $datetime_2 = $end_date." ".$end_time; 
        $from_time = strtotime($RequestTime); 
        $to_time = strtotime($datetime_2); 
        $diff_minutes = round(abs($from_time - $to_time) / 60,2);
       
        $Test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
        $Live_key = '';
    
        // 'P', 'PickedUp'
        // 'D', 'DroppedOff'
        // 'C', 'Completed'
        
        
        // $status=='arrived'
        // $status=='start_ride'
        // $status=='onthe_way'
        // $status=='end_ride'
        
        if($status=='PickedUp')
        {
            $del=mysqli_query($con,"UPDATE `Trips` SET Status='P',confirmation_code='$v_code',`AcceptTime`='$CurrentTime'  WHERE TripID ='$booking_id' AND DriverID ='$driver_id'");
           //die(mysqli_error($con));
            if($del)
            {
                  
                   /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase();
                    $push = new Push();
                    
                    // optional payload
                    $payload = array();
                    $payload['team'] = 'India';
                    $payload['score'] = '7.6';
                    
                     
                    // notification title
                     $title= "Driver Picked";
                    // notification message
                    $message="Driver Picked succesfully for Booking #$booking_id";
                    
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
              $result['result']='Picked successfully';
            }
            else
            {
              $result['result']='unsuccess';  
            }
        }
        elseif($status=='DroppedOff')
        {
            $del=mysqli_query($con,"UPDATE `Trips` SET Status='D',`PickupTime`='$CurrentTime' WHERE TripID ='$booking_id' AND DriverID ='$driver_id'");
          //  die(mysqli_error($con));
            if($del)
            {
                /// user Notification
    
                   require_once __DIR__ . '/firebase.php';
                   require_once __DIR__ . '/push.php';
                    
                    $firebase = new Firebase();
                    $push = new Push();
                    
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
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
              $result['result']='unsuccess11';  
            }
        }
        elseif($status=='Completed')
        {
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
     
            $query = "UPDATE `Trips` SET `total_duration`='$diff_minutes', Status='C',`DropoffTime`='$CurrentTime' WHERE TripID ='$booking_id' AND DriverID ='$driver_id'";
            $update= mysqli_multi_query($con, $query);
            if($update)
            {
               /// Driver Notification
               
                require_once __DIR__ . '/firebase.php';
                require_once __DIR__ . '/push.php';
                
                $firebase = new Firebase();
                $push = new Push();
                
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
    
                     // notification title
                    $title= "Regarding Booking";
                    // notification message
                    $message="Your ride #$booking_id has completed";
                    
                  //  $include_image = "";
                    $push->setTitle($title);
                    $push->setMessage($message);
                    
                    $push->setIsBackground(FALSE);
                    $push->setPayload($payload);
                    
                    $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$user_id'");
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
    
}
?>