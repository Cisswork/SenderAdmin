<?php
     include('config.php');
     session_start();
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
  <title>Edit User</title>
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
    top: -117%;
    left: -37px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 37px;
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
.rating{
    color: red;
    padding: 7px 10px 6px 8px;
    border: 1px solid;
    border-color: black;
    width: 20%;
    text-align: center;
}
</style>

<script type="text/javascript">
        function Validatealphnum(txt) {
            txt.value = txt.value.replace(/[^a-zA-Z 0-9\n\r]+/g, '');
        }
    </script>

<script>
    function validateAlpha(){
    var textInput = document.getElementById("fname").value;
    textInput = textInput.replace(/[^A-Za-z ]/g, "");
    document.getElementById("fname").value = textInput;
}
    
</script>
<script>
    function validateAlpha1(){
    var textInput = document.getElementById("lname").value;
    textInput = textInput.replace(/[^A-Za-z ]/g, "");
    document.getElementById("lname").value = textInput;
}
    
</script>
<script>
    function validateAlpha2(){
    var textInput = document.getElementById("city").value;
    textInput = textInput.replace(/[^A-Za-z ]/g, "");
    document.getElementById("city").value = textInput;
}
    
</script>
<script>
    function validateAlpha3(){
    var textInput = document.getElementById("contry").value;
    textInput = textInput.replace(/[^A-Za-z ]/g, "");
    document.getElementById("contry").value = textInput;
}
    
</script>
<script>
    function validateAlpha4(){
    var textInput = document.getElementById("clr").value;
    textInput = textInput.replace(/[^A-Za-z ]/g, "");
    document.getElementById("clr").value = textInput;
}
    
</script>

<script>
    function validatenum(){
    var textInput = document.getElementById("year").value;
    textInput = textInput.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    document.getElementById("year").value = textInput;
}
    
</script>

<script>
    function validatenum1(){
    var textInput = document.getElementById("rs").value;
    textInput = textInput.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    document.getElementById("rs").value = textInput;
}
    
</script>


