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
  <title>Add Area</title>
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
       ADD AREA
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <!--<div class="box-header with-border">-->
                            <!--  <h3 class="box-title">Admin  Add Email</h3>-->
                            <!--</div>-->
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            if(isset($_POST['add']))
                            {
                                $AreaName1=$_POST['AreaName'];
                                $AreaName = strtolower($AreaName1);
                                
                                $sq=mysqli_query($con,"SELECT * FROM AreaList WHERE AreaName ='$AreaName'");
                                $row=mysqli_fetch_assoc($sq);
                                $roew=mysqli_num_rows($sq);
                                if($roew > 0)
                                {
                                    $perr="This Area Name already added!";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                else
                                {
                                    $sql= mysqli_query($con,"INSERT INTO `AreaList`(`AreaName`, `Enabled`) VALUES('$AreaName','0')");
                                    // die(mysqli_error($con));
                                    if($sql)
                                    {
                                        $perr="Inserted Successfully!";
                                       // echo "<script type='text/javascript'>alert(\"$perr\");</script>";
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
                        <form role="form" method="post" class="validate" enctype="multipart/form-data" id="emailForm">
                            <div class="form-group">
                                <label class="control-label" for="name">Area Name</label>
                                <input type="text" name="AreaName" class="form-control" id="emailInput"  placeholder="Area Name" required>
                             </div>
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
               <div class="box-header"> </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                      <th style="width: 100px;">S. No.</th>
                      <th>Area Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sqls=mysqli_query($con,"SELECT * FROM AreaList");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sqls))
                        {
                        ?>
                    <tr>
                      <td><?php echo ++$count;?></td>
                     
                      <td><?php echo ucfirst($row['AreaName']);?></td>
                       <td><?php if($row['Enabled']=='1'){ echo "1"; }elseif($row['Enabled']=='0'){echo "0" ;}?></td>
                        <td><div class="dropdown">
                         <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;">
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="AreaNameList.php?fdid=<?php echo $row['AreaID']?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
                          <li><a href="AreaNameList.php?aid=<?php echo $row['AreaID'];?>" data-toggle="tooltip" title="Enable"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li>
                          <li><a href="AreaNameList.php?did=<?php echo $row['AreaID'];?>" data-toggle="tooltip" title="Disable"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                        </ul>
                      </div></td>
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

      <?php
     if($_GET['aid'])
     {
            $id=$_GET['aid'];
            $delete="update AreaList set Enabled='1' WHERE AreaID='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                    $perr="Enabled Successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="AreaNameList.php";</script>';
              }
              else
              {
                    $perr="Unsuccess";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="AreaNameList.php";</script>';  
              }
    }
 ?>
<?php
     if($_GET['did'])
     {
            $id=$_GET['did'];
            $delete="update AreaList set Enabled='0' WHERE AreaID='$id'";
            $del=mysqli_query($con,$delete);
            if($del)
              {
                    $perr="Disabled Successfully!";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="AreaNameList.php";</script>';
              }
              else
              {
                    $perr="Unsuccess";
                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                    echo'<script>window.location="AreaNameList.php";</script>';  
              }
    }  
    
    if($_GET['fdid'])
    {
        $fdid=$_GET['fdid'];
        $del=mysqli_query($con,"delete from AreaList WHERE AreaID ='$fdid'");
        if($del)
        {
            $perr1="Deleted successfully!";
            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
            echo'<script>window.location="AreaNameList.php";</script>';   
        }
        else
        {
            $perr1="Unable to delete ! Please try again";
            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
            echo'<script>window.location="AreaNameList.php";</script>'; 
        }
    }
?>                
                
                
                
      
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