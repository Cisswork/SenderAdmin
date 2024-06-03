<?php
include('config.php');

if (isset($_POST['phoneNumber'])) {
    $phoneNumber = $_POST['phoneNumber'];
    // Perform the MySQL query to check if the phone number exists
    $query = "SELECT * FROM Senders WHERE Phone = '$phoneNumber'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    }else{
        echo $result;
    }
}
?>
