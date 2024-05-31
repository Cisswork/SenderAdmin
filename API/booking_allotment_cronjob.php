<?php 
    include('config.php');
    date_default_timezone_set('America/Jamaica');
    $date = date('d-m-Y');
    $time = date('h:i A');
    $arrr = array();
    $record=mysqli_query($con,"SELECT * FROM Trips WHERE Status = 'R'");
   // die(mysqli_error($con));
  //  echo mysqli_num_rows($record1);
    while($row_data=mysqli_fetch_assoc($record))
    {
  echo  $booking_id= $row_data['TripID'];
  
        $record1=mysqli_query($con,"SELECT * FROM panding_booking_request_driver WHERE trip_id='$booking_id'");
        while($row_ss = mysqli_fetch_assoc($record1))
        {
            $driver_id= $row_ss['driver_id'];
            array_push($arrr,$driver_id);
        }
        $pending_driver_list=$arrr;
        
        $status = $row_data['Status'];
        $uid = $row_data['SenderID'];
        $coupen_id=$row_data['coupon_id'];
        $city_status=$row_data['city_status'];
        $source_city=$row_data['FromCity'];
        $destination_city =$row_data['ToCity'];
        $ride_type=$row_data['ride_type'];     //Ride_now ..Ride_later
        $amount = $row_data['Cost'];  //original price
        $discount_amount = $row_data['discount']; //discounted Price
        $total_amount = $row_data['Price']; // (original price-discounted Price)
        $notes = $row_data['Notes']; 
        $route_id = $row_data['RouteID'];
        
        $fetch = mysqli_query($con, "SELECT * FROM `Drivers` WHERE Status = '1' AND FIND_IN_SET('$route_id', zipcode_list) > 0 ORDER BY DriverID  ASC");
        $rows=mysqli_num_rows($fetch);
        if($rows>0)
        {
            while($row=mysqli_fetch_assoc($fetch))
            {
    			$em=$row['DriverID'];
    			if (!in_array($em, $pending_driver_list))
    			{
                    echo "Yes"; // Driver ID is not present in the pending_driver_list
                    $trip_fare = 0;
    		        $commission= 0; 
    		        $grand_total = $amount;
    		        $discount = $discount_amount;
    		        $total_price=$total_amount;
    		        
                    $sql2=mysqli_query($con,"INSERT INTO `panding_booking_request_driver`(`trip_id`, `user_id`, `driver_id`, `total_price`, `ride_type`, `source_city`, `destination_city`, `city_status`, `status`, `date`, `time`, `admin_commission`, `trip_fare`, `total_fare`, `discount`, `coupen_id`,notes)
                                VALUES ('$booking_id','$uid','$em','$total_price','$ride_type','$source_city','$destination_city','$city_status','New Booking','$date','$time','','','$grand_total','$discount','$coupen_id','$notes')");
                                
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
                    $message="Booking #$booking_id successfully placed";
                    
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
                } else {
                    echo "No"; // Driver ID is present in the pending_driver_list
                }
            }
        } 
           
    }
?>