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
  <title>Add Package Type</title>
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
        <a href="view_package.php"><button type="button" class="btn btn-info" style="float: right;margin: 13px;">BACK TO LISTING</button></a>
      <h1>
        ADD PACKAGE TYPE
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <!--<h3 class="box-title">Add Vehicle Type</h3>-->
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                           <?php
                                        //include('resize_carimg.php');
                                        if(isset($_POST['add']) && !empty($_POST['add']))
                                        {
                                            $package_name=$_POST['package_name'];
                                            $capacity=$_POST['capacity'];
                                            $service_charge=$_POST['service_cahrge'];
                                            $size=$_POST['size'];
                                            $c_type=$_POST['car_type'];
                                            $c_seat=$_POST['max_seat'];
                                            $admin_commission = $_POST['admin_commission'];
                                            $car_extra_charges=$_POST['car_extra_charges'];
                                        
                                            $filename=$_FILES["image"]["name"];
                                            $type=$_FILES["image"]["type"];
                                            $tmpname=$_FILES["image"]["tmp_name"];
                                            $ext=substr($filename,strpos($filename,"."));
                                            $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
                                            $finame=substr(str_shuffle($str),5,10)."_".time().$ext;
                                            if(move_uploaded_file($tmpname,"../car_img/$finame"));
                                             
                                            $query=mysqli_query($con,"INSERT INTO `tbl_package`(`package_name`, `capacity`, `image`, `size`, `service_charge`, `status`) 
                                            VALUES ('$package_name','$capacity','$finame','$size','$service_charge','Approve')");
                                            if($query)
                                            {
                                                $perr="Package added successfully";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                            else
                                            {
                                                $perr="Insert Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                         }
                                       ?>
                              <div class="box-body">
                                                 <form role="form" method="post" class="validate" enctype="multipart/form-data">
                                    
                                                    <!--  <div class="form-group">-->
                                                    <!--    <label class="control-label" for="name">Name</label>-->
                                                    <!--    <input type="text" name="car_nam" class="form-control required" placeholder=" Name"required>-->
                                                    <!--</div>-->
                                                     <div class="form-group">
                                                        <label class="control-label" for="name">Package Name</label>
                                                        <input type="text" name="package_name" class="form-control required" placeholder="Package Name"required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Package Capacity</label>
                                                        <input type="number" name="capacity" class="form-control required" placeholder="Package Capacity" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Package Size</label>
                                                        <input type="text" name="size" class="form-control required" placeholder="Package Size" required>
                                                    </div>
                                                    <!--<div class="form-group">-->
                                                    <!--    <label class="control-label" for="name">Package Charge</label>-->
                                                    <!--    <input type="number" name="service_charge" class="form-control required" placeholder="Package Charge"required>-->
                                                    <!--</div>-->
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label" for="image">Image</label>
                                                        <input type="file"  name="image" id="image" onchange="validateImage(this)" class="required"class size="20" required/>
                                                        <div id="image_req" style="color: red"></div>
                                                    </div>
                                                               <!---IMAGE VALIDATE-------->
                                                                
                                                                <script language="JavaScript">
                                                                var formOK = false;
                                                                
                                                                function validateImage(objFileControl){
                                                                 var file = objFileControl.value;
                                                                 var len = file.length;
                                                                 var ext = file.slice(len - 4, len);
                                                                 if(ext == ".jpg"  || ext == ".JPG"){
                                                                   formOK = true;
                                                                 }
                                                                 else if(ext == ".png"){
                                                                     formOK = true;
                                                                 }
                                                                 else if(ext == ".PNG"){
                                                                     formOK = true;
                                                                 }
                                                                 else if(ext == ".JPEG" || ext == ".JPEG"){
                                                                     formOK = true;
                                                                 }
                                                                 else{
                                                                   formOK = false;
                                                                   alert("Only image files allowed.");
                                                                   location.reload();
                                                                 }
                                                                }
                                                                </script>
                                                                <!---IMAGE VALIDATE-------->
                                                                
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