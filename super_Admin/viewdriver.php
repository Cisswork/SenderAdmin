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
  <title>View Driver</title>
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
        DRIVERS LIST
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
                <div class="box">
            <div class="box-header">
              <a href="adddriver.php"><button type="button" class="btn btn-info" style="float:right;">ADD DRIVER</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th class="">S. No.</th>
                    <th>UserName</th>
                    <th>Name</th>
                    <!--th>Driver No</th-->
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Phone1</th>
                    <th>Phone2</th>
                    <th>Address</th>
                    <th>Address1</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Driver Image</th>
                    <th>Driver Licence Image</th>
                    <th>Licence Expiry Date</th>
                    <th>Driver Online/Offline Status</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                     <?php
                        $path="https://cisswork.com/Android/SenderApp/images/";
                        $def="https://cisswork.com/Android/SenderApp/logo (2).png";
                        $sql="SELECT * FROM Drivers ORDER BY DriverID  desc";
                        $res=mysqli_query($con,$sql);
                        date_default_timezone_set("Asia/Kolkata");
                        $sell=mysqli_query($con,"SELECT * FROM `Drivers` WHERE login_status='1'");
                        $fet=mysqli_fetch_assoc($sell);
                        $date=$fet['date'];  
                        $ct=date('Y-m-d h:i:s');
                        $date11 = date('Y-m-d h:i:s', strtotime('+24 hour', strtotime($date)));
                        $count=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $mid=$row['DriverID'];
                            $datetime1=$row['date'];
                            $status=$row['Status'];
                            $login_status = $row['login_status'];
                        ?>
                <tr>
                    <td><?php echo ++$count;?></td>
                    <td><?php echo $row['UserName'] ?></td>
                    <td class="center"><?php echo $row['FirstName']." ".$row['LastName'];?> </td>
                    <td class="center"><?php echo $row['Email'];?></td>
                    <td class="center"><?php echo $row['Password'];?></td>
                    <td class="center"><?php echo $row['country_code'].$row['Phone'];?></td>
                     <td class="center"><?php echo $row['country_code'].$row['Phone2'];?></td>
                      <td class="center"><?php echo $row['country_code'].$row['Phone3'];?></td>
                    <td class="center"><?php echo $row['Address'];?> </td>
                    <td class="center"><?php echo $row['Address2'];?></td>
                    <td class="center"><?php echo $row['City'];?></td> 
                    <td class="center"><?php echo $row['State'];?></td> 
                    <td class="center"><?php echo $row['Zip'];?></td>
                     <td class="center"><img src="<?php 
                    $pay1=$row['image'];
                    if($pay1=='')
                    {
                     echo $def; 
                    }
                    else
                    {
                    echo $path.$pay1;
                    }?>" height="100px" width="100px"> </td>
                    
                    <td class="center">
                        <?php  $imm= $row['LicensePic'];
                        $last_3digit=substr($imm, -3);
                        $image11 =$path.$row['LicensePic'];
                        if($last_3digit == 'PDF' || $last_3digit == 'pdf')
                        { ?>
                         <iframe src="<?php $pay2=$row['LicensePic'];if($pay2==''){echo $def;} else{echo $path.$pay2;}?>" width="100px" height="100px"></iframe>
                         <a target="_blank" href="id_image1.php?ACid=<?php echo $mid;?>"><button>View in new tab</button> </a>
                       <?php } else {?>
                          <img src="<?php $pay2=$row['LicensePic'];if($pay2==''){echo $def;} else{echo $path.$pay2;}?>" height="100px" width="100px">
                        <?php } ?>
                    </td>
                    
                      <td class="center"><?php echo $row['LicenseNum'];?></td>
                        <?php
                         if($login_status == '1')
                         {
                             $onoff="Online";
                         }
                         else
                         {
                           $onoff="Offline";  
                         }
                         ?>
                          <td class="center"><?php echo $onoff;?></td>
                    
                        <td><?php if ($status == "1" ) {?>
                            <img src="dist/img/active.png" style="width:30px;height:30px;">  
                           
                       <?php }else { ?>
                             <img src="dist/img/inactive.png" style="width:30px;height:30px;">  
                       <?php } ?></td>
                        
                        <td>
                            <div class="dropdown">
                                <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;"></button>
                                <ul class="dropdown-menu">
                                    <li><a href="editdriver.php?drid=<?php echo $mid;?>" data-toggle="tooltip" title="Update"><img src="dist/img/edit-doc.png" style="width:30px;height:30px;"></a></li>
                                    <!--<li><a href="driverdocument.php?drid=<?php echo $id;?>" data-toggle="tooltip" title="View"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li-->
                                    <?php if ($status == "1" ) {?>
                                       <li><a href="viewdriver.php?bid=<?php echo $mid; ?>" data-toggle="tooltip" title="Disapprove"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                                    <?php }else { ?>
                                       <li><a href="viewdriver.php?aid=<?php echo $mid; ?>" data-toggle="tooltip" title="Approve"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li> 
                                   <?php } ?> 
                                   <li><a href="viewdriver.php?cid=<?php echo $mid;?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
                                    <li><a href="viewdriver.php?logid=<?php echo $mid; ?>" data-toggle="tooltip" title="Logout"><img src="dist/img/lg.png" style="width:30px;height:30px;"></a></li>
                                </ul>
                            </div>
                        </td>
                 </tr>
               
                <?php } ?>
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
        $record=mysqli_query($con,"update Drivers set status='1'  where DriverID='$aid'");
        if($record)
        {
          
            $perr="Driver approved successfully!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewdriver.php";</script>';
        }
        else
        {
            $perr="Sorry! Unable to approve";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewdriver.php";</script>';
        }
    }
    
    ?>

