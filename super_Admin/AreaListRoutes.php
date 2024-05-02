<?php include('config.php');
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
  <title>List of Routes</title>
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
    left: 0px;
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
   
* {
		margin: 0;
		padding: 0;
		font-family: 'Oswald', sans-serif;
	}
	
	body {
		background: url(../images/texture_old_map.png);
	}
	
	.content {
		width: 100%;
	/*	margin: 50px auto;*/
		padding: 20px;
	}
	.content h1 {
		font-weight: 400;
		text-transform: uppercase;
		margin: 0;
	}
	.content h2 {
		font-weight: 400;
		text-transform: uppercase;
		color: #333;
		margin: 0 0 20px;
	}
	.content p {
		font-size: 1em;
		font-weight: 300;
		line-height: 1.5em;
		margin: 0 0 20px;
	}
	.content p:last-child {
		margin: 0;
	}
	.content a.button {
		display: inline-block;
		padding: 10px 20px;
		background: #ff0;
		color: #000;
		text-decoration: none;
	}
	.content a.button:hover {
		background: #000;
		color: #ff0;
	}
	.content.title {
		position: relative;
		background: none;
		border: 2px dashed #333;
	}
	.content.title h1 span.demo {
		display: inline-block;
		font-size: .5em;
		padding: 5px 10px;
		background: #000;
		color: #fff;
		vertical-align: top;
		margin: 7px 0 0;
	}
	.content.title .back-to-article {
		position: absolute;
		bottom: -20px;
		left: 20px;
	}
	.content.title .back-to-article a {
		padding: 10px 20px;
		background: #f60;
		color: #fff;
		text-decoration: none;
	}
	.content.title .back-to-article a:hover {
		background: #f90;
	}
	.content.title .back-to-article a i {
		margin-left: 5px;
	}
	.content.white {
		background: #fff;
		box-shadow: 0 0 10px #999;
	}
	.content.black {
		background: #000;
	}
	.content.black p {
		color: #999;
	}
	.content.black p a {
		color: #08c;
	}
	
	.accordion-container {
		width: 100%;
		margin: 0 0 20px;
		clear: both;
	}
	.accordion-toggle {
    position: relative;
    display: block;
    padding: 8px;
    font-size: 1.5em;
    font-weight: 300;
    background: #f5a62f;
    color: #fff;
    text-decoration: none;
}
	.accordion-toggle.open {
		background: #333;
		color: #fff;
	}
	
	a:focus, a:hover {
    color: #000;
    text-decoration: none;
}
	.accordion-toggle:hover {
		background: #fedc01;
	}
	.accordion-toggle span.toggle-icon {
	position: absolute;
    top: 10px;
    right: 14px;
    font-size: 1.5em;
	}
	.accordion-content {
		display: none;
		padding: 20px;
		overflow: auto;
	}
	.accordion-content img {
		display: block;
		float: left;
		margin: 0 15px 10px 0;
		max-width: 100%;
		height: auto;
	}
	
	/* media query for mobile */
	@media (max-width: 767px) {
		.content {
			width: auto;
		}
		.accordion-content {
			padding: 10px 0;
			overflow: inherit;
		}
	}

</style>   
    
