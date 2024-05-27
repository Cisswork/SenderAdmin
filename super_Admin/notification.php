<?php 
    include('config.php');
    if(!isset($_SESSION['id']))  
    {
       	echo "<script>window.location.href='index.php';</script>";
	} 
?>
<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Notification</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 <!----saerch dropdown----->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <style>
      .input-group .form-control:not(:first-child):not(:last-child), .input-group-addon:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child) {
    border-radius: 0;
    margin-right: 175px;
}

  </style>
 <style>
       .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 6px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 415px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
    overflow-y: auto;
     overflow-x: auto;
     max-height: 510px;
}
   </style> 
 </head>
 <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php   include('header.php');    ?>
  <?php   include('sidebar.php');    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         NOTIFICATION
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
        <div class="box">
            <div class="box-header">
                
            <!-- /.box-header -->
                                    
   <?php
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y');
        $time =date('h:i A', time());
        if(isset($_POST['submit'])  && ($_POST['framework1']) && ($_POST['framework']))
        {
            
    	   // Enabling error reporting
             error_reporting(0);
             ini_set('display_errors', 'On');
             
             require_once __DIR__ . '/firebase1.php';
             require_once __DIR__ . '/push1.php';
                
                 
              $firebase = new Firebase();
              $push = new Push();
              
    	       $o1=$_POST['msg']; 
              //$add=$_POST['user']; 
               $legal_area=$_POST['framework1'];
               if( is_array($legal_area)){
                // while (list ($key, $val) = each ($legal_area)) {
                     foreach($legal_area as $key => $val) {
                //echo "$val <br>";
                //
                //else{echo "not array";}
               
               // optional payload
                  $payload = array();
                  $payload['team'] = 'India';
                  $payload['score'] = '5.6';
                 
                  // notification title
                  $title =$_POST['title'];
                    $path="http://cisswork.com/Android/guru_taxi/Guru_taxi_Admin/SuperAdmin/dist/img/imageedit_1_3447018947.png";
                    
                  // notification message
                  $message=$o1;
                   $push->setTitle($title);
                   $push->setMessage($message);
                   $push->setImage(json_encode($path, JSON_UNESCAPED_SLASHES));
                  
                   $push->setIsBackground(FALSE);
                   $push->setPayload($payload);
                   
                   $sql=mysqli_query($con,"SELECT * FROM  `user_register` WHERE id='$val'");
                   $number_of_rows =@mysqli_num_rows($sql);
                   if($number_of_rows==0)
                    {
                      $m["result"] = "unsuccessful";
                
                    }
                    else
                    {
                      while($row=@mysqli_fetch_assoc($sql))
                      {
                          $dt=$date.' '.$time;
                    $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`, `type`)
                    VALUES ('','$val','','$title','$message','$dt','Admin')");
                          $ds=$row['device_status'];
        	             if($ds=='IOS' || $ds=='Android')
        	            {  
        	                $deviceTokenu=$row['iosdevice_id'];
                            // $json = '';
                            // $response = '';
                            // $json = $push->getPush();
                            // $iosresponse = $firebase->send($deviceToken, $json);
                             $m["result"] = "success";
                      $regId=$row['device_id'];
                       $json = '';
                       $response = '';
                       $json = $push->getPush();
                           
                     $response = $firebase->send($regId,$json);
                   }
                } 
                //IOS User
                    $ch = curl_init("https://fcm.googleapis.com/fcm/send");
    
                    //The device token.
                    $token = $deviceTokenu; //token here
                
                    //Title of the Notification.
                    //$title = "Carbon";
                
                    //Body of the Notification.
                    //$body = "Bear island knows no king but the king in the north, whose name is stark.";
                
                    //Creating the notification array.
                    $notification = array('title' =>$title , 'body' => $message, 'sound' => 'default', 'badge' => '1');
                
                    //This array contains, the token and the notification. The 'to' attribute stores the token.
                    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                
                    //Generating JSON encoded string form the above array.
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
                    //return $response;
                   }  }}
       // Enabling error reporting
             error_reporting(-1);
             ini_set('display_errors', 'On');
             
             require_once __DIR__ . '/firebase.php';
             require_once __DIR__ . '/push.php';
                
               $o1=$_POST['msg'];    
              $firebase1 = new Firebase1();
              $push1 = new Push1();
               $legal_area1=$_POST['framework'];
               if( is_array($legal_area1)){
                // while (list ($key1, $val1) = each ($legal_area1)) {
                     foreach($legal_area1 as $key1 => $val1) {
                //echo "$val <br>";
                //
                //else{echo "not array";}
               
               // optional payload
                  $payload1 = array();
                  $payload1['team'] = 'India';
                  $payload1['score'] = '5.6';
                 
                  // notification title
                  $title1 =$_POST['title'];
                         
                  // notification message
                  $message1=$o1;
                        
                   $push1->setTitle($title1);
                   $push1->setMessage($message1);
                   $path="http://cisswork.com/Android/guru_taxi/Guru_taxi_Admin/SuperAdmin/dist/img/imageedit_1_3447018947.png";
                   $push1->setImage(json_encode($path, JSON_UNESCAPED_SLASHES));
                   $push1->setIsBackground(FALSE);
                   $push1->setPayload($payload1);
            
                   $sql1=mysqli_query($con,"SELECT * FROM  `Drivers` WHERE DriverID='$val1'");
                   $number_of_rows1 =@mysqli_num_rows($sql1);
                   if($number_of_rows1==0)
                    {
                      $m["result"] = "unsuccessful";
                    }
                    else
                    {
                      while($row=@mysqli_fetch_assoc($sql1))
                      {
                          $ds=$row['device_status'];
        	             if($ds=='IOS' || $ds=='Android')
        	            {  
        	                $deviceToken=$row['iosDriver_device_id'];
                            $json = '';
                            $response = '';
                            $json = $push->getPush();
                            $iosresponse = $firebase->send($deviceToken, $json);
                            $m["result"] = "success";
                       $regId1=$row['Driver_device_id'];
                       $json1 = '';
                       $response1 = '';
                       $json1 = $push1->getPush();
                           
                      $response1 = $firebase1->send($regId1,$json1);
                      
                 $dt=$date.' '.$time;
                 $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`, `type`)
                    VALUES ('','','$val1','$title1','$message1','$dt','Admin')");    
                   }
                }
                
                //IOS Driver
                $ch = curl_init("https://fcm.googleapis.com/fcm/send");
    
                //The device token.
                $token = $deviceToken; //token here
            
                //Title of the Notification.
                //$title = "Carbon";
            
                //Body of the Notification.
                //$body = "Bear island knows no king but the king in the north, whose name is stark.";
            
                //Creating the notification array.
                $notification = array('title' =>$title1 , 'body' => $message1, 'sound' => 'default', 'badge' => '1');
            
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
                //return $response;
            }
               }}
            //die; 
           
            
             $perr="Notification is added successfully!";
              echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                      echo'<script>window.location="notification.php";</script>';
                      
        }
        elseif(isset($_POST['submit']) && ($_POST['framework1']) && ($_POST['framework']=='') && ($_POST['msg']) )
        {
            
    	   // Enabling error reporting
             error_reporting(-1);
             ini_set('display_errors', 'On');
             
             require_once __DIR__ . '/firebase1.php';
             require_once __DIR__ . '/push1.php';
                
                 
              $firebase = new Firebase();
              $push = new Push();
              
    	       $o1=$_POST['msg']; 
              //$add=$_POST['user']; 
               $legal_area=$_POST['framework1'];
               if( is_array($legal_area)){
                // while (list ($key, $val) = each ($legal_area)) {
                    foreach($legal_area as $key => $val) {
                //echo "$val <br>";
                //
                //else{echo "not array";}
               
               // optional payload
                  $payload = array();
                  $payload['team'] = 'India';
                  $payload['score'] = '5.6';
                 
                  // notification title
                  $title =$_POST['title'];
                    $path="http://cisswork.com/Android/guru_taxi/Guru_taxi_Admin/SuperAdmin/dist/img/imageedit_1_3447018947.png";
                    
                  // notification message
                  $message=$o1;
                   $push->setTitle($title);
                   $push->setMessage($message);
                   $push->setImage(json_encode($path, JSON_UNESCAPED_SLASHES));
                  
                   $push->setIsBackground(FALSE);
                   $push->setPayload($payload);
                   
                   $sql=mysqli_query($con,"SELECT * FROM  `user_register` WHERE id='$val'");
                   $number_of_rows =@mysqli_num_rows($sql);
                   if($number_of_rows==0)
                    {
                      $m["result"] = "unsuccessful";
                
                    }
                    else
                    {
                      while($row=@mysqli_fetch_assoc($sql))
                      {
                    $dt=$date.' '.$time;
                     $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`, `type`)
                    VALUES ('','$val','','$title','$message','$dt','Admin')"); 
                   
                          $ds=$row['device_status'];
                           
        	             if($ds=='IOS' || $ds=='Android')
        	            {  
        	               $deviceTokenu=$row['iosdevice_id'];
                            // $json = '';
                            // $response = '';
                            // $json = $push->getPush();
                            // $iosresponse = $firebase->send($deviceTokenu, $json);
                             $m["result"] = "success";
                      $regId=$row['device_id'];
                       $json = '';
                       $response = '';
                       $json = $push->getPush();
                           
                     $response = $firebase->send($regId,$json);
                   }
                } 
                //Ios User
                    $ch = curl_init("https://fcm.googleapis.com/fcm/send");
    
                    //The device token.
                    $token = $deviceTokenu; //token here
                
                    //Title of the Notification.
                    //$title = "Carbon";
                
                    //Body of the Notification.
                    //$body = "Bear island knows no king but the king in the north, whose name is stark.";
                
                    //Creating the notification array.
                    $notification = array('title' =>$title , 'body' => $message, 'sound' => 'default', 'badge' => '1');
                
                    //This array contains, the token and the notification. The 'to' attribute stores the token.
                    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                
                    //Generating JSON encoded string form the above array.
                    $json = json_encode($arrayToSend);
                    //Setup headers:
                    $headers = array();
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'Authorization: key=AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
                
                    //Setup curl, add headers and post parameters.
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    //Send the request
                    $response = curl_exec($ch);
                
                    //Close request
                    curl_close($ch);
                   }  }}
                            
                            //$sql=mysqli_query($con,"INSERT INTO `user_admin_notification`(`user_id`, `title`, `message`, `date`, `time`) VALUES('$val3','$title','$message','$date','$time')"); 
                      $perr="Notification is added successfully!";
                      echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                      echo'<script>window.location="notification.php";</script>';
         }
        elseif(isset($_POST['submit']) && ($_POST['framework1']=='') && ($_POST['framework']) && ($_POST['msg']))
        {
            
    	   // Enabling error reporting
             error_reporting(-1);
             ini_set('display_errors', 'On');
             
             require_once __DIR__ . '/firebase.php';
             require_once __DIR__ . '/push.php';
                
               $o1=$_POST['msg'];    
              $firebase1 = new Firebase1();
              $push1 = new Push1();
              $legal_area1=$_POST['framework'];
               if( is_array($legal_area1))
               {
                     foreach($legal_area1 as $key4 => $val4) 
                     {
                //echo "$val <br>";
                
                  $payload1 = array();
                  $payload1['team'] = 'India';
                  $payload1['score'] = '5.6';
                 
                  // notification title
                  $title1 =$_POST['title'];
                         
                  // notification message
                  $message1=$o1;
                        
                   $push1->setTitle($title1);
                   $push1->setMessage($message1);
                   // $path="http://cisswork.com/Android/guru_taxi/Guru_taxi_Admin/SuperAdmin/dist/img/imageedit_1_3447018947.png";
                  // $push1->setImage(json_encode($path, JSON_UNESCAPED_SLASHES));
                  // $push1->setIsBackground(FALSE);
                   $push1->setPayload($payload1);
                   
                   $sql1=mysqli_query($con,"SELECT * FROM  `Drivers` WHERE DriverID='$val4'");
                   $number_of_rows1 =@mysqli_num_rows($sql1);
                   if($number_of_rows1==0)
                    {
                      $m["result"] = "unsuccessful";
                
                    }
                    else
                    {
                      $dt=$date.' '.$time;
                      $sql=mysqli_query($con,"INSERT INTO `tbl_notification_list`(`trip_id`,`user_id`, `driver_id`, `title`, `message`, `date`, `type`)
                    VALUES ('','','$val4','$title1','$message1','$dt','Admin')");     
                      while($row=@mysqli_fetch_assoc($sql1))
                      {
                        $ds=$row['device_status'];
    	             if($ds=='IOS' || $ds=='Android')
    	            {  
    	                
    	            $deviceToken=$row['iosDriver_device_id'];
                    // $json = '';
                    // $response = '';
                    // $json = $push1->getPush();
                    // $iosresponse = $firebase1->send($deviceToken, $json);  
                    $m["result"] = "success";
                       $regId1=$row['Driver_device_id'];
                       $json1 = '';
                       $response1 = '';
                       $json1 = $push1->getPush();
                       $response1 = $firebase1->send($regId1,$json1);
                      }
                }
                // IOs Driver code   
               $ch = curl_init("https://fcm.googleapis.com/fcm/send");
    
                //The device token.
                $token = $regId1; //token here
            
                //Title of the Notification.
                //$title = "Carbon";
            
                //Body of the Notification.
                //$body = "Bear island knows no king but the king in the north, whose name is stark.";
            
                //Creating the notification array.
                $notification = array('title' =>$title1 , 'body' => $message1, 'sound' => 'default', 'badge' => '1');
            
                //This array contains, the token and the notification. The 'to' attribute stores the token.
                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
             
                 $json = json_encode($arrayToSend);
                //Setup headers:
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: key=AAAAnuz262g:APA91bG4gp3xM3RSrbPKTRUuQHAdBLmk_aISt9OewedbBlfNkeKJ7sIk7jg8txl42cclMTC7SM_YHr2clEL9vtGhI0dl508bSpRv2B7OG0g5j0JlE1dXSsx-rOl6fyksrvdwKLZFqhC8'; // key here
            
            
                //Setup curl, add headers and post parameters.
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                //Send the request
           echo     $response = curl_exec($ch);
            
                //Close request
                curl_close($ch);
                //return $response;
    }
                                }
                            }
                
                    //   $perr="Notification is added successfully!";
                    //   echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    //   echo'<script>window.location="notification.php";</script>';
                    }
	?>
 
   <form method="post" id="framework_form">
<div class="row">
     <div class="col-md-6" >
    
     <label>Select Driver</label></br>
     <select id="framework" name="framework[]" multiple class="form-control">
      <?php
          $sql="SELECT * FROM Drivers";
          $res=mysqli_query($con,$sql);
          while($row=mysqli_fetch_assoc($res))
                 { 
                  $id=$row['DriverID'];
                  $name=$row['FirstName'].' '.$row['LastName'];
                 
                  echo "<option  value=$id>$name</option>";
                 } 
       ?>
     </select>
    </div>
    <div class="col-md-6" >
        <label>Select User</label></br>
        <select id="framework1" name="framework1[]" multiple class="form-control" >
          <?php
              $sql="SELECT * FROM user_register";
              $res=mysqli_query($con,$sql);
              while($row=mysqli_fetch_assoc($res))
             { 
              $id=$row['id'];
              $name=$row['full_name'];
             
              echo "<option  value=$id>$name</option>";
             } 
           ?>
        </select>
    </div>
</div>

     </br>
    <div class="row">
        <div class="col-md-12" >
         <label for="">Notification Title</label> 
         <input type='text' class="form-control" id="msg" placeholder="Add Title" name="title"></textarea> 
         </div>
    </div>
    
     </br>
   <div class="row">
         <div class="col-md-12" >
         <label for="">Send Notification</label> 
         <textarea class="form-control" id="msg" placeholder="Add Notiification message" name="msg"></textarea> 
         </div>
     </div>

     </br>
    <div class="row">
        <div class="col-md-12" >
        <input type="submit" class="btn btn-info" name="submit" value="Submit" />
        </div>
    </div>
   </form>
    </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         </div><!-----div main---->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('footer.php');?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
</body>
</html>

<script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Driver',
  //enableFiltering: true,
  //enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
//  $('#framework_form').on('submit', function(event){
//   event.preventDefault();
//   var form_data = $(this).serialize();
//   $.ajax({
//   url:"insert.php",
//   method:"POST",
//   data:form_data,
//   success:function(data)
//   {
//     $('#framework option:selected').each(function(){
//      $(this).prop('selected', false);
//     });
//     $('#framework').multiselect('refresh');
//     alert(data);
//   }
//   });
//  });
 
 
});
$(document).ready(function(){
 $('#framework1').multiselect({
  nonSelectedText: 'Select User',
 // enableFiltering: true,
 // enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
    
});
</script>
<!-- jQuery 3 -->
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<!--<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->