</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('header.php'); ?>
  <?php   include('sidebar.php');    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <a href="viewcustomer.php"><button type="button" class="btn btn-info" style="float: right;margin: 13px;">BACK TO LISTING</button></a>
      <h1>
        EDIT USER DETAILS
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
                                  <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_0" data-toggle="tab">User Information</a></li>
                                      <!--<li class=""><a href="#tab_1" data-toggle="tab">Car Information</a></li>-->
                                      <!--<li><a href="#tab_2" data-toggle="tab">Rating</a></li>-->
                                      <!--<li><a href="#tab_3" data-toggle="tab">Trip</a></li>-->
                                      <!--<li><a href="#tab_4" data-toggle="tab">User Cancel Request</a></li>-->
                                      <!-- <li><a href="#tab_41" data-toggle="tab">Driver Cancel Request</a></li>-->
                                      <!--<li><a href="#tab_5" data-toggle="tab">Complete Trip</a></li>-->
                                      <li><a href="#tab_6" data-toggle="tab">Total Payment</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_0">
                                           <?php
                                       include('resize_customer.php');
                                       if(isset($_GET['id']))
                                        {
                                          $path="https://cisswork.com/Android/SenderApp/images/";
                                          $def="https://cisswork.com/Android/SenderApp/super_Admin/logo (2).png";
                                          $id=$_GET['id'];
                                          $sql="SELECT * FROM user_register WHERE id='$id'";
                                          $sql_res=mysqli_query($con,$sql);
                                          $row=mysqli_fetch_assoc($sql_res);
                                          $id=$row['id'];
                                          $f_n=$row['full_name'];
                                          $code=$row['country_code'];
                                          $cn=$row['contact'];
                                          $em=$row['email'];
                                          $ps=$row['password'];
                                         // $add=$row['address'];
                                          $img=$row['image'];
                                          //$wo=$row['wrok'];
                                          
                                         if(isset($_POST['add']) && !empty($_POST['add']))
                                         {
                                             $firstname=$_POST['name'];
                                             $cd=$_POST['code'];
                                             $contact=$_POST['contact'];
                                             $em=$_POST['email'];
                                             $work=$_POST['work'];
                                             $password=$_POST['pass'];
                                        
                                            $image=$_FILES['image']['name'];
                                            $image1=$_FILES['image1']['name'];
                                          
                                            //$filename=$_FILES['image']['name'];
                                            $type=$_FILES['image']['type'];
                                            $size=$_FILES['image']['size'];
                                            $tmpname=$_FILES['image']['tmp_name'];
                                            $ext=substr($image,strpos($image,"."));
                                            $str="abcdefghijklmonpqrstuvwxyz1234567890";
                                            $fname=substr(str_shuffle($str),5,10)."_".time().$ext;  
                                             move_uploaded_file($tmpname,"../images/$fname");
                                            
                                            //$filename1=$_FILES['image1']['name'];
                                            $tmpname1=$_FILES["image1"]["tmp_name"];
                                            $ext1=substr($image1,strpos($image1,"."));
                                            $str1="ABCDEFGHijklmnopqrstuvwxyz0123456789";
                                            $fname1=substr(str_shuffle($str1),5,10)."_".time().$ext1;
                                            if(move_uploaded_file($tmpname1,"../images/$fname1"));
                                            $expiry_date=$_REQUEST['expiry_date'];
                                              
                                           if($image=="" && $image1=="")
                                           {
                                               $insert=mysqli_query($con,"UPDATE `user_register` SET `full_name`='$firstname',`email`='$em',password='$password',`country_code`='$cd',`contact`='$contact',id_expiry_date='$expiry_date' WHERE id='$id'");
                                               //die(mysqli_error($con));
                                               if($insert)
                                                {
                                                    $perr="User info updated successfully!";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                    echo'<script>window.location="viewcustomer.php";</script>';    
                                                }
                                                else
                                                {
                                                    $perr="Unsuccess";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                }
                                           }
                                           elseif($image!=""  && $image1=="")
                                           {
                                               $insert=mysqli_query($con,"UPDATE `user_register` SET `full_name`='$firstname',`email`='$em',password='$password',`country_code`='$cd',`contact`='$contact',image='$fname',id_expiry_date='$expiry_date' WHERE id='$id'");
                                               //die(mysqli_error($con));
                                               if($insert)
                                                {
                                                    $perr="User info updated successfully!";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                    echo'<script>window.location="viewcustomer.php";</script>';    
                                                }
                                                else
                                                {
                                                    $perr="Unsuccess";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                }
                                           }
                                           elseif($image=="" && $image1!="")
                                           {
                                           $insert=mysqli_query($con,"UPDATE `user_register` SET `full_name`='$firstname',`email`='$em',password='$password',`country_code`='$cd',`contact`='$contact',id_proof_image='$fname1',id_expiry_date='$expiry_date' WHERE id='$id'");
                                           //die(mysqli_error($con));
                                           if($insert)
                                            {
                                                $perr="User info updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                echo'<script>window.location="viewcustomer.php";</script>';    
                                            }
                                            else
                                            {
                                                $perr="Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                           }
                                           else
                                           {
                                        //   $sizes = array(250 => 250);
                                        //   $a_name=str_replace(" ","",$_FILES['image']['name']);
                                        //   foreach ($sizes as $w => $h) 
                                        //   {
                                        //       $files[]=resize($w, $h);
                                        //   }  
                                           
                                         $sql=mysqli_query($con,"UPDATE user_register SET full_name='$firstname',password='$password',`country_code`='$cd',`contact`='$contact',email='$em',image='$fname',id_proof_image='$fname1',id_expiry_date='$expiry_date' WHERE id='$id'");
                                         
                                     //die(mysqli_error($con));
                                         if($sql)
                                         {
                                                $perr="User info updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                echo'<script>window.location="viewcustomer.php";</script>';    
                                         }
                                       else
                                         {
                                             $perr="Unsuccess";
                                             echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                         }
                                         }
                                          }
                                        }
                                        
                                    ?>
                     <form role="form" method="post" class="validate" id="emailForm" enctype="multipart/form-data">
                    
                      <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control required" placeholder="Name" value="<?php echo $f_n;?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Email</label>
                        <input type="email" name="email" id="emailInput" class="form-control required" autoComplete="new-password" onkeyup="validateEmail()"  onblur="clearEmailField()" value="<?php echo $em;?>">
                        <div id="errorText" style="color: red;"></div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label" for="name">Password *</label>
                        <input type="password" id="passwordInput" onkeyup="validatePassword()"  name="pass" class="form-control required" autoComplete="new-password" onblur="clearPassword()" value="<?php echo $ps;?>" required>
                        <div id="errorText2" style="color: red;"></div>
                    </div>
                    
                    <!--<div class="form-group">-->
                    <!--    <label class="control-label" for="name">Work (business profile)</label>-->
                    <!--    <input type="text" name="work" class="form-control required" placeholder="business profile" value="<?php echo $wo;?>">-->
                    <!--</div>-->
                  <!--  <div class="form-group">-->
                  <!--      <label class="control-label"   for="name">Phone</label>-->
                  <!--     <input  type="tel"  name="contact"  required class="form-control required" placeholder=" Please Enter Phone Number" value="<?php echo $cn;?>">-->
                  <!--</div>-->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label"   for="name">Phone</label>
                          <div class="form-group"></div>
                       <input  type="tel" id="phone" name="code"   class="form-control" placeholder=" Please Enter Phone Number" style="margin-right: -149px;" value="<?php echo $code;?>">
                       <div class="form-group"><input  type="tel" name="contact"   id="contactInput" onkeyup="validateContactNumber()" onblur="clearContactNumber()"  class="form-control" placeholder="Phone Number" style="margin-top: -33px;margin-left: 105px;width: 188px;" value="<?php echo $cn;?>"></div>
                       <div id="errorText1" style="color: red;"></div>
                    </div>
                     <?php  $date11 = date('Y-m-d'); ?>
                    <div class="form-group col-md-6">
                            <label class="control-label" for="image">ID Proof Expiry Date</label>
                             <input type="date" name="expiry_date" id="date" min="<?php echo $date11 ?>" value="<?php echo $row['id_expiry_date'];?>" class="form-control required" placeholder=" Date" >
                    </div>
                </div>
                <div class="row"> 
                   
                    <div class="form-group col-md-6">
                        <label class="control-label" for="image">Customer Image</label><br>
                        <img src="<?php echo $path.$img;?>" width="250" height="250"/>
                        <input type="file"  name="image"   onchange="return validateImage()" id="image" class size="20" />
                        <div id="image_req" style="color: red"></div>
                    </div> 
                     <div class="form-group col-md-6">
                            <label class="control-label" for="image">ID Proof Image</label><br>
                             <!--<img src="<?php echo $path.$row['id_proof_image'];?>" width="250" height="250"/>-->
                             <?php  $imm= $row['id_proof_image'];
                                $last_3digit=substr($imm, -3);
                                $image11 =$path.$row['id_proof_image'];
                                if($last_3digit == 'PDF' || $last_3digit == 'pdf')
                            { ?>
                                 <iframe src="https://docs.google.com/gview?url=<?php $pay3=$row['id_proof_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>&embedded=true" width="250" height="250"></iframe>
                            <?php } else {?>
                                  <img src="<?php $pay3=$row['id_proof_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>" height="250" width="250">
                            <?php } ?>
                            <input type="file"  name="image1"  onchange="return validateImage1()" id="image1"  class size="20" >
                            <div id="image_req" style="color: red"></div>
                            
                            <!---IMAGE VALIDATE-------->
                
                <script language="JavaScript">
                 
                function validateEmail() 
                {
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
                  } else if (emailParts[1] !== 'gmail.com') {
                    errorText.textContent = "Only Gmail addresses are supported";
                //   } else if (/[0-9]/.test(emailParts[0])) {
                //     errorText.textContent = "Local part cannot contain numbers";
                  } else if (/[^a-z0-9._%+-@]/.test(emailParts[0])) {
                    errorText.textContent = "Special characters are not allowed";
                  } else {
                    emailForm.onsubmit = function() {
                     // alert("Form submitted successfully");
                      return true;
                    };
                  }
                }
                
                function clearEmailField() {
                  var emailInput = document.getElementById('emailInput');
                  var errorText = document.getElementById('errorText');
                
                  if (errorText.textContent !== "") {
                    emailInput.value = ""; // Clear the email input field
                  }
                }
                
                function validateContactNumber() 
                {
                  var contactInput = document.getElementById('contactInput');
                  var errorText1 = document.getElementById('errorText1');
                
                  var contactNumber = contactInput.value;
                  errorText1.textContent = ""; // Clear any previous error message
                
                  if (!/^[0-9]{5,8}$/.test(contactNumber)) {
                    errorText1.textContent = "Contact number must be 5 to 8 digits long and contain only positive numbers.";
                    contactInput.style.borderColor = "red";
                  } else {
                    contactInput.style.borderColor = ""; // Reset border color when valid
                  }
                }
                
                function clearContactNumber() {
                  var contactInput = document.getElementById('contactInput');
                  var errorText1 = document.getElementById('errorText1');
                
                  if (errorText1.textContent !== "") {
                    contactInput.value = ""; // Clear the email input field
                  }
                }
                
                function validatePassword() {
                  var passwordInput = document.getElementById('passwordInput');
                  var errorText2 = document.getElementById('errorText2');
                  
                  var password = passwordInput.value;
                  errorText2.textContent = ""; // Clear any previous error message
                
                  // Check if the password meets the criteria
                  if (password.length < 8 || !/[0-9]/.test(password) || !/[a-z]/.test(password) || !/[A-Z]/.test(password)) {
                    errorText2.textContent = "Password must contain at least one number, one lowercase letter, one uppercase letter, and be at least 8 characters long.";
                    passwordInput.style.borderColor = "red";
                  }
                   else if (/\s/.test(password)) {
                    errorText2.textContent = "Password cannot include spaces";
                    passwordInput.style.borderColor = "red";
                  }
                  else {
                    passwordInput.style.borderColor = ""; // Reset border color when valid
                  }
                }
                
                 function clearPassword() {
                  var passwordInput = document.getElementById('passwordInput');
                  var errorText2 = document.getElementById('errorText2');
                
                  if (errorText2.textContent !== "") {
                    passwordInput.value = ""; // Clear the email input field
                  }
                }
            
                function validateImage()
                {
                    var fileInput = document.getElementById('image');
                    var filePath = fileInput.value;
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPEG|\.PNG|\.JPG)$/i;
                    if(!allowedExtensions.exec(filePath))
                    {
                        alert('Only files with the following extensions are allowed: png, jpg and jpeg.');
                        fileInput.value = '';
                        return false;
                    }
                    else
                    {
                        //Image preview
                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        }
                    }
                }
                </script>
                
                <script language="JavaScript">
                  // Get the current year
                    const today = new Date();
                    const currentYear = today.getFullYear();
            
                    // Text input for date
                    const dateInput = document.getElementById('date');
            
                    // Date validation on keyup
                    dateInput.addEventListener('keyup', function () {
                        const enteredDate = this.value;
            
                        // Check if the entered date matches the format "YYYY-MM-DD"
                        const datePattern = /^\d{4}-\d{2}-\d{2}$/;
                        if (!datePattern.test(enteredDate)) {
                            this.setCustomValidity('Please enter a valid date in the format YYYY-MM-DD.');
                            return;
                        }
            
                        // Parse the entered date and check if it's in the future
                        const parts = enteredDate.split('-');
                        const year = parseInt(parts[0], 10);
                        const month = parseInt(parts[1], 10);
                        const day = parseInt(parts[2], 10);
            
                        const enteredDateObj = new Date(year, month - 1, day); // Month is 0-indexed
            
                        if (year < currentYear || enteredDateObj < today) {
                            this.setCustomValidity('Please enter a date in the future with the current year or later.');
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                    
                    function validateImage1(){
                    var fileInput = document.getElementById('image1');
                    var filePath = fileInput.value;
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPEG|\.PNG|\.JPG|\.PDF|\.pdf)$/i;
                    if(!allowedExtensions.exec(filePath))
                    {
                        alert('Only files with the following extensions are allowed: png, jpg, pdf and jpeg.');
                        fileInput.value = '';
                        return false;
                    }else{
                                //Image preview
                                if(fileInput.files && fileInput.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                                    };
                                    reader.readAsDataURL(fileInput.files[0]);
                                }
                            }
                    }
                      </script>
                            <!---IMAGE VALIDATE-------->
               
                    </div>
                </div>
                <input type="submit" name="add" class="btn btn-primary" value="Submit"/>
                <input type="reset"  class="btn btn-danger" onClick="myFunction()" value="Cancel" class="button" />
                  <script>
                    function myFunction() {
                      window.location.href = "viewcustomer.php";
                    }
                  </script>
                </form>
                                             <br><br>
                                                  
                                             
                                        
                                      </div>
                                     
                                      
                                      <!-- /.tab-pane -->
                                      
                                      <!-- /.tab-pane -->
                                      
                                      <!-- /.tab-pane -->
                                      
                                      <!-- /.tab-pane -->
                                      <!-- /.tab-pane -->
                                      
                                      <!-- /.tab-pane -->
                                      
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_6">
                                               <div class="row">
                                                      <div class="col-md-4"></div>
                                                      <div class="col-md-4">
                                                           <div style="background: #e0d4d4;padding: 6px 23px 8px 15px;border-radius: 7px;box-shadow: 0px 3px 3px 2px #949090;">
                                                                 <?php
                                                                    $wallet=mysqli_query($con,"select user_wallet from user_register where id='$id'");
                                                                    $credit=mysqli_fetch_assoc($wallet);
                                                                    $balance=$credit['user_wallet'];
                                                                 ?>
                                                                 <h3><b>Your Credit</b>:- USD. <?php echo $credit['user_wallet'];?></h3>
                                                                 <?php
                                                                    if(isset($_POST['submit66']) && !empty($_POST['submit66']))
                                                                    {
                                                                        
                                                                        $credit1=$_POST['credit'];
                                                                         $new_bal=$credit1+$balance;
                                                                        $insert55=mysqli_query($con,"update user_register set user_wallet='$new_bal' where id='$id'");
                                                                         $crdate=date('d-m-Y');
                                                                         date_default_timezone_set('Asia/Kolkata');
                                                       $dattime= date('Y-m-d H:i:s');
                                                       $inst=mysqli_query($con,"INSERT INTO `getTransactionhistory`(`iUserId`, `iDriverId`, `eUserType`, `eType`, `iTripId`, `eFor`, `tDescription`, `ePaymentstatus`,`trip_payment_mode`,`transaction_id`,`card_no`,`last_balance`, `currentbal`, `dDateorig`, `iBalance`, `ePaymentBy`, `ePaymentTo`, `eWithdrawStatus`, `ewithdrawpaid`, `remaining_amount`) 
                                                       VALUES ('$id','','Passenger','Credit','','Add by superadmin','Amount credited by superadmin','Paid','','','','$balance','$new_bal','$dattime','$credit1','Admin','Passenger','','','')");
                                                                        if($insert55)
                                                                        {
                                                                            $perr1="Amount credited Successfully";
                                                                            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                                                                            echo'<script>window.location="userdetails.php?id='.$id.'";</script>'; 
                                                                        }
                                                                        else
                                                                        {
                                                                            $perr1="Unable credit ! Please try again";
                                                                            echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                                                                            echo'<script>window.location="userdetails.php?id='.$id.'";</script>'; 
                                                                        }
                                                                    }
                                                                 ?>
                                                                 <form action="" method="POST" enctype="multipart/form-data">
                                                                  <div class="form-group">
                                                                <label class="control-label" for="name">Credit</label>
                                                                <input type="text" name="credit" id="rs" class="form-control required" placeholder="" oninput="validatenum1();" placeholder="" required="">
                                                            </div>
                                                             
                                                          <input type="submit" name="submit66" class="btn btn-primary"  value="Add Credit">
                                                          </form>
                                                           </div>
                                                       
                                                        </div>
                                                      <div class="col-md-4"></div>
                                                </div>
                                                
                                                <br><br>
                              <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                <th style="width: 50px;">S no</th>
                                <th>Name</th>
                                <th>Payment Description</th>
                                <th>Payment Type</th>
                                <th>Open Balance</th>
                                <th>Amount(Credit/Debit)</th>
                                <th>Closing Balance</th>
                                <th>Date / Time</th>
                                </tr>
                                </thead>
                                    
                                <tbody>
                                   <tr>
                                    
                                 <?php
                                  $f=mysqli_query($con,"select * from getTransactionhistory  where iUserId='$id' and eUserType='Passenger' order by wallet_id desc");
                                  $count=1;
                                  while($ff=mysqli_fetch_assoc($f))
                                  {
                                      $drk=mysqli_query($con,"SELECT * FROM `user_register` where id='$id'");
                                      $drk1=mysqli_fetch_assoc($drk);
                                      ?>
                                       <tr>
                                          <td><?php echo $count++; ?></td>
                                          <td><?php echo $drk1['full_name']?></td>
                                          <td><?php echo $ff['tDescription']; ?></td>
                                          <td><?php echo $ff['eType']; ?></td>
                                          <td><?php echo $ff['last_balance']; ?></td>
                                          <?php
                                          if($ff['eType']=='Debit')
                                          {
                                            ?>
                                             <td><?php echo "-".$ff['iBalance']; ?></td> 
                                          <?php }
                                          else
                                          {
                                          ?>
                                          <td><?php echo "+".$ff['iBalance']; ?></td>
                                          <?php }?>
                                          <td><?php echo $ff['currentbal']; ?></td>
                                          <!--<td><?php echo $ff['status']; ?></td>-->
                                          <td><?php echo date("d-m-Y H:i A",strtotime($ff['dDateorig'])); ?></td>
                                       </tr>
                                      <?php
                                  }
                                 
                                 ?>
                                    <!--<td><div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;">
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a href="driverdocument.php" data-toggle="tooltip" title="view"><img src="dist/img/edit-doc.png" style="width:30px;height:30px;"></a></li>
                                    <li><a href="edit_driver?edid=<?php echo $id; ?>" data-toggle="tooltip" title="edit"><img src="dist/img/edit.png" style="width:30px;height:30px;"></a></li>
                                    <li><a href="viewdriver.php?aid=<?php echo $id; ?>" data-toggle="tooltip" title="active"><img src="dist/img/active.png" style="width:30px;height:30px;"></a></li>
                                    <li><a href="viewdriver.php?bid=<?php echo $id; ?>" data-toggle="tooltip" title="inactive"><img src="dist/img/inactive.png" style="width:30px;height:30px;"></a></li>
                                    </ul>
                                    </div></td>-->
                                    </tr>
                                    
                                </tbody>
                                
                                </table>
                           </div>
                                                
                                       
                                      </div>
                                      <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                  </div>
                                  <!-- nav-tabs-custom -->
                                </div>
                                <!-- /.col -->
                
                
            
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="build1/js/intlTelInput.js"></script>
  <link rel="stylesheet" href="build1/css/intlTelInput.css">
  <link rel="stylesheet" href="build1/css/demo.css">

  
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

</body>
</html>