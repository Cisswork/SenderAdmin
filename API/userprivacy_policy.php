<?php include('config.php');
$sql=mysqli_query($con,"SELECT * FROM `tbl_user_privacy` WHERE type='Admin'");
?>
<html>
    <head>
        <style>
        .content {
  width:100%;
  margin:0;
}
.content h1{
  font-size:45px;
  text-align:left;
}
#accordion h4{
  margin:5px 0 0;
  padding:15px;
  font-size:20px;
  font-weight:normal;
  text-align:left;
  color:#fff;
  background:#81938A;
  outline: 0;
  cursor:pointer;
  border-bottom: 1px solid black;
  border-left: 1px solid black;
}

#accordion h4:hover {
  
  background:#81938A;
  content: "\2191";
}

#accordion div {
  position:relative;
  margin:0 0 0;
  padding:15px;
  color:#fff;
  background:transparent;
  display: block;
  color:#000;
  
}

#accordion div:after {
position: absolute;
top: -31px;
right: 7%;
display: block;
width: 0;
height: 0;
margin-left: -20px;
border-width: 15px;
border-style: solid;
border-color: transparent transparent  rgb(127,147,138)  transparent;
z-index:1;
content: '';
}
</style>
    </head>
    <!--<div class="text-center">-->
    <!--                     <a href="dashboard.php" class="logo-lg"><img src="dist/img/logo.png" style="width: 9%;margin-top: 0px;margin-bottom: -165px;margin-left: 600px;"> </a>-->
    <!--                </div>-->
<body>
<div class="container" style="padding: 0 10px 0 10px;">
    <div>
  <!--<center><h1>Taxi guru Privacy Policy</h1></center>  -->
  <div>

<?php while($row=mysqli_fetch_assoc($sql))
{?>

<div>
   <h1 style="text-align: justify;"><?php echo $row['privacy_policy'];?></h1>
 <?php } ?>
 
</div>

<script>
    $(function() {
    $("#accordion").accordion({
            active: false,
            autoHeight: false,
            navigation: true,
            collapsible: true,
      event: "mouseover"
        });
});
</script>
<!--<footer>
<center><strong>Copyright &copy;2019-2020 Rope.</a></strong> All Right reserved.</a></center></footer>-->
</body>
</html>