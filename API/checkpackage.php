<?php 
    include('config.php');
    $array = array();
    $path="https://cisswork.com/Android/SenderApp/super_Admin/car_img/";
    
    $Package_name = $_REQUEST['Package_name']; // Mini Small Large Extra Large
    $FromArea1 = $_REQUEST['FromArea'];
    $FromArea = strtolower($FromArea1);
    
    $ToArea1 = $_REQUEST['ToArea'];
    $ToArea = strtolower($ToArea1);
    
    $ZipCode1 = $_REQUEST['ZipCode1'];
    $ZipCode2 = $_REQUEST['ZipCode2'];
    
    $sql_source=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$ZipCode1'");
    $count_source=mysqli_num_rows($sql_source);
    $fetch_source=mysqli_fetch_assoc($sql_source);
    $source_area = $fetch_source['AreaName'];
    
    $sql_destination=mysqli_query($con,"SELECT * FROM AreaZipCodes WHERE ZipCode='$ZipCode2'");
    $count_destination=mysqli_num_rows($sql_destination);
    $fetch_destination=mysqli_fetch_assoc($sql_destination);
    $destination_area = $fetch_destination['AreaName'];
    
    if($count_source >0 && $count_destination > 0)
    {
        $sql_route = mysqli_query($con, "SELECT * FROM AreaFromTo WHERE (FromArea='$source_area' AND ToArea='$destination_area')");
        $fetch_sql_route = mysqli_fetch_assoc($sql_route);
        $a = $fetch_sql_route['Price1']; 
        $b = $fetch_sql_route['Price2']; 
        $c = $fetch_sql_route['Price3']; 
        $d = $fetch_sql_route['Price4']; 
        $count_sql_route = mysqli_num_rows($sql_route);
        if($count_sql_route > 0)
        {
            if($Package_name == 'Mini')
            {
                $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                $row=mysqli_fetch_assoc($sql);
                $message['result']="Success";
                $message['package_id']= $row['id'];
                $message['package_name']= $row['package_name'];
                if($row['image']=='')
                {
                  $message["Image"]=$path."user.png";
                }
                else
                {
                  $message["image"]=$path.$row['image'];
                }
                $message['capacity']= $row['capacity'] . "Kg";
                $message['size']= $row['size'];
                $message['service_charge']= $a;
            }
            elseif($Package_name == 'Small')
            {
                $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                $row=mysqli_fetch_assoc($sql);
                $message['result']="Success";
                $message['package_id']= $row['id'];
                $message['package_name']= $row['package_name'];
                if($row['image']=='')
                {
                  $message["Image"]=$path."user.png";
                }
                else
                {
                  $message["image"]=$path.$row['image'];
                }
                $message['capacity']= $row['capacity'] . "Kg";
                $message['size']= $row['size'];
                $message['service_charge']= $b;
            }
            elseif($Package_name == 'Large')
            {
                $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                $row=mysqli_fetch_assoc($sql);
                $message['result']="Success";
                $message['package_id']= $row['id'];
                $message['package_name']= $row['package_name'];
                if($row['image']=='')
                {
                  $message["Image"]=$path."user.png";
                }
                else
                {
                  $message["image"]=$path.$row['image'];
                }
                $message['capacity']= $row['capacity'] . "Kg";
                $message['size']= $row['size'];
                $message['service_charge']= $c;
            }
            elseif($Package_name == 'Extra Large')
            {
                $sql=mysqli_query($con,"SELECT * FROM tbl_package WHERE package_name ='$Package_name'");
                $row=mysqli_fetch_assoc($sql);
                $message['result']="Success";
                $message['package_id']= $row['id'];
                $message['package_name']= $row['package_name'];
                if($row['image']=='')
                {
                  $message["Image"]=$path."user.png";
                }
                else
                {
                  $message["image"]=$path.$row['image'];
                }
                $message['capacity']= $row['capacity'] . "Kg";
                $message['size']= $row['size'];
                $message['service_charge']= $d;
            }
        }
        else
        {
             $message['result']="These Area Name are not added. Please try with different Area Names!!"; 
        }
    }
    else
    {
         $message['result']="These ZipCode are not added. Please try with different ZipCode!!";
    }

    echo json_encode($message, JSON_UNESCAPED_SLASHES); 
    die;
?>