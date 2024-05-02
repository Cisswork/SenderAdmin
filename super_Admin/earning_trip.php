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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trip Earning History</title>
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
 /*SELECT DROPDOWN  AND DATE AND TIME CSS START SELECT DROPDOWN  AND DATE AND TIME CSS START */
.fully-headings {
    display: flex;
}
.fully-headings .head-name {
    width: 20%;
    text-align: left;
}
.fully-headings .head-name h1 {
    font-weight: 500;
    line-height: 1.1;
    color: black;
    font-family: 'Source Sans Pro',sans-serif;
    margin-top: 0px;
    margin-bottom: 0px;
    font-size: 30px;
}
.fully-headings .date-name {
    width: 99%;
}
.date-name .fully-date {
    display: flex;
    width: 100%;
}
.date-name .fully-date .start-date {
    width: 29%;
    text-align: right;
}
.date-name .fully-date .start-date input#start {
    width: 100%;
    padding: 5px 6px;
    background: white;
    border: 1px solid lightgrey;
    border-radius: 5px 0px;
    box-shadow: 0px 2px 20px rgb( 0 0 0 /10%);
}
.date-name .fully-date .end-date {
    width: 29%;
    text-align: center;
}
.date-name .fully-date .end-date input#start {
    width: 90%;
    padding: 5px 6px;
    background: white;
    border: 1px solid lightgrey;
    border-radius: 5px 0px;
    box-shadow: 0px 2px 20px rgb( 0 0 0 /10%);
}
.select-taxi {
    float: right;
    text-align: center;
        width: 37%;
    display: block;
    position: relative;
    padding-left: 4%;
}

