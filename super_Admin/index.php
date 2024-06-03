<?php
include('config.php');

if(isset($_POST['submit']) && !empty($_POST['submit']))
{
       $name=$_POST['name']; $pass=$_POST['password'];
       
       $sql=mysqli_query($con,"SELECT * FROM admin WHERE username='$name' AND password='$pass'");
       $row=mysqli_fetch_assoc($sql);
       
       $uname=$row['username'];
       $password=$row['password']; 
     
       if($name==$uname && $pass==$password)
          {
             $_SESSION['id']=$row['id'];
            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60) ;
             //header('location:dashboard.php');
              echo "<script>window.location='dashboard.php'</script>";
          }
        else
          {
              $perr="Invalid Login";
              echo "<script type='text/javascript'>alert(\"$perr\");</script>";
          }
       
}
?>
<!------login Query End-------->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 22px;
    font-size: 16px;
}
.login-box-body, .register-box-body {
    background: #fff;
    padding: 18px;
    border-top: 0;
    color: #666;
        border-bottom: 6px solid #000000;
    border-top: 6px solid #000000;
}
   .nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
    position: relative;
    top: -14px;
} 
.login-box, .register-box {
    width: 334px;
    margin: 0% auto;
}
</style>


</head>
<body class="hold-transition login-page" style="background-image: url(dist/img/Untitled-2.png);background-repeat: no-repeat;background-size: cover;">
<br><br><br>
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  
  <!--- Begin Login --->

  <!--- Eng Login --->
  
  <div class="login-box-body" style="border-radius: 10px;">
     
      
      <div class="row">
          <div class="col-md-12">
              <div class="row">
                                        
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                  <center>
                  </center>
                  
                  <div class="tab-content">
                       <center> <a href="index.php"><img src="dist/img/Cerbr Logo@2x.png" style="width: 50%;"></a> </center>
                              <h3>Welcome To Website</h3>
                              <p>Log In To Continue</p>
                              <br>
                          <!-- <center><h2 style="margin-top: 0px;margin-bottom: 16px;">Cerber Admin Login</h2></center>-->
                      <div class="tab-pane active" id="tab_1">
                          <form  method="post" enctype="multipart/form-data">
                               <div class="form-group has-feedback">
                                   <label for="email">Super Administrator E-mail</label>
                                   <input type="text" class="form-control" placeholder="User Name" name="name" required>
                                   <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                               </div>
                               <div class="form-group has-feedback">
                                   <label for="password">Password</label>
                                   <input type="password" class="form-control" placeholder="Password" name="password" required>
                                   <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                               </div>
                               <div class="row">
                                   <div class="col-xs-4">
                                       <input type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 5px;font-size: 18px;" name="submit" value="Sign In">
                                   </div>
                                   <!-- /.col -->
                                   <div class="col-xs-8">
                                   </div>
                                   <!-- /.col -->
                                </div>
                          </form>
                      </div>
                      <!-- /.tab-pane -->
                      
                                
                      </div>
                      
                  <!-- /.tab-content -->
                  </div>
                                             
                <!-- nav-tabs-custom -->
                </div>
                          
            </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
