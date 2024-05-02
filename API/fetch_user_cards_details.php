<?php
    include "config.php";
    $iUserId = $_REQUEST['user_id'];
    $array=array();
    $crf=mysqli_query($con,"select * from tbl_user_card where customer_id='$iUserId' ");
    while($row=mysqli_fetch_assoc($crf))
    {
        $msg['card_id']=$row['card_id'];
        $msg['payment_method_id']=$row['payment_method_id'];
        $msg['card_number']=$row['card_number'];
        $msg['exp_month']=$row['exp_month'];
        $msg['exp_year']=$row['exp_year'];
        array_push($array,$msg);
    }
    array_walk_recursive($array,function(&$item){$item=strval($item);});
    echo json_encode($array, JSON_UNESCAPED_SLASHES);
    die;
?>