<?php 
include('config.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `notification_tbl` WHERE id='".$_GET['id']."'";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);

$row['u_address']; 
?>
<iframe id="test" style="height: 100%; width: 100%;" class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $row['d_address']; ?>&output=embed"></iframe>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    window.onload = setupRefresh;
    function setupRefresh()
    {
        setInterval(refreshBlock,30000); //Call function like this
    }

    function refreshBlock()
    {
       $('#test').load("Current_Location.php?id=<?php echo $id ?>");
    }
</script>