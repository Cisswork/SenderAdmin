<?php include('config.php');?>
<?php 
  if(!isset($_SESSION['id']))  
       {
       	echo "<script>window.location.href='index.php';</script>";
	} ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Invoice</title>
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
<style>
hr {
    margin-top: 20px;
    margin-bottom: 2px;
    border: 0;
    border-top: 1px solid #eee;
}

.btn-primary {
    background-color: #0f84e1;
    border-color: #2196F3;
}    
.btn-primary:hover {
    background-color: #0f84e1;
    border-color: #2196F3;
}      
   .dropdown-menu {
    position: absolute;
    top: -150%;
    left: -60px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 60px;
    padding: 1px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 25px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
    .scroll{width:100%;height:275px; overflow:scroll;padding: 10px 0 0 0;overflow-x:hidden;}
</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('header.php'); ?>
  <?php   include('sidebar.php');    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         INVOICE
      </h1>
     
    </section>

    <?php
                         if(isset($_GET['hv_id']))
                         {
                            $hvid=$_GET['hv_id'];
                            $sql=mysqli_query($con,"SELECT * FROM `Trips` WHERE TripID='$hvid'");
                            $row=mysqli_fetch_assoc($sql);
                            $book_time=$row['RequestTime'];
                            $book_date=explode(' ',$book_time);
                            $date=$book_date[0];
                            $time=$book_date[1];  
                            $ur_name=$row['SenderID'];
                            $dr_name=$row['DriverID'];
                            $card_id = $row['CaptureID'];
                            $user_img=mysqli_query($con,"select * from Senders where SenderID='$ur_name'");
                            $uimg=mysqli_fetch_assoc($user_img);
                            $email=$uimg['Email'];
                            
                            $driver_img=mysqli_query($con,"select * from Drivers where DriverID='$dr_name'");
                            $dimg=mysqli_fetch_assoc($driver_img);
                           
                            $crd=mysqli_query($con,"SELECT * FROM `tbl_user_card` where payment_method_id='$card_id'");
                            $crdd=mysqli_fetch_assoc($crd);
                            
                            $path="https://cisswork.com/Android/SenderApp/images/";
                            $def="https://cisswork.com/Android/SenderApp/super_Admin/logo (2).png";
                         }
                       ?>
    
  
    <!-- Main content -->
    <section class="content container-fluid">
        <div style="padding: 0 27px 0 27px;"> <!-----div main---->
            <form role="form" method="post" enctype="multipart/form-data">          
                <div class="row">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border" style="padding: 8px 0 6px 9px;">
                            <h3 class="box-title"> <b>Your Trip</b> <?php echo $date;?>  on  <?php echo $time;?></h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row" style="padding: 0 0px 0 0px;"><!--row -->
                                <div class="col-md-6"><!--col-6 -->
                                    <div style="border:1px solid #ccc;border-radius:5px;">
                                        <div id="map"></div>
                                        <div style="padding: 10px 0px 10px 10px;">
                                            <p><i class="fa fa-map-marker" aria-hidden="true" style="color:green;"></i> <?php echo $row['FromAddress'];?> </p>
                                            <p><i class="fa fa-map-marker" aria-hidden="true" style="color:red;"></i> <?php echo $row['ToAddress'];?> </p>
                                            <hr> 
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td ></td>
                                                        <td style="width: 15%;">
                                                        <img src="<?php
                                                        if($dimg['image']=='')
                                                        {
                                                         echo $def; 
                                                        }
                                                        else
                                                        {$path.$dimg['image'];}?>" style="width:75px;height:75px;border-radius: 14px;border: 1px solid;padding: 4px 3px 4px 3px;">
                                                        </td>
                                                        <td> Driver<br> <b style="font-weight: 500;"><?php echo $dimg['FirstName']." ".$dimg['LastName'];?></b> </td>
                                                        <td style="width: 15%;">
                                                            <img src="<?php
                                                        if($uimg['image']=='')
                                                        {
                                                         echo $def; 
                                                        }
                                                        else
                                                        {echo $path.$uimg['image'];}?>" style="width:75px;height:75px;border-radius: 14px;border: 1px solid;padding: 4px 3px 4px 3px;"> 
                                                            </td>
                                                        <td> User<br> <b style="font-weight: 500;"><?php echo $uimg['FirstName']." ".$uimg['LastName'];?></b> </td>
                                                        <td style="width: 5%;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>         
                                </div><!--col-6 -->
                                
                                <div class="col-md-6"><!--col-6 -->
                                    <div style="border:1px solid #ccc;border-radius:5px;padding: 6px 6px 6px 6px;">
                                        <center><p style="margin: 4px 0 -7px;font-size: 20px;"><b>Fare Breakdown For Ride No : <?php echo $row['TripID'];?></b></p></center>
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
                                                    <td style="width: 83%;">Total Amount </td>
                                                    <td style="width: 40%;"> <?php echo "$. ".$row['Cost'];?> </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 83%;">Total Discount </td>
                                                    <td style="width: 40%;"> <?php echo "- $. ".$row['discount'];?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <table class="table">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($row['payment_mode']=='Cash')
                                            {
                                            ?>
                                            <tr>
                                               <td style="width: 95%;"><b>Total Fare (Via <?php echo $row['payment_mode'];?>)</b> </td>
                                               <td style="width: 50%;"><b><?php echo "$".$row['Price'];?> </b> </td>
                                            </tr>
                                            <?php
                                            }
                                            else
                                            {
                                                $newstring = $crdd['card_number'];
                                            ?>
                                               <tr>
                                               <td style="width: 80%;"><b>Total Fare (Via <?php echo $row['payment_mode'];?> - <?php echo 'XXXX XXXX'.$newstring;?>)</b> </td>
                                               <td style="width: 30%;"><b><?php echo "$".$row['Price'];?> </b> </td>
                                            </tr> 
                                            <?php
                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <!--<input type="submit" class="btn btn-primary" name="email" value="E-mail" style="float:right;">-->
                                </div> <!--col-6 -->     
                            </div><!--row -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </form>
        </div> <!-----div main----> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('footer.php');?>

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>


<!DOCTYPE html>
<html>
<head>
<title>How to get a Google Map Driving Direction using Javascript.</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxNJhFG4F2AM_S3vC7mL4ffmEBzzMY1QM"></script>
<script type="text/javascript" src="googlemap.js"></script>
<link href="style.css" type="text/css" rel="stylesheet"/>
</head>

<body>
    <?php
    
    $ss=$row['source_add'];
    $string = str_replace(" ", "+", urlencode($ss));
    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyDPOBzV9OPNLiMTNkAh8DOqxdgNQn21Ah0";
    $return_arr=array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $details_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    if ($response['status'] != 'OK') 
    {
        return null;
    }
    $geometry = $response['results'][0]['geometry'];
    $latt = $geometry['location']['lat'];
    $lngg = $geometry['location']['lng'];
    
    $dd=$row['destination_add'];
    $string = str_replace(" ", "+", urlencode($dd));
    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyDPOBzV9OPNLiMTNkAh8DOqxdgNQn21Ah0";
    $return_arr=array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $details_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    if ($response['status'] != 'OK') 
    {
        return null;
    }
    $geometry = $response['results'][0]['geometry'];
    $latt1 = $geometry['location']['lat'];
    $lngg1 = $geometry['location']['lng'];
    ?>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDPOBzV9OPNLiMTNkAh8DOqxdgNQn21Ah0"></script>
   <script type="text/javascript">
   var markers = [
    
            {
               
               "lat": <?php echo $latt;?>,
               "lng": <?php echo $lngg;?>,
               
           }
    
       ,
    
            {
               
               "lat": <?php echo $latt1;?>,
               "lng": <?php echo $lngg1;?>,
              
           }
    
       
   ];
   </script>
   <script type="text/javascript">
 var map;

function renderDirections(result, map) {
  var directionsRenderer1 = new google.maps.DirectionsRenderer({
    directions: result,
    routeIndex: 0,
    map: map,
    polylineOptions: {
      strokeColor: "green"
    }
  });
  console.log("routeindex1 = ", directionsRenderer1.getRouteIndex());

  var directionsRenderer2 = new google.maps.DirectionsRenderer({
    directions: result,
    routeIndex: 1,
    map: map,
    polylineOptions: {
      strokeColor: "blue"
    }
  });
  console.log("routeindex2 = ", directionsRenderer2.getRouteIndex()); //line 17
}

function calculateAndDisplayRoute(origin, destination, directionsService, directionsDisplay, map) {
  directionsService.route({
    origin: origin,
    destination: destination,
    travelMode: google.maps.TravelMode.DRIVING,
    provideRouteAlternatives: true
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      renderDirections(response, map);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

function initialize() {
  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer();
  var map = new google.maps.Map(
    document.getElementById("map"), {
      center: new google.maps.LatLng(18.9750, 72.8258),
      zoom: 3,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  directionsDisplay.setMap(map);
  calculateAndDisplayRoute(new google.maps.LatLng(<?php echo $latt;?>, <?php echo $lngg;?>), new google.maps.LatLng(<?php echo $latt1;?>, <?php echo $lngg1;?>), directionsService, directionsDisplay, map);


}
google.maps.event.addDomListener(window, "load", initialize);

   </script>
		<td><input type="hidden" id="txtStartingPoint" value="<?php echo $row['source_add'];?>" class="input-entry"/></td>
		<td><input type="hidden" id="txtDestinationPoint" value="<?php echo $row['destination_add'];?>" class="input-entry"/></td>

<table class="tbl-map">
	<tr>
		<!--<td><div id="panel-direction"></div></td>-->
	</tr>
</table>

</body>
</html>