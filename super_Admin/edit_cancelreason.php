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
  <title>Edit Cancel Reason</title>
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
    <!--<section class="content-header">-->
    <!--    <a href="vehicletype.php"><button type="button" class="btn btn-info" style="float: right;margin: 13px;">BACK TO LISTING</button></a>-->
    <!--  <h1>-->
    <!--    ADD VEHICLE TYPE-->
    <!--  </h1>-->
     
    <!--</section>-->

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
          <div class="box-header">
                <a href="cancel_reason.php"><button type="button" class="btn btn-info" style="float:right;">VIEW CANCEL REASON</button></a>
            </div>
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Cancel Reason</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                           <?php
                                        if($_GET['eid'])
                                        {
                                            $ser=mysqli_query($con,"SELECT * FROM tbl_cancel_reason where reason_id='".$_GET['eid']."'");
                                            $ser1=mysqli_fetch_assoc($ser);
                                        }
                                         if(isset($_POST['add']) && !empty($_POST['add']))
                                         {
                                             $reason_for=$_POST['reason_for'];
                                             $cancel_reason=$_POST['cancel_reason'];
                                            
                                           
                                            $query=mysqli_query($con,"UPDATE `tbl_cancel_reason` set `reason_for`='$reason_for', `cancel_reason`='$cancel_reason' where reason_id='".$_GET['eid']."'");
                                            
                                            //echo mysqli_error($con);
                                            if($query)
                                            {
                                                $perr="Cancellation Reason updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                echo'<script>window.location="cancel_reason.php";</script>'; 
                                            }
                                            else
                                            {
                                                $perr="Unable to update";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                         }
                                       ?>
                              <div class="box-body">
                                                 <form role="form" method="post" class="validate" enctype="multipart/form-data">
                                    
                                                      <div class="form-group">
                                                        <label class="control-label" for="name">Cancel Reason For</label>
                                                        <select type="text" name="reason_for" class="form-control required" placeholder=" Cancel Reason For">
                                                            <option value="<?php echo $ser1['reason_for']?>"><?php echo $ser1['reason_for']?></option>
                                                            <option value="User">User</option>
                                                            <option value="Driver">Driver</option>
                                                        </select>
                                                    </div>
                                                     <div class="form-group" >
                                                        <label class="control-label" for="name">Cancel Reason</label>
                                                        <input type="text" name="cancel_reason" class="form-control required" placeholder="Please Enter Cancel Reason" value="<?php echo $ser1['cancel_reason']?>"  >
                                                    </div>
                                                    
                              </div>
                              <!-- /.box-body -->
                
                              <div class="box-footer">
                                <input type="submit" name="add" class="btn btn-primary" value="Submit"/>
                              </div>
                            </form>
                          </div>
                          <!-- /.box -->
                    
                    
                </div>
                
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

</body>
</html>