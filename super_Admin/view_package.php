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
  <title>Package Management</title>
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
    left: -25px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 40px;
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
   .dropdown-menu>li>a {
    display: block;
    padding: 3px 4px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
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
      <h1> PACKAGE MANAGEMENT </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
        <div class="box">
            <div class="box-header">
                <a href="add_package.php"><button type="button" class="btn btn-info" style="float:right;">ADD PACKAGE</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th class="">S. NO.</th>
                    <th><center>Package Name</center></th>
                    <th><center>Package Capacity</center></th>
                    <th><center>Package Size</center></th>
                    <th><center>Image</center></th>
                    <th><center>Status</center></th>
                    <th><center>Actions</center></th>
    </tr>
                </tr>
                </thead>
                <tbody>
                     <?php
                     $path="https://cisswork.com/Android/SenderApp/car_img/";
                     $ipath="https://cisswork.com/Android/SenderApp/icon_images/";
                     
                      $sel=mysqli_query($con,"SELECT * FROM tbl_package order by id asc");
                      $count=0;
                      while($row=mysqli_fetch_assoc($sel))
                      { 
                      $id=$row['id'];
                      ?>
                <tr>
                  <td><?php echo ++$count;?></td>
                  <td><?php echo $row['package_name']; ?></td>
                  <td><?php echo $row['capacity']. " Kg"; ?></td>
                  <td><?php echo $row['size']; ?></td>
                  <td><img src="<?php echo $path.$row['image']; ?>" width="100" height="100"></td>
                  <td><?php if($row['status']=='Approve'){ echo "Approved"; }elseif($row['status']=='Disapprove'){echo "Disapproved" ;}?></td>
                  <td><div class="dropdown">
                  <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;">
                        </button>
                        <ul class="dropdown-menu">
                           <li><a href="edit_package.php?eid=<?php echo $id;?>" data-toggle="tooltip" title="Edit"><img src="dist/img/edit.png" style="width:30px;height:30px;"></a></li>
                           <li><a href="view_package.php?id=<?php echo $id;?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
                           <li><a href="view_package.php?aid=<?php echo $id;?>" data-toggle="tooltip" title="Approve"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li>
                           <li><a href="view_package.php?did=<?php echo $id;?>" data-toggle="tooltip" title="Disapprove"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                        </ul>
                      </div></td>
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
     if($_GET['aid'])
     {
            $id=$_GET['aid'];
            $delete="update tbl_package set status='Approve' WHERE id='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                    $perr="Approved Successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';
              }
              else
              {
                    $perr="Unsuccess";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';  
              }
    }
 ?>
          <?php
     if($_GET['did'])
     {
            $id=$_GET['did'];
            $delete="update tbl_package set status='Disapprove' WHERE id='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                    $perr="Disapproved Successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';
              }
              else
              {
                    $perr="Unsuccess";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';  
              }
    }
 ?>
         	<!----------Delete start---------------->
   <?php
     if($_GET['id'])
     {
            $id=$_GET['id'];
            $delete="DELETE FROM tbl_package WHERE id='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                    $perr="Package deleted successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';
              }
              else
              {
                    $perr="Delete Unsuccess";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="view_package.php";</script>';  
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
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>