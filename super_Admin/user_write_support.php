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
  <title>View User  Write Support</title>
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
        USERS SUPPORT MESSAGES
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
                <div class="box">
            <div class="box-header">
              <!--<a href="addcustomer.php"><button type="button" class="btn btn-info" style="float:right;">ADD CUSTOMER</button></a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th style="width: 50px;">S. No.</th>
                    <!--<th>Booking ID</th>-->
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Contact Info</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <!--<th>image</th>-->
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $path="https://cisswork.com/Android/Cerber_taxi/images/";
                        $def="https://cisswork.com/Android/Cerber_taxi/Cerber_super_Admin/logo (2).png";
                        $select=mysqli_query($con,"SELECT * FROM tbl_user_write_support WHERE type='User' ORDER BY id desc");
                        $count=1;
                        while($row=mysqli_fetch_assoc($select))
                        {
                            
                        $driver_id=$row['user_id'];
                        $sell=mysqli_query($con,"SELECT * FROM `user_register` WHERE id='$driver_id'");
                        $fet=mysqli_fetch_assoc($sell);
                        $status=$row['user_status']
                        ?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <!--<td><?php echo $row['booking_id'];?></td>-->
                    <td><?php echo $fet['full_name']." ".$fet['middle_name']." ".$fet['sur_name'];?> </td>
                    <td><?php echo $fet['email'];?></td>
                    <td><?php echo $fet['country_code'].$fet['contact'];?></td>
                    <td><?php echo $row['subject'];?></td>
                    <td><?php echo $row['message'];?></td>
                    <!--<td class="center"><img src="<?php $pay=$row['image'];if($pay==''){echo $def;}else {echo $path.$pay;}?>" height="100px" width="100px"> </td>-->
                    <td><?php echo $row['date'];?></td>
                    <td><?php echo $row['time'];?></td>
                 </tr>
                <?php 
                }
                ?>
                </tbody>
                
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
           <?php
    if(isset($_GET['aid']))
    {
        $aid=$_GET['aid'];
        $select1=mysqli_query($con,"select * from user_register where id='$aid'");
        $selefetch=mysqli_fetch_assoc($select1);
        
        $record=mysqli_query($con,"update user_register set user_status='Approve' where id='$aid'");
        if($record)
        {
            
            $perr="Approved Successfully.!!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewcustomer.php";</script>';
        }
       
        else
        {
            
            $perr="Sorry! Unable to activate";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            //echo'<script>window.location="viewdriver.php";</script>';
        }
        }
    
    ?>


<?php
    if(isset($_GET['bid']))
    {
        $bid=$_GET['bid'];
        $record=mysqli_query($con,"update user_register set user_status='Disapprove' where id='$bid'");
        if($record)
        {
          
            $perr=" Disapproved Successfully.!!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewcustomer.php";</script>';
        }
        else
        {
            $perr="Sorry! Unable to activate";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            //echo'<script>window.location="viewdriver.php";</script>';
        }
    }
    
?>
         	<!----------Delete start---------------->
  <?php
     if($_GET['id'])
     {
            $id=$_GET['id'];
            $delete="DELETE FROM user_register WHERE id='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                  $del1=mysqli_query($con,"Delete from canclebooking where user_id='$id'");
                  $del2=mysqli_query($con,"Delete from getTransactionhistory where iUserId='$id'");
                  $del3=mysqli_query($con,"Delete from notification_tbl where user_id='$id'");
                  $del4=mysqli_query($con,"Delete from tbl_notification_list where user_id='$id'");
                  $del5=mysqli_query($con,"Delete from tbl_rating where user_id='$id'");
                  $del6=mysqli_query($con,"Delete from tbl_user_card where user_id='$id'");
                  $del7=mysqli_query($con,"Delete from trip_history where user_id='$id'");
                  $del8=mysqli_query($con,"Delete from user_admin_notification where user_id='$id'");
                    $perr="Delete Success";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="viewcustomer.php";</script>';
              }
    }
 ?>
 <!----------End delete------------------->
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
</body>
</html>