<?php
    if(isset($_GET['bid']))
    {
        $bid=$_GET['bid'];
        $record=mysqli_query($con,"update Drivers set status='0' where DriverID='$bid'");
        if($record)
        {
          
            $perr="Driver suspended successfully!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewdriver.php";</script>';
        }
        else
        {
            $perr="Sorry! Unable to suspended";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewdriver.php";</script>';
        }
    }
    
?>

    <!----------Delete start---------------->
  <?php
     if($_GET['cid'])
     {
            $id=$_GET['cid'];
            $delete="DELETE FROM Drivers WHERE DriverID='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                  
                  $del1=mysqli_query($con,"Delete from canclebooking where driver_id='$id'");
                  $del2=mysqli_query($con,"Delete from getTransactionhistory where iDriverId='$id'");
                  $del3=mysqli_query($con,"Delete from notification_tbl where driver_email='$id'");
                  $del4=mysqli_query($con,"Delete from tbl_notification_list where driver_id='$id'");
                  $del5=mysqli_query($con,"Delete from tbl_rating where driver_id='$id'");
                  $del6=mysqli_query($con,"Delete from tbl_driver_card where iDriverId='$id'");
                  $del7=mysqli_query($con,"Delete from trip_history where driver_id='$id'");
                  $del8=mysqli_query($con,"Delete from driver_admin_notification where driver_id='$id'");
                  $del9=mysqli_query($con,"Delete from driver_withdraw_request where driver_id='$id'");
                  $del10=mysqli_query($con,"Delete from tbl_updatedrivervehicle where iDriverId='$id'");
                    $perr="Driver deleted successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="viewdriver.php";</script>';
              }
    }
 ?>
 <!----------End delete------------------->
 <?php
    if(isset($_GET['logid']))
    {
        $logid=$_GET['logid'];
        
        $ud=mysqli_query($con,"UPDATE `Drivers` SET `login_status`='0',`login_device_key`='' WHERE `DriverID`='$logid'");
       // @SESSION_START();
        unset($_GET['logid']);
        if($ud)
        {
           echo'<script>window.location="viewdriver.php";</script>';
        }
        
    }
    ?>
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