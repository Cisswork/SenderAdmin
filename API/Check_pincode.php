<?php 
    include('config.php');
    $source_address=$_REQUEST['source_address'];
    $source_zipcode=$_REQUEST['source_zipcode'];
    $destination_address=$_REQUEST['destination_address'];
    $destination_zipcode=$_REQUEST['destination_zipcode'];
    
    $sql_source=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$source_zipcode'");
    $count_source=mysqli_num_rows($sql_source);
    $fetch_source=mysqli_fetch_assoc($sql_source);
    $source_area = $fetch_source['AreaName'];
    
    $sql_destination=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$destination_zipcode'");
    $count_destination=mysqli_num_rows($sql_destination);
    $fetch_destination=mysqli_fetch_assoc($sql_destination);
    $destination_area = $fetch_destination['AreaName'];
    
    if($count_source >0 && $count_destination > 0)
    {
        //$sql_route = mysqli_query($con, "SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area') OR (FromArea='$destination_area' AND ToArea='$source_area')");
        $sql_route = mysqli_query($con, "SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area')");
       
        $fetch_sql_route = mysqli_fetch_assoc($sql_route);
        $count_sql_route = mysqli_num_rows($sql_route);
        if($count_sql_route > 0)
        {
            $msg['result']= "Route present here";
        }
        else
        {
            $msg['result']= "Route not present here";
        }
    }
    else
    {
        $msg['result']= "Zipcodes are not added!!";
    }
    echo json_encode($msg, JSON_UNESCAPED_SLASHES);
?>