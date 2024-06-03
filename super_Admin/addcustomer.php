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
  <title>Add User</title>
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
  .pull-left input {
    border: 1px solid #CCC;
    width: 170px !important;
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
        <a href="viewcustomer.php"><button type="button" class="btn btn-info" style="float: right;margin: 13px;">BACK TO LISTING</button></a>
      <h1>
        ADD USER
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div style="padding: 0 27px 0 27px;"> <!-----div main---->
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            </div>
                            
                            <!-- /.box-header -->
                              <?php
                           require_once '../API/stripe-payment/vendor/autoload.php';
                           if(isset($_POST['add']) && !empty($_POST['add']))
                            {
                               $firstname=$_POST['name'];        
                               $sname=$_POST['surname'];
                               $cod=$_POST['code'];
                               $date = date('Y-m-d');
                               $contact=$_POST['contact'];
                               $em=$_POST['email'];
                               $password=$_POST['pass'];
                               $select=mysqli_query($con,"SELECT * FROM Senders WHERE Email='$em'");
                               $row_select=mysqli_fetch_assoc($select);
                               $selects=mysqli_query($con,"SELECT * FROM Senders WHERE Phone='$contact' AND country_code='$cod'");
                               $row_selects=mysqli_fetch_assoc($selects);
                               $phone_num=$row_selects['Phone']; $pcode=$row_selects['country_code'];
                                $ueml=$row_select['Email'];
                                
                                $filename=$_FILES['image']['name'];
                                $type=$_FILES['image']['type'];
                                $size=$_FILES['image']['size'];
                                $tmpname=$_FILES['image']['tmp_name'];
                                $ext=substr($filename,strpos($filename,"."));
                                $str="abcdefghijklmonpqrstuvwxyz1234567890";
                                $fname=substr(str_shuffle($str),5,10)."_".time().$ext;  
                                 move_uploaded_file($tmpname,"../images/$fname");
                                
                                $filename1=$_FILES['image2']['name'];
                                $tmpname1=$_FILES["image2"]["tmp_name"];
                                $ext1=substr($filename1,strpos($filename1,"."));
                                $str1="ABCDEFGHijklmnopqrstuvwxyz0123456789";
                                $finame1=substr(str_shuffle($str1),5,10)."_".time().$ext1;
                                if(move_uploaded_file($tmpname1,"../images/$finame1"));
                                $expiry_date=$_POST['expiry_date'];
                                   
                                $test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
                                $Live_key = '';
                                
                                \Stripe\Stripe::setApiKey($test_key);
                                $customerInfo = array('name' => $name,'email' => $em,);
                                
                                // Create a customer in Stripe
                                $stripeCustomer = \Stripe\Customer::create(['email' => $customerInfo['email'],]);
                                
                                $customerId = $stripeCustomer->id;
                                
                                $randomid = mt_rand(100000,999999);
                                $FriendlyID='SEND'.$randomid;
                                $insert=mysqli_query($con,"INSERT INTO `Senders`(`FriendlyID`, `UserName`, `Password`, `FirstName`, `LastName`, `Address`, `Address2`, `City`, `State`, `Zip`, `Email`, `Phone`, `Phone2`, `Phone3`, `Status`, `PreferredPayment`, `ForceAuth`, `NotifyType`, `TimeStampCreated`, `LastUpdated`, `Stripe_CustomerId`, `country_code`, `country_flag`, `user_wallet`, `device_id`, `iosdevice_id`, `device_status`, `id_proof_image`, `id_expiry_date`,gender,`image`)
                                                      VALUES ('$FriendlyID','','$password','$firstname','$sname','','','','','','$em','$contact','','','Approve','','','','$date','','$customerId','$country_code','$CountryFlag','0','','','','$finame1','$expiry_date','','$fname')");
              
                               //die(mysqli_error($con));
                                $insert_id=mysqli_insert_id($con);
                               if($insert)
                                {
                                    $perr="The User is added successfully!";
                                    $to_email = $em;
                                    $subject = 'Welcome to Sender';
                                    $txt ="Hello $firstname"."\r\n"; 
                                    $txt.="Welcome to Sender. Thank you for registering with us."."\r\n";
                                    $txt.="Below mentioned are your login details."."\r\n";
                                    $txt.="contact = $cod $contact"."\r\n";
                                    $txt.="password = $password"."\r\n";
                                    $txt.="Thanks and Regards,"."\r\n";
                                    $txt.="Sender Team"."\r\n";
                                    $headers = "from:barkha.ciss@gmail.com" . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion(); 
                                    $user_email=mail($to_email,$subject,$txt,$headers);
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                    
                                }
                                else
                                {
                                    $perr="Insert Unsuccess";
                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                }
                               
                            }
                            
                          ?>
                <div class="box-body">
                <form role="form" method="post" id="emailForm" class="validate" autocomplete="off"  enctype="multipart/form-data">
                    <div class="form-group row" col-md-6>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="name">First Name *</label>
                            <input type="text" name="name" id="textInput" onblur="clearTextField()" class="form-control required" placeholder="First Name" required>
                             <div id="errorText3" style="color: red;"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="name">Last Name *</label>
                            <input type="text" name="surname" id="textInput" onblur="clearTextField()" class="form-control required" placeholder="Last Name" required>
                             <div id="errorText3" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Email *</label>
                            <input type="email" name="email" id="emailInput" placeholder="Email"  class="form-control required" autoComplete="new-password" onkeyup="validateEmail()"  onblur="clearEmailField()"required>
                            <div id="errorText" style="color: red;"></div>
                            <div id="kilText" style="color: green;"></div>
                            <div id="kilError" style="color: red;"></div>
                       </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Password *</label>
                            <input type="password" id="passwordInput" onkeyup="validatePassword()"  name="pass" class="form-control required" autoComplete="new-password" onblur="clearPassword()"  placeholder=" Password" required>
                            <div id="errorText2" style="color: red;"></div>
                        </div>
                    </div>
                     <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="form-group col-md-12">
                            <label class="control-label"   for="name">Phone *</label>
                            <div class="form-group"></div>
                           <input  type="tel" id="phone" name="code"   class="form-control" placeholder=" Please Enter Phone Number" style="margin-right: -149px;" required>
                           <div class="form-group"><input  type="number" name="contact" id="contactInput" onkeyup="validateContactNumber()" onblur="checkPhoneNumber()" class="form-control" placeholder="Phone Number" style="margin-top: -33px;margin-left: 105px;width: 188px;" required>
                           <div id="errorText1" style="color: red;"></div>
                            </div>
                        </div>
                         </div>
                         <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="image">Customer Image *</label>
                            <input type="file"  name="image"  onchange="return validateImage()" id="image" class size="20" required style="width: 100%;">
                            <div id="image_req" style="color: red"></div>
                        </div>
                          <div class="form-group col-md-6">
                            <label class="control-label" for="image">ID Proof Image</label>
                            <input type="file"  name="image2"  onchange="return validateImage1()" id="image1" class size="20" style="width: 100%;">
                            <div id="image_req" style="color: red"></div>
                        </div>
                    </div>
                   
                    <div class="row"> 
                      
                         <?php  $date11 = date('Y-m-d'); ?>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="image">ID Proof Expiry Date</label>
                             <input type="date" name="expiry_date" id="date" min="<?php echo $date11 ?>" class="form-control required" placeholder=" Date">
                        </div>
                    </div>
                    <!---IMAGE VALIDATE-------->
              </div>
              <!-- /.box-body -->

            <div class="box-footer">
                <input type="submit" name="add" class="btn btn-primary" value="Submit"/>
                  <input type="reset"  class="btn btn-danger" onClick="myFunction()" value="Cancel" class="button" />
                  <script>
                    function myFunction() {
                      window.location.href = "viewcustomer.php";
                    }
                  </script>
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
preferredCountries: ['IN'],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build1/utils.js"
});
});

