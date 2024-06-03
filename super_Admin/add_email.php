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
  <title>Admin Email</title>
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
        ADMIN EMAIL
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
                                $nm=$_POST['name'];
                                $em=$_POST['email'];
                                $sb=$_POST['con'];
                                $sq=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin_new'");
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
                                    $perr="Insert Unsuccess";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                                }
                                else
                                {
                                $sql=@mysqli_query($con,"INSERT INTO inquiry_table(`email`,`contact`,type)VALUES('$em','$sb','Admin_new')");
                               // die(mysqli_error($con));
                                if($sql)
                                    {
                                        $perr="Inserted Successfully!";
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
                                <form role="form" method="post" class="validate" enctype="multipart/form-data" id="emailForm">
                    
                               <div class="form-group">
                                    <label class="control-label" for="name">Support Email</label>
                                    
                                    <input type="email" name="email" class="form-control" id="emailInput" onkeyup="validateEmail()"  onblur="clearEmailField()" placeholder="Email" required>
                                    <div id="errorText" style="color: red;"></div>
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
                  
                  <th>Email</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                    <?php
                        $sqls=mysqli_query($con,"SELECT * FROM inquiry_table WHERE type='Admin_new'");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sqls))
                        {
                        ?>
                <tr>
                  <td><?php echo ++$count;?></td>
                 
                  <td><?php echo $row['email'];?></td>
                  <td><a href="add_email.php?fdid=<?php echo $row['id']?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></td>
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
            $del=mysqli_query($con,"delete from inquiry_table where id='$fdid'");
            if($del)
            {
                $perr1="Email is deleted successfully!";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="add_email.php";</script>';   
            }
            else
            {
                $perr1="Unable to delete ! Please try again";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="add_email.php";</script>'; 
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
  <script language="JavaScript">
 function validateEmail() {
    var emailInput = document.getElementById('emailInput');
    var errorText = document.getElementById('errorText');
    var emailForm = document.getElementById('emailForm');

    var email = emailInput.value;
    var emailParts = email.split('@');
    errorText.textContent = ""; // Clear any previous error message
    emailForm.onsubmit = null; // Clear previous submit event handler

    if (emailParts.length !== 2) {
      errorText.textContent = "Email must contain a single '@' symbol";
    } else if (emailParts[0] !== emailParts[0].toLowerCase()) {
      errorText.textContent = "All letters must be in lowercase";
    } else if (/[^a-z0-9._%+-]/.test(emailParts[0])) {
      errorText.textContent = "Special characters are not allowed in the local part";
    } else {
      // Extract the domain part of the email (after '@')
      var domain = emailParts[1].toLowerCase();

      // Add validation for supported email domains
      var supportedDomains = ['gmail.com', 'yahoo.com', 'outlook.com']; // Add more as needed

      if (supportedDomains.indexOf(domain) === -1) {
        errorText.textContent = "Unsupported email domain. Please use Gmail, Yahoo, or Outlook.";
      } else {
        emailForm.onsubmit = function() {
          // alert("Form submitted successfully");
          return true;
        };
      }
    }
  }

function clearEmailField() {
  var emailInput = document.getElementById('emailInput');
  var errorText = document.getElementById('errorText');

  if (errorText.textContent !== "") {
    emailInput.value = ""; // Clear the email input field
  }
}
</script>