.select-taxi select#taxi {
       width: 90%;
    height: 35px;
    padding: 5px 6px;
    background: white;
    border: 1px solid lightgrey;
    border-radius: 5px 0px;
    box-shadow: 0px 2px 20px rgb( 0 0 0 /10%);
} 
.date-submit {
    margin-right: 207px !important;
    margin-top: 8% !important;
    margin-left: -37% !important;
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
        TRIP EARNING HISTORY
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
        <div class="box">
            <div class="box-header"></div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped ">
                <thead>
                            <tr>
                                <th class="">S. NO.</th>
                                <th>Booking Id</th>
                                <th>Booking Status</th>
                                <!--<th>Company Name</th>-->
                                 <th>Source</th>
                                <th>Destination</th>
                                <th>Customer</th>
                                <th>Driver</th>
                                <th>Booking Date</th>
                                <th>Package Type</th>
                                
                                <!--<th>Distance</th>-->
                                <!--<th>Duration</th>-->
                                <th>Payment Mode</th>
                                <!--<th>Base Fare</th>-->
                                <!--<th>Distance Fare</th>-->
                                <!--<th>Time Fare</th>-->
                                <!--<th>Tax</th>-->
                                <th>Total Amount</th>
                                <th>Total Discount</th>
                                <!--<th>Admin Commission</th>-->
                                <!--<th>Driver Toll Price</th>-->
                                <!--<th>Driver Earning</th>-->
                                <th>Grand Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                $sql="SELECT * FROM `notification_tbl` WHERE driver_status='end_ride' OR driver_status='Complete' order by id desc ";
                                 $res=mysqli_query($con,$sql);
                                  $count=0;                                      
                                 while($row=mysqli_fetch_assoc($res))
                                 {
                                  $id=$row['id'];
                                  $destination=$row['destination_add'];
                                  $source=$row['source_add'];
                                  $uem=$row['user_id'];
                                  $status=$row['driver_status'];
                                  $u_na=mysqli_query($con,"SELECT * FROM user_register WHERE id='$uem'");
                                  $u_row=mysqli_fetch_assoc($u_na); 
                                  $u_name=$u_row['full_name']." ".$u_row['last_name'];
                                  $dem=$row['driver_id'];
                                  $d_na=mysqli_query($con,"SELECT * FROM driver_register WHERE id='$dem'");
                                  $d_row=mysqli_fetch_assoc($d_na); 
                                  $d_name=$d_row['fullname']." ".$d_row['last_name'];
                                  $car=$d_row['car_name'];
                                  
                                   $sql3=mysqli_query($con,"SELECT * FROM company_register WHERE id='".$row['company_id']."'");
                                   $res3=mysqli_fetch_assoc($sql3);
                                  
                                  $amount=$row['total_amount'];
                                  $add=$row['address'];
                                  $car_name=$row['car_name'];
                                  $car_number=$row['car_number'];
                                 $tax=$row['tax_amount'];
                                  $tamount=$amount+$tax;
                                  $row['total_amount']-$tamount
                            ?>  
                                    
                                    <tr>
                                
                                 <td class="center"><?php echo  ++$count;?></td>
                                 <td class="center"><?php echo $row['id'];?></td>
                                 <td class="center"><?php 
                                if($status=='New Booking')
                                {
                                    echo 'New Booking';
                                }
                                elseif($status=='confirm')
                                {
                                    echo 'Confirmed';
                                }
                                elseif($status=='accept')
                                {
                                    echo 'Accepted';
                                }
                                elseif($status=='arrived')
                                {
                                    echo 'Arrived';
                                }
                                elseif($status=='start_ride')
                                {
                                    echo 'Start Ride';
                                }
                                 elseif($status=='onthe_way')
                                {
                                   echo 'On the Way';     
                                }
                                elseif($status=='end_ride' || $status=='Complete')
                                {
                                   echo 'Complete'; 
                                }
                                elseif($status=='cancel' && $row['cancel_by']=='User')
                                {
                                    echo 'Cancelled by user';
                                }
                                elseif($status=='cancel' && $row['cancel_by']=='Driver')
                                {
                                    echo 'Cancelled by driver';
                                }
                                ?></td>
                                <!--<td class="center"><?php echo $res3['fullname'];?> </td>-->
                                <td class="center"><?php echo $source; ?></td>
                                <td class="center"><?php echo $destination;?></td>
                                <td class="center"><?php echo $u_name; ?></td>
                                <td class="center"><?php echo $d_name; ?></td>
                                <td class="center"><?php echo $row['ride_date'] ." " .$row['ride_time'];?></td>
                                <td class="center"><?php echo $row['package_name'];?></td>
                                
                                <!--<td class="center"><?php echo $row['total_distance'];?></td>-->
                                <!--<td class="center"><?php echo $row['total_duration'];?></td>-->
                                <td class="center"><?php echo $row['payment_mode'];?></td>
                                <!--<td class="center"><?php echo $row['base_fare_cost'];?></td>-->
                                <!--<td class="center"><?php echo $row['per_km_cost'];?></td>-->
                                <!--<td class="center"><?php echo $row['price_per_min'];?></td>-->
                                <!--<td class="center"><?php echo $row['tax_percent'];?></td>-->
                                 <td class="center"><?php echo $row['trip_fare'];?></td>
                                <td class="center"><?php echo $row['discount'];?></td>
                                <!--<td class="center"><?php echo $row['admin_commission'];?></td>-->
                                <!--<td class="center"><?php echo $row['tolloption_price'];?></td>-->
                                <!--<td class="center">-->
                                <!--<?php if($status=='end_ride' || $status=='Complete') {echo $row['driver_earning']-$row['tolloption_price'];}else { echo $row['driver_earning']-$row['tolloption_price']-$row['admin_commission'];}?>-->
                                <!--</td>-->
                                <td class="center"><?php echo $row['total_fare'];?></td>
                                <!--<td class="center">
                                    <a class="btn btn-success btn-sm view-customer" href="#" id="" data-status="" data-id="">
                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                        View Details
                                    </a>
                                </td>-->
                                <td><a href="invoice.php?hv_id=<?php echo $row['id'];?>" class="btn btn-primary"><i class="fa fa-list-ul" aria-hidden="true"></i> <b>View Invoice</b></a></td>
                           </tr>
                           <?php }?>
                        </tbody>
                
              </table>
            </div>
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

</script>
</body>
</html>