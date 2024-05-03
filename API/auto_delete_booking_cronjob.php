<?php 
    include('config.php');
    date_default_timezone_set('America/Jamaica');
    $date = date('d-m-Y');
    $arrr = array();
    $qty_arr1=array();
    // $record1=mysqli_query($con,"SELECT * FROM notification_tbl WHERE ride_type='Ride_later' AND driver_status='pending' AND ( STR_TO_DATE(ride_date, '%d-%m-%Y') < STR_TO_DATE('$date', '%d-%m-%Y'))");
   
    $record1=mysqli_query($con,"SELECT * FROM notification_tbl WHERE (driver_status != 'Complete' AND driver_status != 'cancel') AND (STR_TO_DATE(ride_date, '%d-%m-%Y') < STR_TO_DATE('$date', '%d-%m-%Y')) ");
   // die(mysqli_error($con));
  //  echo mysqli_num_rows($record1);
    while($row_ss = mysqli_fetch_assoc($record1))
    {
        $status = $row_ss['driver_status'];
        if($status != 'cancel' && $status != 'Complete')
        {
     echo  $booking_id= $row_ss['id'];
        }
       array_push($arrr,$booking_id);
    }
    $qty_arr1=$arrr;
    // echo count($qty_arr1);
    for($i=0; $i<count($qty_arr1); $i++)
    {
        $aid=$qty_arr1[$i];
        $delete=mysqli_query($con,"UPDATE notification_tbl SET driver_status='cancel',cancel_by='Admin',cancel_reason='Trip time has been expired' where id='$aid'");
        $delete1=mysqli_query($con,"UPDATE panding_booking_request_driver SET status = 'cancel' where trip_id='$aid'");
    }
?>