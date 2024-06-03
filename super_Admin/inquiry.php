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
  <title>Admin Support</title>
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
    top: -50%;
    left: -25px;
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
  .intl-tel-input.allow-dropdown {
    width: 100%;
}  
th {
    background-color: black;
    color: white;
}
.pull-left input {
    width: 80%;
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
        ADMIN SUPPORT
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <!--<h3 class="box-title">Admin Support</h3>-->
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            if(isset($_POST['add']))
                            {
                                $nm=$_POST['name'];
                                $em=$_POST['email'];
                                $sb=$_POST['con'];
                                $sq=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin'");
                                $row=mysqli_fetch_assoc($sq);
                                $roew=mysqli_num_rows($sq);
                                $ee=$row['email'];
                                $cn=$row['contact'];
                                $iid=$row['id'];
                                if($roew > 0)
                                {
                                $up=mysqli_query($con,"UPDATE inquiry_table SET `email`='$em',`contact`='$sb' WHERE id='$iid'"); 
                                if($up)
                                {
                                    $perr="Updated Successfully!";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                else
                                {
                                    $perr="Inserted Successfully!";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                }
                                else
                                {
                                $sql=@mysqli_query($con,"INSERT INTO inquiry_table(`email`,`contact`,type)VALUES('$em','$sb','Admin')");
                               // die(mysqli_error($con));
                                if($sql)
                                {
                                    $perr="Inserted Successfully!s";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                else
                                {
                                    $perr="Insert Unsuccess";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                                           
                            }
                            }
                            ?>
            
                              <div class="box-body">
                                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                                <div class="row">
                                   <div class="form-group col-md-6">
                                        <label class="control-label" for="name">Support Email</label>
                                        
                                        <input type="email" name="email" style="width: 100%;" class="form-control" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" placeholder="Email" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="name">Support Contact</label><br>
                                         <input  type="number" id="phone" name="con"  min='1'  class="form-control" placeholder="Phone Number" required>
                                        <!--<input type="number" name="con" class="form-control" placeholder=" Contact" required>-->
                                    </div>
                                
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
                
                
            <div style="padding: 0 12px 0 12px;"> <!-----div main---->    
                
        <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th style="width: 100px;">S. No.</th>
                  
                  <th>Support Email</th>
                  <th>Support Contact</th>
                  
                </tr>
                </thead>
                <tbody>
                    <?php
                        $sqls=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin'");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sqls))
                        {
                        ?>
                <tr>
                  <td><?php echo ++$count;?></td>
                 
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo  $row['contact'];?></td>
                 </tr>
               <?php }?>
                </tbody>
                
              </table>
            </div>
            </div>
            <!-- /.box-body --
          </div>
          <!-- /.box --
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="build1/js/intlTelInput.js"></script>
 <script>
$(function() {
$("#phone").intlTelInput({
allowExtensions: true,
autoFormat: false,
autoHideDialCode: false,
autoPlaceholder: false,
defaultCountry: "auto",
ipinfoToken: "yolo",
nationalMode: false,
numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//preferredCountries: ['cn', 'jp'],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build1/utils.js"
});
});
</script>
<link rel="stylesheet" href="build1/css/intlTelInput.css">
  <link rel="stylesheet" href="build1/css/demo.css">
</body>
</html>