//kilcheck email -> 
$(document).ready(function() 
{
    $('#emailInput').on('input', function()
    {  
        var email = $(this).val();
        var emailInput = document.getElementById('emailInput');
        $.ajax({
            type: 'POST',
            url: 'check_email.php',
            data: { email: email },
            success: function(data) 
            {
                if (data == 'exists')
                {
                    $('#kilError').text("A record with the given Email ID( "+ email + " ) already exist, Enter another unnique Email ID and try again.");
                    $('#kilText').text("");
                    emailInput.value = "";
                } 
                else
                {
                     $('#kilText').text("Email available.");
                    $('#kilError').text("");
                }
            }
        });
    });
});
</script>

<script>
    function toggleFields() {
        var registrationType = document.querySelector('input[name="registration_type"]:checked').value;
        var companyFields = document.getElementById('companyFields');

        if (registrationType === 'Company') {
            companyFields.style.display = 'block';
        } else {
            companyFields.style.display = 'none';
        }
    }
</script>
    <!---IMAGE VALIDATE-------->
<script language="JavaScript">
    const textInput = document.getElementById("textInput");
    const errorText3 = document.getElementById("errorText3");

    textInput.addEventListener("keyup", function() {
      const inputValue = textInput.value;
      const hasSpecialCharacter = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(inputValue);

      if (hasSpecialCharacter) {
        errorText3.textContent = "Special characters are not allowed.";
      } else {
        errorText3.textContent = "";
      }
    });
    function clearTextField() 
    {
      var textInput = document.getElementById('textInput');
      var errorText3 = document.getElementById('errorText3');
    
      if (errorText3.textContent !== "") {
        textInput.value = ""; // Clear the email input field
      }
    }
    
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
      } else if (/[^a-z0-9._%+-@]/.test(emailParts[0])) {
        errorText.textContent = "Special characters are not allowed";
      } else {
          var domain = emailParts[1].toLowerCase();

            // Perform stricter validation on the domain
            if (!/^[a-z0-9.-]+$/.test(domain)) {
                errorText.textContent = "Invalid characters in the domain part";
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
                            
                      if (!/^[0-9]{10}$/.test(contactNumber)) {
                    errorText1.textContent = "Contact number must be 10 digits long and contain only positive numbers.";
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

    function checkPhoneNumber() {
        
          var contactInput = document.getElementById('contactInput');
      var errorText1 = document.getElementById('errorText1');
    //   var contactInput = document.getElementById('contactInput');
        var phoneNumber = contactInput.value;
    
      if (errorText1.textContent !== "") {
        contactInput.value = ""; // Clear the email input field
      }else{
        // Make an AJAX request to check if the phone number exists
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'exists') { 
                        // Show the error message if the phone number already exists
                        var errorText1 = document.getElementById('errorText1');
                        errorText1.textContent = "A record with the given Contact Numbe ( "+ phoneNumber +" ) already exists. Enter another unique Contact Number and try again";
                        contactInput.style.borderColor = "red";
                        contactInput.value = ""; 
                        
                    }else{
                        
                    }
                }
            }
        };
        xhr.open('POST', 'check_phone_number.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('phoneNumber=' + phoneNumber);
      }
       //funtn End  
    }
    function validatePassword() 
    {
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
    
    function clearPassword() 
    {
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
                this.setCustomValidity('Please enter a valid date in the format MM-DD-YYYY.');
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
<link rel="stylesheet" href="build1/css/intlTelInput.css">
<link rel="stylesheet" href="build1/css/demo.css">
</body>
</html>