</style>
<script src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckeditor/plugins/lite/lite-interface.js"></script>
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
        ADD ROUTES DETAILS 
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
                <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                   <div class="row">
                       <div class="col-md-12">
                           <!-- Custom Tabs -->
                            <?php
                                       //include('resize_customer.php');
                                       if(isset($_POST['submit']) && !empty($_POST['submit']))
                                        {
                                            $city1=$_POST['FromArea'];
                                            $sq1=mysqli_query($con,"SELECT * FROM AreaList WHERE AreaID  ='$city1'");
                                            $row1=mysqli_fetch_assoc($sq1);
                                            $city1_name=$row1['AreaName']; 
                                            $ZipCode1=$row1['ZipCode']; 
                                            
                                            $city2=$_POST['ToArea'];
                                            $sq2=mysqli_query($con,"SELECT * FROM AreaList WHERE AreaID  ='$city2'");
                                            $row2=mysqli_fetch_assoc($sq2);
                                            $city2_name=$row2['AreaName']; 
                                            $ZipCode2=$row1['ZipCode'];
                                            
                                            $select = mysqli_query($con,"SELECT * FROM AreaFromTo WHERE (FromArea='$city1_name' AND ToArea='$city2_name')");
                                            $count = mysqli_num_rows($select);
                                            
                                            $Price1=$_POST['Price1'];
                                            $Price2=$_POST['Price2']; 
                                            $Price3=$_POST['Price3'];
                                            $Price4=$_POST['Price4'];
                                            $RouteID=$_POST['RouteID'];
                                          
                                             
                                            date_default_timezone_set('Asia/Kolkata');
                                            $date=date('Y-m-d');
                                            $time = date('h:i A'); 
                                            
                                            // if($city1_name == $city2_name)
                                            // {
                                            //     $perr="From Area and To Area  can not be same";
                                            //     echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            //     echo'<script>window.location="AreaListRoutes.php";</script>';  
                                            // }
                                            // else
                                            // {
                                                if($count>0)
                                                {
                                                    $perr="This data already added";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                    echo'<script>window.location="AreaListRoutes.php";</script>';  
                                                }
                                                else
                                                {
                                                    $insert=mysqli_query($con,"INSERT INTO `AreaFromTo`(`RouteID`, `FromArea`, `fromZipcode`, `ToArea`, `toZipcode`, `Enabled`, `Price1`, `Price2`, `Price3`, `Price4`)
                                                                                                 VALUES('$RouteID','$city1_name','','$city2_name','','1','$Price1','$Price2','$Price3','$Price4')");
                                                   // die(mysqli_error($con));
                                                    $insert_id=mysqli_insert_id($con);
                                                    if($insert)
                                                    {
                                                        $perr="Inserted Successfully!";
                                                      //  echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                         echo'<script>window.location="AreaListRoutes.php";</script>';  
                                                    }
                                                    else
                                                    {
                                                        $perr="Insert Unsuccess";
                                                        echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                    }
                                                }
                                            //}
                                            
                                        }
                                    ?>
                           
                                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                                    <div class="form-group" col-md-12>
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="name">Route ID</label>
                                            <input type="text" name="RouteID" class="form-control" id="emailInput"  placeholder="Route ID" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="name">From Area</label>
                                            <select name="FromArea" class="form-control required" required>
                                                <option value="" selected="selected">Select From Area </option>
                                                <?php
                                                  $sql="SELECT * FROM AreaList WHERE Enabled='1'";
                                                  $res=mysqli_query($con,$sql);
                                                  while($row=mysqli_fetch_assoc($res))
                                                         { 
                                                          $id=$row['AreaID'];
                                                          $car=$row['AreaName'];
                                                          echo "<option value=$id>$car</option>";
                                                         } 
                                               ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="name">To Area </label>
                                            <select name="ToArea" class="form-control required" required>
                                                <option value="" selected="selected">Select To Area</option>
                                                <?php
                                                  $sql="SELECT * FROM AreaList WHERE Enabled='1'";
                                                  $res=mysqli_query($con,$sql);
                                                  while($row=mysqli_fetch_assoc($res))
                                                         { 
                                                          $id=$row['AreaID'];
                                                          $car=$row['AreaName'];
                                                          echo "<option value=$id>$car</option>";
                                                         } 
                                               ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="name">Mini Package Price</label>
                                        <input type="number" min='1' name="Price1" class="form-control required"  placeholder="Mini Package Price" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="name">Small Package Price</label>
                                        <input type="number" min='1' name="Price2" class="form-control required"  placeholder="Small Package Price 2" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="name">Large Package Price</label>
                                        <input type="number" min='1' name="Price3" class="form-control required"  placeholder="Large Package Price" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="name">Extra Large Package Price</label>
                                        <input type="number" min='1' name="Price4" class="form-control required"  placeholder="Extra Large Package Price" required>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit"/ style="width:13%; margin-top: 15px;">
                                </form>
                            </div>                 
                        </div>
               <br><br>
                <section class="content-header">
                  <h2>LIST OF ROUTES</h2>
                </section>
                        <div class="table-responsive">
                             <table id="example1" class="table table-bordered table-striped ">
                                  <thead>
                                        <tr>
                                            <th style="width: 50px;">S. No.</th>
                                            <th>Route ID</th>
                                            <th>From Area Name</th>
                                            <!--<th>From Area Zipcode</th>-->
                                            <th>To Area Name</th>
                                            <!--<th>To Area Zipcode</th>-->
                                            <th>Enabled</th>
                                            <th>Mini Package Price</th>
                                            <th>Small Package Price</th>
                                            <th>Large Package Price</th>
                                            <th>Extra Large Package Price</th>
                                            <th>Action</th>
                                        </tr>
                                  </thead>
                                  <tbody>
                                        <?php
                                                //  include('config.php');
                                                 $sql=mysqli_query($con,"select * from AreaFromTo ORDER BY id DESC");
                                                 $count=0;
                                                 while($data=mysqli_fetch_assoc($sql))
                                                 {
                                            ?>
                                        <tr>
                                           <td><?php echo ++$count;?></td>
                                           <td><?php echo $data['RouteID'];?></td>
                                           <td><?php echo ucfirst($data['FromArea']);?></td>
                                           <!--<td><?php echo $data['fromZipcode'];?></td>-->
                                           <td><?php echo ucfirst($data['ToArea']); ?></td>
                                           <!--<td><?php echo $data['toZipcode'];?></td>-->
                                           <td><?php echo $data['Enabled'];?></td>
                                           <td><?php echo $data['Price1'];?></td>
                                           <td><?php echo $data['Price2'];?></td>
                                           <td><?php echo $data['Price3'];?></td>
                                           <td><?php echo $data['Price4'];?></td>
                                           <td><div class="dropdown">
                                                <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;"></button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="EditAreaListRoutes.php?id=<?php echo $data['id']?>" data-toggle="tooltip" title="edit"><img src="dist/img/edit.png" style="width:30px;height:30px;"></a></li>
                                                  <li><a href="AreaListRoutes.php?aid=<?php echo $data['id']?>" data-toggle="tooltip" title="active"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li>
                                                  <li><a href="AreaListRoutes.php?did=<?php echo $data['id']?>" data-toggle="tooltip" title="inactive"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                                                   <li><a href="AreaListRoutes.php?fdid=<?php echo $data['id']?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
                                                </ul>
                                          </div></td>
                                     </tr>
                                    <?php } ?>
                                  </tbody>
                            </table>
                        </div>
                    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
  
<?php
        if($_GET['fdid'])
        {
            $fdid=$_GET['fdid'];
            $del=mysqli_query($con,"delete from AreaFromTo WHERE id='$fdid'");
            if($del)
            {
                $perr1="Deleted Successfully!";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>';   
            }
            else
            {
                $perr1="Unable to delete ! Please try again";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>'; 
            }
        }
        
        if($_GET['did'])
        {
            $did=$_GET['did'];
            $del=mysqli_query($con,"UPDATE AreaFromTo  SET Enabled='0' WHERE id='$did'");
            if($del)
            {
                $perr1="Disabled Successfully!";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>';   
            }
            else
            {
                $perr1="Unable to Disable ! Please try again";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>'; 
            }
        }
        
        
        if($_GET['aid'])
        {
            $aid=$_GET['aid'];
            $del=mysqli_query($con,"UPDATE AreaFromTo  SET Enabled='1' WHERE id='$aid'");
            if($del)
            {
                $perr1="Enabled Successfully!";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>';   
            }
            else
            {
                $perr1="Unable to Enable ! Please try again";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="AreaListRoutes.php";</script>'; 
            }
        }
    ?>  
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