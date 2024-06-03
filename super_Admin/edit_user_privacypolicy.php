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
  <title>Add User Privacy Policy</title>
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
         Add User Privacy Policy
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
                                     if(isset($_GET['id']))
                                        {
                                            $id=$_GET['id'];
                                            $srt1=mysqli_query($con,"select * from tbl_user_privacy WHERE type='Admin' AND term_id='$id'");
                                            $srtt1=mysqli_fetch_assoc($srt1);
                                        }
                                        
                                         if(isset($_POST['submit']) && !empty($_POST['submit']))
                                         {
                                            
                                            $privacy_policy = $_POST['privacy_policy'];
                                            $srt=mysqli_query($con,"select * from tbl_user_privacy WHERE type='Admin' AND term_id='$id'");
                                            $srtt=mysqli_fetch_assoc($srt);
                                            $num=mysqli_num_rows($srt);
                                            if($num>0)
                                            {
                                                $upd=mysqli_query($con,"update tbl_user_privacy set privacy_policy='$privacy_policy' WHERE type='Admin' AND term_id='$id'");
                                                if($upd)
                                                {
                                                    $perr="Privacy Policy is updated successfully!";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                    echo'<script>window.location="add_user_privacypolicy.php";</script>';  
                                                }
                                                else
                                                {
                                                    $perr="Update Unsuccess";
                                                    echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                }
                                            }
                                            else
                                            {
                                            $query=mysqli_query($con,"INSERT INTO `tbl_user_privacy`(`privacy_policy`,type)VALUES ('$privacy_policy','Admin')");
                                            if($query)
                                            {
                                                $perr="Insert Success";
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
                                       <form role="form" method="post"  enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label class="control-label" for="name">Add User Privacy Policy</label>
                                              <textarea type="text" class="form-control" id="myeditor"   name="privacy_policy" required><?php echo $srtt1['privacy_policy'];?></textarea>
                             <script type="text/javascript" src="ckeditor/plugins/lite/lite-interface.js">
                             </script>
                             <script type="text/javascript">
                        	
                         
                        	CKEDITOR.replace('myeditor',{
                        		width: "100%",
                                height: "200px"
                                }
                        	);	
                        	</script>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                                        </form>
                                   </div>
                                   
               </div>
               <!-----div main---->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('footer.php');?>


  
</div>
<!-- ./wrapper -->
   
<!-- REQUIRED JS SCRIPTS -->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.accordion-toggle').on('click', function(event){
    	event.preventDefault();
    	// create accordion variables
    	var accordion = $(this);
    	var accordionContent = accordion.next('.accordion-content');
    	var accordionToggleIcon = $(this).children('.toggle-icon');
    	
    	// toggle accordion link open class
    	accordion.toggleClass("open");
    	// toggle accordion content
    	accordionContent.slideToggle(250);
    	
    	// change plus/minus icon
    	if (accordion.hasClass("open")) {
    		accordionToggleIcon.html("<i class='fa fa-minus-circle'></i>");
    	} else {
    		accordionToggleIcon.html("<i class='fa fa-plus-circle'></i>");
    	}
    });
});
</script>




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

</script>
</body>