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
  <title> FAQ</title>
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
	font-weight: 500;
    text-transform: uppercase;
    margin: 0;
        padding: 5px 0 0 12px;
    font-size: 28px;
    margin-bottom: 14px;
    text-align: left;
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
        USER FREQUENTlY ASKED QUESTION
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
                                            if(isset($_POST['submit']) && !empty($_POST['submit']))
                                            {
                                                
                                                $cb=$_POST['ques'];
                                                $comm3=nl2br($cb);
                                                $info3=@mysqli_real_escape_string($con,$comm3);
                                                $f_ans=$_POST['answer'];
                                                $comm31=nl2br($f_ans);
                                                $info31=@mysqli_real_escape_string($con,$comm31);
                                               $swe=mysqli_query($con,"select * from faq where ques='$info3' AND type='Admin'");
                                               $swer=mysqli_fetch_assoc($swe);
                                              $t_name=$swer['ques'];
                                              $tid=$swer['f_id'];
                                              
                                               if($t_name==$info3)
                                               {
                                                  $perr1="This FAQ already exit if you want to modify then click ok...";
                                                  echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                                                   //echo"<script>window.location='edit_term.php?id= .'$tid'. ';</script>";
                                                   $script ='<script language="javascript">location.href=\'edit_faq.php?f_id='.$tid.'\';</script>';
                                                    echo $script;
                                               }
                                               else
                                               {
                                               $insert=mysqli_query($con,"INSERT INTO `faq`(type,`ques`,answer)VALUES('Admin','$info3','$info31')");
                                               
                                               if($insert)
                                               {
                                                   $perr="FAQ is added successfully!";
                                                   echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                                   echo'<script>window.location.href="faq.php";</script>';
                                               }
                                               else
                                               {
                                                   $perr="Unable to add. Please try again";
                                                   echo "<script type='text/javascript'>alert(\"$perr\");</script>";
                                               }
                                               }
                                            }
                                       ?>    
                                       <form role="form" method="post"  enctype="multipart/form-data" >
                                                <div class="form-group">
                                                    <label class="control-label" for="name">Question</label>
                                                    <textarea name="ques" class="form-control required" placeholder="Enter Question" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="name">Answer</label>
                                                    <textarea name="answer" class="form-control required" placeholder="Enter Answer" required></textarea>
                                                 </div>
                                                <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                                           </form>
                                   </div>
                                   
               </div>
               <!-----div main---->
               
            
               <section class="content-header">
        
      <h1>
        User FREQUENTlY ASKED QUESTION
      </h1>
     
    </section>
                        <div class="table-responsive">
                             <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                        <tr>
                                           <th style="width: 50px;">S.No.</th>
                                           <th>Question</th>
                                           <th>Answer</th>
                                             <th>Action</th>
                                        </tr>
                                  </thead>
                                  
                                  <tbody>
                                        <?php
                                                 include('../config.php');
                                                 $sql=mysqli_query($con,"select * from faq WHERE type='Admin'");
                                                 $count=0;
                                                 while($data=mysqli_fetch_assoc($sql))
                                                 {
                                            ?>
                                        <tr>
                                           <td><?php echo ++$count;?></td>
                                           <td><?php echo $data['ques'];?></td>
                                           <td><?php echo $data['answer'];?></td>
                  <td><div class="dropdown">
                <button class=" dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;background: #fff0;"><img src="dist/img/setting.png" style="width:30px;height:30px;">
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="edit_faq.php?id=<?php echo $data['f_id']?>" data-toggle="tooltip" title="Edit"><img src="dist/img/edit.png" style="width:30px;height:30px;"></a></li>
                          <li><a href="faq.php?fdid=<?php echo $data['f_id']?>" data-toggle="tooltip" title="Delete"><img src="dist/img/delete.png" style="width:30px;height:30px;"></a></li>
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
            $del=mysqli_query($con,"delete from faq where f_id='$fdid'");
            if($del)
            {
                $perr1="The FAQ is deleted successfully!";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="faq.php";</script>';   
            }
            else
            {
                $perr1="Unable to delete ! Please try again";
                echo "<script type='text/javascript'>alert(\"$perr1\");</script>";
                echo'<script>window.location="faq.php";</script>'; 
            }
        }
    ?>   
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