<?php include('config.php');?>
<?php 
  if(!isset($_SESSION['id']))  
       {
       	echo "<script>window.location.href='index.php';</script>";
	} 
 $driver_id =$_GET['drid'];
 ?>
	
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Driver</title>
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
        <a href="viewdriver.php"><button type="button" class="btn btn-info" style="float: right;margin: 13px;">BACK TO LISTING</button></a>
      <h1>
        ADD DRIVER
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                          <!-- general form elements -->
                          <div class="box box-primary" style="padding: 0 12px 0 13px;">
                            <div class="box-header with-border">
                              <!--<h3 class="box-title">Add Driver</h3>-->
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-content">
                             <?php
                                    $path="https://cisswork.com/Android/SenderApp/images/";
                                    $def="https://cisswork.com/Android/SenderApp/super_Admin/logo (2).png";
                                    $driver_id =$_GET['drid'];
                                    $sql="SELECT * FROM Drivers WHERE DriverID ='$driver_id'";
                                    $sql_res=mysqli_query($con,$sql);
                                    $row=mysqli_fetch_assoc($sql_res);
                             
                                    if(isset($_POST['submit']))
                                    {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date('Y-m-d h:i:s');
                                        
                                        $UserName=$_POST['UserName'];
                                        $FirstName=$_POST['FirstName'];
                                        $LastName=$_POST['LastName'];
                                        $Address =$_POST['Address'];
                                        $Address2=$_POST['Address2'];
                                        $City=$_POST['City'];
                                        $Email=$_POST['Email'];
                                        $Password=$_POST['Password'];
                                        
                                        $State=$_POST['State'];
                                        $lng=$_POST['longitude'];
                                        $lat=$_POST['latitude'];
                                        $Zip = $_POST['Zip'];
                                        $LicenseNum=$_POST['LicenseNum'];
                                        $country_code = $_POST['country_code'];
                                        $Phone=$_POST['Phone'];
                                        $Phone2=$_POST['Phone2'];  
                                        $Phone3=$_POST['Phone3'];
                                        
                                        $filename2=$_FILES['license_image']['name'];
                                        $tmpname2=$_FILES["license_image"]["tmp_name"];
                                        $ext2=substr($filename2,strpos($filename2,"."));
                                        $str2="ABCDEFGHijklmnopqrstuvwxyz0123456789";
                                        $finame2=substr(str_shuffle($str2),5,10)."_".time().$ext2;
                                        if(move_uploaded_file($tmpname2,"../images/$finame2"));
                                        
                                        $filename=$_FILES['image']['name'];
                                        $tmpname=$_FILES["image"]["tmp_name"];
                                        $ext=substr($filename,strpos($filename,"."));
                                        $str="ABCDEFGHijklmnopqrstuvwxyz0123456789";
                                        $finame=substr(str_shuffle($str2),5,10)."_".time().$ext;
                                        if(move_uploaded_file($tmpname,"../images/$finame"));
                                       
                                        if($filename =="" && $filename2 =="")
                                        {
                                            $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName',`Password`='$Password',`FirstName`='$FirstName',`LastName`='$LastName',`Address`='$Address',`Address2`='$Address2',`City`='$City',`State`='$State',`Zip`='$Zip',`Driver_lat`='$lat',`Driver_lng`='$lng',`Email`='$Email',`country_code`='$country_code',`Phone`='$Phone',`Phone2`='$Phone2',`Phone3`='$Phone3',`LicenseNum`='$LicenseNum',`zipcode_list`='$route_id_list' WHERE `DriverID`='$driver_id'");
                                           //die(mysqli_error($con));
                                            if($update)
                                            {
                                                $perr="Driver Updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                            else
                                            {
                                                $perr="Update Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                        }
                                        elseif($filename !="" && $filename2 =="")
                                        {
                                            $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName',`Password`='$Password',`FirstName`='$FirstName',`LastName`='$LastName',`Address`='$Address',`Address2`='$Address2',`City`='$City',`State`='$State',`Zip`='$Zip',`Driver_lat`='$lat',`Driver_lng`='$lng',`Email`='$Email',`country_code`='$country_code',`Phone`='$Phone',`Phone2`='$Phone2',`Phone3`='$Phone3',`LicenseNum`='$LicenseNum',`image`='$finame',`zipcode_list`='$route_id_list' WHERE `DriverID`='$driver_id'");
                                            //die(mysqli_error($con));
                                            if($update)
                                            {
                                                $perr="Driver Updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                            else
                                            {
                                                $perr="Update Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                        }
                                        elseif($filename =="" && $filename2 !="")
                                        {
                                            $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName',`Password`='$Password',`FirstName`='$FirstName',`LastName`='$LastName',`Address`='$Address',`Address2`='$Address2',`City`='$City',`State`='$State',`Zip`='$Zip',`Driver_lat`='$lat',`Driver_lng`='$lng',`Email`='$Email',`country_code`='$country_code',`Phone`='$Phone',`Phone2`='$Phone2',`Phone3`='$Phone3',`LicenseNum`='$LicenseNum',`LicensePic`='$finame2',`zipcode_list`='$route_id_list' WHERE `DriverID`='$driver_id'");
                                            //die(mysqli_error($con));
                                            if($update)
                                            {
                                                $perr="Driver Updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                            else
                                            {
                                                $perr="Update Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                        }
                                        else
                                        {
                                            $update=mysqli_query($con,"UPDATE `Drivers` SET `UserName`='$UserName',`Password`='$Password',`FirstName`='$FirstName',`LastName`='$LastName',`Address`='$Address',`Address2`='$Address2',`City`='$City',`State`='$State',`Zip`='$Zip',`Driver_lat`='$lat',`Driver_lng`='$lng',`Email`='$Email',`country_code`='$country_code',`Phone`='$Phone',`Phone2`='$Phone2',`Phone3`='$Phone3',`LicenseNum`='$LicenseNum',`LicensePic`='$finame2',`image`='$finame',`zipcode_list`='$route_id_list' WHERE `DriverID`='$driver_id'");
                                            //die(mysqli_error($con));
                                            if($update)
                                            {
                                                $perr="Driver Updated successfully!";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                            else
                                            {
                                                $perr="Update Unsuccess";
                                                echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                            }
                                        }
                                    }
                ?>
                 <form role="form" method="post" id="emailForm" class="validate" autocomplete="off"  enctype="multipart/form-data" id="myform">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">User Name</label>
                                <input type="text" name="UserName" value="<?php echo $row['UserName'];?>"  class="form-control required" placeholder="User Name" >
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">First Name</label>
                                <input type="text" name="FirstName"  value="<?php echo $row['FirstName'];?>" class="form-control required" placeholder="First Name" >
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Surname Name</label>
                                <input type="text" name="LastName"  value="<?php echo $row['LastName'];?>" class="form-control required" placeholder="Last Name" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="name">Email</label>
                            <input type="email" name="Email" value="<?php echo $row['Email'];?>" class="form-control required"  autoComplete="new-password"id="emailInput" onkeyup="validateEmail()"  onblur="clearEmailField()" placeholder=" Email" >
                            <div id="errorText" style="color: red;"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="name">Password</label>
                            <input type="password" name="Password" value="<?php echo $row['Password'];?>" class="form-control required"  autoComplete="new-password" placeholder=" Password"  id="passwordInput" onkeyup="validatePassword()" onblur="clearPassword()">
                             <div id="errorText2" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label"   for="name">Phone</label>
                        <div class="form-group">
                            <input  type="text" id="phone" name="country_code"  onkeyup="validateCode()"  onblur="clearCode()"  class="form-control" placeholder=" Please Enter Phone Number" style="margin-right: -149px;" >
                        </div>
                        <div class="form-group"> 
                           <input  type="number" name="Phone"  id="contactInput" value="<?php echo $row['Phone'];?>" onkeyup="validateContactNumber()" onblur="clearContactNumber()"  class="form-control" placeholder="Phone Number" style="margin-top: -49px;margin-left: 105px;width: 183px;" >
                        </div>
                        <div id="errorText3" style="color: red;"></div>
                        <div id="errorText1" style="color: red;"></div> 
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label"   for="name">Phone2</label>
                        <div class="form-group">
                            <input  type="text" id="phone2" name="country_code"  onkeyup="validateCode()"  onblur="clearCode()"  class="form-control" placeholder=" Please Enter Phone Number" style="margin-right: -149px;" >
                        </div>
                        <div class="form-group"> 
                           <input  type="number" name="Phone2"  id="contactInput" value="<?php echo $row['Phone2'];?>" onkeyup="validateContactNumber()" onblur="clearContactNumber()"  class="form-control" placeholder="Phone Number" style="margin-top: -49px;margin-left: 105px;width: 183px;" >
                        </div>
                        <div id="errorText3" style="color: red;"></div>
                        <div id="errorText1" style="color: red;"></div> 
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label"   for="name">Phone3</label>
                        <div class="form-group">
                            <input  type="text" id="phone3" name="country_code"  onkeyup="validateCode()"  onblur="clearCode()"  class="form-control" placeholder=" Please Enter Phone Number" style="margin-right: -149px;" >
                        </div>
                        <div class="form-group"> 
                          <input  type="number" name="Phone3"  id="contactInput" value="<?php echo $row['Phone3'];?>" onkeyup="validateContactNumber()" onblur="clearContactNumber()"  class="form-control" placeholder="Phone Number" style="margin-top: -49px;margin-left: 105px;width: 183px;" >
                        </div>
                        <div id="errorText3" style="color: red;"></div>
                        <div id="errorText1" style="color: red;"></div>  
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Address</label>
                        <textarea name="Address" value="" class="form-control required" placeholder="Address" ><?php echo $row['Address'];?></textarea>
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="name">Address2</label>
                        <textarea name="Address2" value="" class="form-control required" placeholder="Address2"><?php echo $row['Address2'];?></textarea>
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="name">City</label>
                        <textarea name="City" value="" class="form-control required" placeholder="City" ><?php echo $row['City'];?></textarea>
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="name">State</label>
                        <textarea name="State" value="" class="form-control required" placeholder="State" ><?php echo $row['State'];?></textarea>
                    </div>
                   
                    <!--<div class="form-group">-->
                    <!--     <label class="control-label" for="name">Route List</label>-->
                    <!--    <select name="route_id_list" class="form-control required" required>-->
                    <!--        <option value="" selected="selected">Select Route List</option>-->
                            <?php
                            //   $sql="SELECT * FROM AreaFromTo";
                            //   $res=mysqli_query($con,$sql);
                            //   while($row=mysqli_fetch_assoc($res))
                            //          { 
                            //           $id1=$row['id'];
                            //           $car=$row['RouteID'];
                            //           echo "<option value=$id1>$car</option>";
                            //          } 
                           ?>
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label" for="name">Zip</label>
                            <input type="number" name="Zip" value="<?php echo $row['Zip'];?>" class="form-control required" placeholder="Zip">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">License Num</label>
                                <input type="number" min="0"  name="LicenseNum" value="<?php echo $row['LicenseNum'];?>"  class="form-control required" placeholder="LicenseNum" > 
                                <!--<input type="text" name="expiry_date" class="form-control required" placeholder="Licence Expiry Date"required>-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label" for="image">Driver Image</label>
                            <br>
                            <img src="<?php $pay=$row['image'];if($pay==''){echo $def;} else{echo $path.$pay;}?>" height="250px" width="250px">
                            <input type="file"  name="image" onchange="return validateImage1()" id="image" class="required"class size="20" style="width: 230px;position: relative;"  />
                            <!--<div id="image_req" style="color: red"></div>-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label" for="image">License Image</label>
                            <br>
                            <img src="<?php $pay3=$row['license_image'];if($pay3==''){echo $def;} else{echo $path.$pay3;}?>" height="250px" width="250px">
                            <input type="file"  name="license_image" onchange="return validateImage1()" id="image1" class="required"class size="20" style="width: 230px;position: relative;"  />
                            <!--<div id="image_req" style="color: red"></div>-->
                            </div>
                        </div>
                       
                    </div>
      </div>
         <!---IMAGE VALIDATE-------->
                
                <script language="JavaScript">
                 
                
                // function validateEmail() 
                // {
                //   var emailInput = document.getElementById('emailInput');
                //   var errorText = document.getElementById('errorText');
                //   var emailForm = document.getElementById('emailForm');
                  
                //   var email = emailInput.value;
                //   var emailParts = email.split('@');
                //   errorText.textContent = ""; // Clear any previous error message
                //   emailForm.onsubmit = null; // Clear previous submit event handler
                
                //   if (emailParts.length !== 2) {
                //     errorText.textContent = "Email must contain a single '@' symbol";
                //   } else if (emailParts[0] !== emailParts[0].toLowerCase()) {
                //     errorText.textContent = "All letters must be in lowercase";
                //   } else if (emailParts[1] !== 'gmail.com') {
                //     errorText.textContent = "Only Gmail addresses are supported";
                // //   } else if (/[0-9]/.test(emailParts[0])) {
                // //     errorText.textContent = "Local part cannot contain numbers";
                //   } else if (/[^a-z0-9._%+-@]/.test(emailParts[0])) {
                //     errorText.textContent = "Special characters are not allowed";
                //   } else {
                //     emailForm.onsubmit = function() {
                //      // alert("Form submitted successfully");
                //       return true;
                //     };
                //   }
                // }
                
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
                
                function validateContactNumber() 
                {
                  var contactInput = document.getElementById('contactInput');
                  var errorText1 = document.getElementById('errorText1');
                
                  var contactNumber = contactInput.value;
                  errorText1.textContent = ""; // Clear any previous error message
                
                  if (!/^[0-9]{7,13}$/.test(contactNumber)) {
                    errorText1.textContent = "Contact number must be between 7 to 13 digits long and contain only positive numbers.";
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
                
                function validateCode() {
                  const codeInput = document.getElementById('phone');
                  const errorText3 = document.getElementById('errorText3');
                  const code = codeInput.value;
                
                  // Define a regular expression pattern for the desired format
                  const pattern =  /^\+\d*$/;
                
                  if (pattern.test(code)) {
                    // Valid input
                    errorText3.textContent = '';
                  } else {
                    // Invalid input
                    errorText3.textContent = 'Invalid code format. It should start with a + sign and be followed by positive numbers.';
                  }
                }
                
                function clearCode() {
                  var codeInput = document.getElementById('phone');
                  var errorText3 = document.getElementById('errorText3');
                
                  if (errorText3.textContent !== "") {
                    codeInput.value = ""; // Clear the email input field
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
                              <!-- /.box-body -->
                
                              <div class="box-footer">
                                  <input type="submit" name="submit" class="btn btn-primary" style="width: 84px;" value="Submit"/>
                                
                              </div>
                            </form>
                          </div>
                          <!-- /.box -->
                    
                    
                </div>
                
            </div> <!-----div main---->  
            
            
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
<script>
    var telInput = $("#phone_number"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");

$("#phone_number").intlTelInput({
        autoHideDialCode: false,
        nationalMode: false,
        preferredCountries: [],
        utilsScript: "https://img.infocert.it/js/libphonenumber.js"
	});
  
  // on blur: validate
  telInput.focusout(function () {
    if ($.trim(telInput.val())) {
      if (telInput.intlTelInput("isValidNumber")) {
        validMsg.removeClass("hide");
      } else {
        telInput.addClass("error");
        errorMsg.removeClass("hide");
        validMsg.addClass("hide");
      }
    }
    var numberType = $("#phone_number").intlTelInput("getNumberType");
    if (numberType == intlTelInputUtils.numberType.MOBILE) {
      // is a mobile number
      $("#phone_number").attr('name', 'mobile');
    } else {
      $("#phone_number").attr('name', 'phone_number');
    }
  });

  // on keydown: reset
  telInput.keydown(function () {
    telInput.removeClass("error");
    errorMsg.addClass("hide");
    validMsg.addClass("hide");
  });

jQuery.validator.addMethod('validatePhone', function () {
	 if ($("#phone_number").intlTelInput("isValidNumber")) {
		console.log('correct');
	 	return true;
	 } else {
		console.log('Incorrect');
	 	return false;
	 }
 }, "Please specify valid phone number");
    
validatorHighlight = function(element) {
	$(element)
		.closest('.control-group')
		.removeClass('success')
		.addClass('error');
};

validatorSuccess = function(element) {
	element.text('OK!')
		.addClass('valid')
		.closest('.control-group')
		.removeClass('error')
		.addClass('success');
};
    
    
$( "#myform" ).validate({
	rules: {
  	name: {
    	required: true
    },
    phone_number: {
    	required: true,
      validatePhone: true
    }
  },
  highlight: function(element) {
    validatorHighlight(element);
  },
  success: function(element) {
    validatorSuccess(element);
  }
});

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
//onlyCountries: ['jm'],
preferredCountries: ['jm'],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build1/utils.js"
});

$("#phone2").intlTelInput({
allowExtensions: true,
autoFormat: false,
autoHideDialCode: false,
autoPlaceholder: false,
defaultCountry: "auto",
ipinfoToken: "yolo",
nationalMode: false,
numberType: "MOBILE",
//onlyCountries: ['jm'],
preferredCountries: ['jm'],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build1/utils.js"
});

$("#phone3").intlTelInput({
allowExtensions: true,
autoFormat: false,
autoHideDialCode: false,
autoPlaceholder: false,
defaultCountry: "auto",
ipinfoToken: "yolo",
nationalMode: false,
numberType: "MOBILE",
//onlyCountries: ['jm'],
preferredCountries: ['jm'],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build1/utils.js"
});
});
</script>
<link rel="stylesheet" href="build1/css/intlTelInput.css">
  <link rel="stylesheet" href="build1/css/demo.css">
</body>
</html>
