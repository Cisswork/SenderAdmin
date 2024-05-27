<?php 
        include ('config.php');
        // Include Stripe library
        require_once 'stripe-payment/vendor/autoload.php'; 
       
        $uid=$_REQUEST['user_id'];
        $booking_id = $_REQUEST['booking_id'];
        $payment_id = $_REQUEST['payment_id']; 
        $payment_method_id = $_REQUEST['payment_method_id']; 
        
        $sql_data=mysqli_query($con,"SELECT * FROM Trips WHERE TripID ='$booking_id'");
       // echo mysqli_num_rows($sql_data);
        $row_data=mysqli_fetch_assoc($sql_data);
      //  $card_id=$row_data['card_id'];
        $coupen_id=$row_data['coupon_id'];
        $package_id=$row_data['package_name'];
        $package_name=$package_id;
        $RequestTime1=$row_data['RequestTime'];
        
        $pay_mode=$row_data['payment_mode'];   //Card  Cash
        $source= $row_data['FromAddress'];
        $destination= $row_data['ToAddress'];
        $city_status=$row_data['city_status'];
        $source_city=$row_data['FromCity'];
        $destination_city =$row_data['ToCity'];
        $source_lat= $row_data['source_lat'];
        $source_long= $row_data['source_long'];
        $destination_lat= $row_data['destination_lat'];
        $destination_lng= $row_data['destination_long'];
        $ride_type=$row_data['ride_type'];     //Ride_now ..Ride_later
        $pickup_contact = $row_data['pickup_contact'];  //preffered_company == '1' ... open_to_all=== '0'
        $drop_contact = $row_data['drop_contact'];
        $amount = $row_data['Cost'];  //original price
        $discount_amount = $row_data['discount']; //discounted Price
        $total_amount = $row_data['Price']; // (original price-discounted Price)
        $notes = $row_data['Notes']; 
        $source_zipcode=$row_data['FromZip'];
        $destination_zipcode=$row_data['ToZip'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time = date('h:i A');
           
        $test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
        $Live_key = '';
                
        if($ride_type=='Ride_now'){$RequestTime = $date." ".$time;}
        elseif($ride_type=='Ride_later'){ $RequestTime = $RequestTime1;}
        
        
        $TimeStampCreated = $date." ".$time;
        $sql_source=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$source_zipcode'");
        $count_source=mysqli_num_rows($sql_source);
        $fetch_source=mysqli_fetch_assoc($sql_source);
        $source_area = $fetch_source['AreaName'];
        
        $sql_destination=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$destination_zipcode'");
        $count_destination=mysqli_num_rows($sql_destination);
        $fetch_destination=mysqli_fetch_assoc($sql_destination);
        $destination_area = $fetch_destination['AreaName'];
        
        // if($count_source >0 && $count_destination > 0)
        // {
            $select = mysqli_query($con,"SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area')");
            $count_area = mysqli_num_rows($select);
            $fetch_area = mysqli_fetch_assoc($select);
            $route_id = $fetch_area['RouteID'];
        // }
        
        $yu=mysqli_query($con,"select * from Senders where SenderID='$uid'");
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
                  
                   $sel1=mysqli_query($con,"INSERT INTO `Trips`(`DriverID`, `SenderID`, `u_name`, `FromAddress`, `FromAddress2`, `FromCity`, `FromState`, `FromZip`, `source_lat`, `source_long`, `ToAddress`, `ToAddress2`, `ToCity`, `ToState`, `ToZip`, `destination_lat`, `destination_long`, `RequestTime`, `AcceptTime`, `PickupTime`, `DropoffTime`, `Status`, `PayStatus`, `TimeStampCreated`, `LastUpdated`, `Notes`, `InternalNotes`, `Silent`, `RouteID`, `PkgID`, `package_name`, `Cost`, `Price`, `discount`, `coupon_id`, `payment_mode`, `Paid`, `payment_id`, `CaptureID`, `ride_type`, `city_status`, `confirmation_code`, `cancel_by`, `cancel_reason`, `pickup_contact`, `drop_contact`, `driver_lat`, `driver_lng`, `d_address`, `user_lat`, `user_lng`, `u_address`, `total_duration`) 
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
                        
                        $sql_userId=mysqli_query($con,"SELECT * FROM `Senders` WHERE SenderID='$uid'");
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
        elseif(strtotime($current)  > strtotime($ride_date." ".$ride_time))
        {
            $msg1["result"] = "Please select future time.";  
        }
        
        echo json_encode($msg1,JSON_UNESCAPED_SLASHES); 
        die;
?>