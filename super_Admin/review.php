<?php include('config.php');?>
<?php 
  if(!isset($_SESSION['id']))  
       {
       	echo "<script>window.location.href='index.php';</script>";
	} ?><!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Review</title>
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

.date-name .fully-date .end-date {
    width: 29% !important;
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
.start-date {
    width: 30%;
    text-align: left;
}
.date-name .fully-date .start-date input#start {
    width: 100%;
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
    margin-top: 6% !important;
    margin-left: -37% !important;
}
/**/

@media screen and (min-width: 320px) and (max-width: 768px){
  .date-name .fully-date {
    display: block !important;
    width: 100% !important;
}
  .select-taxi {
    width: 100% !important;
    padding-left: 0% !important;
}
 .date-name .fully-date .start-date {
    width: 90% !important;
    text-align: left;
    padding-left: 16px;
} 
 .date-name .fully-date .end-date {
    width: 87% !important;
    text-align: left;
} 
 .date-name .fully-date .end-date {
    width: 91% !important;
    text-align: left;
    padding-left: 16px;
}
.fully-headings .date-submit {
    width: 40% !important;
    text-align: left;
    margin: 13px 24px 15px 0px !important;
    float: left;
}
.callout {
    margin: 0 0 0px 0 !important;
}
.date-name .fully-date .start-date {
    width: 29%;
    text-align: right;
}
.date-name .fully-date .start-date input#start {
    width: 100% !important;

}
.date-name .fully-date .start-date {
    width: 95% !important;
}
.date-name .fully-date .end-date {
    width: 100% !important;

}
.date-name .fully-date .end-date input#start {
    width: 94% !important;
}
}
/**/
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
         <h1> DRIVER RATINGS</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
             
      <div style="padding: 0 12px 0 12px;"> <!-----div main---->
                   <div class="box">
            <div class="box-header">
                <div class="callout callout-danger" style="background-color: #ff6633 !important;">
                    <?php
                    //for rating count    
                    $artd = mysqli_query($con, "select avg(driver_rated) as rate from tbl_rating ");
                    $artdd = mysqli_fetch_assoc($artd);
                    $rat1= $artdd['rate'];
                    $rat=number_format((float)$rat1, 1, '.', '');
                    $restaurent_avg_rating = $rat;
                    //total count
                    $select_count = mysqli_query($con, "SELECT * FROM tbl_rating ");
                    $count = mysqli_num_rows($select_count);
                    $msg['total_review'] = $count;
                    ?>
                    <!--<div class="float-right">-->
                      <h5>Average Rating : <span style="color: #F7DA0D;"><i class="fa fa-star" aria-hidden="true"></i></span><span><?php echo  $restaurent_avg_rating;?></span></h5> 
                   <!-- </div>-->
                </div>
            </div>
            <!-- /.box-header -->
            
            <div class="rating-review">
                 <form method="post" enctype="multipart/form-data">
                    <div class="fully-headings">
                        <div class="date-name">
                            <div class="fully-date ">
                                <div class="select-taxi">
                                    <lable style="margin-right: 59% ;">Select Driver </lable>
                                    <select name="driver_id" id="taxi">
                                       <option value="" >Select Driver Name</option>
                                       <?php   
                                        $date11 = date('Y-m-d');
                                        $sql="SELECT * FROM Drivers ORDER BY DriverID DESC";
                                        $res=mysqli_query($con,$sql);
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['DriverID'];
                                            $name =$row['FirstName']." ".$row['LastName'];
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $name ?></option>
                                        <?php } ?>
                                  </select>
                            </div>
                                <div class="start-date">
                                    <lable style="margin-right: 78%;">Start Date </lable>
                                    <input type="date" name="start" value="" id="start" min="2011-01-01" max="2050-12-31"> 
                                </div>
                                <div class="end-date">
                                     <lable style="margin-right: 70%;">End Date</lable>
                                     <input type="date" name="end" value="" id="start" min="2011-01-01" max="2050-12-31">   
                                </div>
                                <div class="date-submit">
                                   <input type="reset" name="reset" class="form-control" value="Clear" style="background-color: #e51b0a;border: #e51b0a;color: black;">
                                </div>
                                <div class="date-submit">
                                  <input type="submit" name="submit" class="form-control" value="Send Request" style="background-color: #ff6633;border: #ff6633;color: black;">
                                </div>
                               
                                <script>
                                    document.getElementById('start').value = moment().format('YYYY-MM-DD');
                                </script>
                            </div>
                            
                        </div>
 
                             </div>
                           </form>
     
            </div>
            
            
            
            
            
            <div class="box-body">
                <div class="table-responsive">
      
      
                            <div class="nav-tabs-custom">
                                <!--<ul class="nav nav-tabs">-->
                                <!--  <li class="active"><a href="#tab_1" data-toggle="tab">Driver</a></li>-->
                                  <!--<li><a href="#tab_2" data-toggle="tab">User</a></li>-->
                                <!--</ul>-->
                                <div class="tab-content">
                                  <div class="tab-pane active" id="tab_1">
                                                   <table id="example1" class="table table-bordered table-striped ">
                                                        <thead>
                                                        <tr>
                                                          <th style="width: 50px;">S. No.</th>
                                                          <th>Ride Number</th>
                                                          <!--<th>Company Name</th>-->
                                                          <th>Driver Name</th>
                                                          <th>Rider Name</th>
                                                          <th>Driver App Rating</th>
                                                          <th>Date</th>
                                                           <th>Time</th>
                                                          <th>Comment</th>
                                                          <!--<th>Delete</th>-->
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                        if(isset($_POST['submit']) && !empty($_POST['submit']))
                                                        { 
                                                            $user_id = $_POST['driver_id'];
                                                            $date1 = $_POST['start'];
                                                            $date2 = $_POST['end']; 
                                                            if($user_id!="" && $date1!="" && $date2!="" ) 
                                                            {
                                                                $sql="SELECT * FROM tbl_rating WHERE driver_id='$user_id' AND STR_TO_DATE(date, '%Y-%m-%d') BETWEEN STR_TO_DATE('$date1', '%Y-%m-%d') AND STR_TO_DATE('$date2', '%Y-%m-%d') ORDER BY rate_id desc";
                                                                $res=mysqli_query($con,$sql);
                                                            }
                                                            elseif($user_id!="" && $date1=="" && $date2=="") 
                                                            { 
                                                                $sql="SELECT * FROM tbl_rating WHERE driver_id='$user_id' ORDER BY rate_id desc";
                                                                $res=mysqli_query($con,$sql);
                                                            } 
                                                            elseif($user_id!="" && $date1!="" && $date2=="") 
                                                            {
                                                               $sql="SELECT * FROM tbl_rating WHERE driver_id='$user_id' AND STR_TO_DATE(date, '%Y-%m-%d') = STR_TO_DATE('$date1', '%Y-%m-%d') ORDER BY rate_id desc";
                                                               $res=mysqli_query($con,$sql);
                                                            }
                                                            elseif($user_id!="" && $date1=="" && $date2!="") 
                                                            {
                                                                $sql="SELECT * FROM tbl_rating WHERE driver_id='$user_id' AND STR_TO_DATE(date, '%Y-%m-%d') = STR_TO_DATE('$date2', '%Y-%m-%d') ORDER BY rate_id desc";
                                                                $res=mysqli_query($con,$sql);
                                                             } 
                                                            $count=0;
                                                            while($row=mysqli_fetch_assoc($res))
                                                            {
                                                                $sql1=mysqli_query($con,"SELECT * FROM Drivers WHERE DriverID='".$row['driver_id']."'");
                                                                $res1=mysqli_fetch_assoc($sql1);
                                                                $d_name=$res1['FirstName']." ".$res1['LastName'];
                                                                
                                                                $sql2=mysqli_query($con,"SELECT * FROM user_register WHERE id='".$row['user_id']."'");
                                                                $res2=mysqli_fetch_assoc($sql2);
                                                                
                                                            ?>
                                                            <tr>
                                                              <td><?php echo ++$count;?></td>
                                                              <td><?php echo $row['booking_id'];?></td>
                                                              <!--<td><?php echo $res3['fullname'];?> </td>-->
                                                              <td><?php echo $d_name;?> </td>
                                                              <td><?php echo $res2['full_name']." ".$res2['middle_name']." ".$res2['sur_name'];?> </td>
                                                              <td><?php echo $row['driver_rated'];?></td>
                                                              <td><?php echo $row['date'];?></td>
                                                              <td><?php echo $row['time'];?></td>
                                                              <td><?php echo $row['u_feedback_to_driver'];?></td>
                                                            </tr>
                                                        <?php } 
                                                            
                                                        }
                                                        else 
                                                        {
                                                            $sql="SELECT * FROM tbl_rating ORDER BY rate_id desc";
                                                            $res=mysqli_query($con,$sql);
                                                          //  echo mysqli_num_rows($res);
                                                            $count=0;
                                                            while($row=mysqli_fetch_assoc($res))
                                                            {
                                                                $sql1=mysqli_query($con,"SELECT * FROM Drivers WHERE DriverID='".$row['driver_id']."'");
                                                                $res1=mysqli_fetch_assoc($sql1);
                                                                $d_name=$res1['FirstName']." ".$res1['LastName'];
                                                                
                                                                $sql2=mysqli_query($con,"SELECT * FROM user_register WHERE id='".$row['user_id']."'");
                                                                $res2=mysqli_fetch_assoc($sql2);
                                                                
                                                            ?>
                                                            <tr>
                                                              <td><?php echo ++$count;?></td>
                                                              <td><?php echo $row['booking_id'];?></td>
                                                              <!--<td><?php echo $res3['fullname'];?> </td>-->
                                                              <td><?php echo $d_name;?> </td>
                                                              <td><?php echo $res2['full_name']." ".$res2['middle_name']." ".$res2['sur_name'];?> </td>
                                                              <td><?php echo $row['driver_rated'];?></td>
                                                              <td><?php echo $row['date'];?></td>
                                                              <td><?php echo $row['time'];?></td>
                                                              <td><?php echo $row['u_feedback_to_driver'];?></td>
                                                            </tr>
                                                        <?php }} ?>
                                                        </tbody>
                                                        
                                                      </table>
                                    
                                    
                                  </div>
                                </div>
                                <!-- /.tab-content -->
                              </div>
          
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



</body>
</html>