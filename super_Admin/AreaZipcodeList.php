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
  <title>Area Zip Code List</title>
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
       AREA ZIP CODE LIST
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <!-- form start -->
                            <?php
                            if(isset($_POST['add']))
                            {
                                $AreaID=$_POST['AreaName'];
                                $sq=mysqli_query($con,"SELECT * FROM AreaList WHERE AreaID ='$AreaID'");
                                $row=mysqli_fetch_assoc($sq);
                                
                                $AreaName=$row['AreaName'];
                                $ZipCode =$_POST['ZipCode'];
                             
                            
                                $sq=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode ='$ZipCode'");
                                $row=mysqli_fetch_assoc($sq);
                                $roew=mysqli_num_rows($sq);
                                if($roew > 0)
                                {
                                    $perr="This ZipCode already added!";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                else
                                {
                                    $sql= mysqli_query($con,"INSERT INTO `AreaZipCodes`(ZipCode,`AreaName`) VALUES('$ZipCode','$AreaName')");
                                  //die(mysqli_error($con));
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
                               <select  name="AreaName" class="form-control" required>
                                   <option value=""> Select Area Name</option>
                                  <?php
                                      $sql="SELECT * FROM AreaList WHERE Enabled ='1'";
                                      $res=mysqli_query($con,$sql);
                                      while($row=mysqli_fetch_assoc($res))
                                      { 
                                        $name=$row['AreaName'];
                                        $AreaID = $row['AreaID'];
                                        ?>
                                       <option value=<?php echo $AreaID ?>><?php echo $name ?></option>
                                   <?php   } 
                                   ?>
                                </select>
                             </div>
                             <div class="form-group">
                                <label class="control-label" for="name">Zip Code</label>
                                <input type="number" name="ZipCode" class="form-control" id="emailInput"  placeholder="Zip Code" required>
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
                      <th>Zip Code</th>
                      <th>Area Name</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sqls=mysqli_query($con,"SELECT * FROM AreaZipCodes ORDER BY id DESC");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sqls))
                        {
                        ?>
                    <tr>
                      <td><?php echo ++$count;?></td>
                      <td><?php echo $row['ZipCode'];?></td>
                      <td><?php echo ucfirst($row['AreaName']);?></td>
                      <td><a href="AreaZipcodeList.php?fdid=<?php echo $row['ZipCode']?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></td>
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
    
    if($_GET['fdid'])
    {
        $fdid=$_GET['fdid'];
        $del=mysqli_query($con,"delete from AreaZipCodes WHERE ZipCode ='$fdid'");
        if($del)
        {
            $perr1="Deleted successfully!";
            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
            echo'<script>window.location="AreaZipcodeList.php";</script>';   
        }
        else
        {
            $perr1="Unable to delete ! Please try again";
            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
            echo'<script>window.location="AreaZipcodeList.php";</script>'; 
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