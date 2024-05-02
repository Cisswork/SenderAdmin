<?php
include('config.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Sanitize the email before using it in a query to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);

    // Perform the MySQL query to check if the email exists
    $query = "SELECT * FROM user_register WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
