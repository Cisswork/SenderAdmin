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
  <title>View User</title>
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
  
th, td {
  padding-left: 30px;
  padding-right: 50px;
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
        USERS LIST
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
                
      <div style="padding: 0 12px 0 12px;"> <!-----div main---->      
                
                <div class="box">
            <div class="box-header">
              <a href="addcustomer.php"><button type="button" class="btn btn-info" style="float:right;">ADD USER</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th style="width: 50px;">S. No.</th>
                  
                  <th> Name</th>
                  <th>Email</th>
                  <!--<th>Password</th>-->
                  <th>Contact Info (Member ID)</th>
                   <!--<th>Address</th>-->
                   <th>Profile Photo</th>
                   <th>ID Proof Image</th>
                   <th>ID Proof Expiry Date</th>
                   <th>Wallet Balance</th>
                   <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                       $path="https://cisswork.com/Android/SenderApp/images/";
                        $def="https://cisswork.com/Android/SenderApp/super_Admin/logo (2).png";
                      //  $select=mysqli_query($con,"SELECT * FROM user_register ORDER BY id desc");
                        $select=mysqli_query($con,"SELECT * FROM user_register ORDER BY id desc");
                        $count=0;
                        While($row=mysqli_fetch_assoc($select))
                        {
                            
                        $id=$row['id'];
                        $status=$row['user_status']
                        ?>
                <tr>
                  <td><?php echo ++$count;?></td>
                  <td><?php echo $row['full_name'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <!--<td><?php echo $row['password'];?></td>-->
                  <td><?php echo $row['country_code'].$row['contact'];?></td>
                  <!--<td><?php echo $row['address'];?></td>-->
                  <td class="center"><img src="<?php 
                    $pay=$row['image'];
                    if($pay=='')
                    {
                     echo $def; 
                    }
                    else
                    {
                    echo $path.$pay;
                    }?>" height="100px" width="100px"> </td>
                  
                  <td class="center">
                    <?php  $imm= $row['id_proof_image'];
                        $last_3digit=substr($imm, -3);
                        $image11 =$path.$row['id_proof_image'];
                        if($last_3digit == 'PDF' || $last_3digit == 'pdf')
                    { ?>
                        <iframe src="<?php $pay3=$row['id_proof_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>" width="100px" height="100px"></iframe>
                        <a target="_blank" href="id_image.php?CCid=<?php echo $id;?>"><button>View in new tab</button> </a>
                         <!--<iframe src="https://docs.google.com/gview?url=<?php $pay3=$row['id_proof_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>&embedded=true" width="100px" height="100px"></iframe>-->
                    <?php } else {?>
                          <img src="<?php $pay3=$row['id_proof_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>" height="100px" width="100px">
                    <?php } ?>
                  </td>
                       <td><?php echo $row['id_expiry_date'];?></td>
                  <!--<td><img src="<?php echo $path.$row['image'];?>" height="100px" width="100"></td>-->
                  <td><?php echo $row['user_wallet'];?></td>
                  <td><?php if ($status == "Approve" ) {?>
                            
                                             <img src="dist/img/active.png" style="width:30px;height:30px;">  
                                       <?php }else { ?>
                                             <img src="dist/img/inactive.png" style="width:30px;height:30px;">  
                                       <?php } ?></td>
                  <td><div class="dropdown">
                <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="userdetails.php?id=<?php echo $id;?>" data-toggle="tooltip" title="Update"><img src="dist/img/edit-doc.png" style="width:30px;height:30px;"></a></li>
                            <!--li><a href="viewcustomer.php?id=<?php echo $id;?>" data-toggle="tooltip" title="View"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li-->
                            <?php if ($status == "Approve" ) {?>
                               <li><a href="viewcustomer.php?bid=<?php echo $id; ?>" data-toggle="tooltip" title="Disapprove"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                            <?php }else { ?>
                               <li><a href="viewcustomer.php?aid=<?php echo $id; ?>" data-toggle="tooltip" title="Approve"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li> 
                           <?php } ?>
                            <!--<li><a href="viewcustomer.php?aid=<?php echo $id; ?>" data-toggle="tooltip" title="Approve"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li>-->
                            <!--<li><a href="viewcustomer.php?bid=<?php echo $id; ?>" data-toggle="tooltip" title="Disapproved"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>-->
                            <li><a href="viewcustomer.php?id=<?php echo $id;?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
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
    if(isset($_GET['aid']))
    {
        $aid=$_GET['aid'];
        $select1=mysqli_query($con,"select * from user_register where id='$aid'");
        $selefetch=mysqli_fetch_assoc($select1);
        
        $record=mysqli_query($con,"update user_register set user_status='Approve' where id='$aid'");
        if($record)
        {
            
            $perr="User approved successfully!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewcustomer.php";</script>';
        }
       
        else
        {
            
            $perr="Sorry! Unable to approve";
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
          
            $perr="User disapproved successfully!";
            echo "<script type='text/javascript'>alert(\"$perr\");</script>";
            echo'<script>window.location="viewcustomer.php";</script>';
        }
        else
        {
            $perr="Sorry! Unable to disapprove";
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
                    $perr="User deleted successfully!";
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