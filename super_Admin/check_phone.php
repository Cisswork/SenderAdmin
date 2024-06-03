<?php
include('config.php');

if (isset($_POST['contact']) && isset($_POST['code'])) {
    $contact = $_POST['contact'];
    $code = $_POST['code'];

    // Sanitize inputs before using them in a query to prevent SQL injection
    $contact = mysqli_real_escape_string($connection, $contact);
    $code = mysqli_real_escape_string($connection, $code);

    // Perform the MySQL query to check if the phone number exists
    $query = "SELECT * FROM Senders WHERE country_code = '$code' AND Phone = '$contact'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Phone number already exists.";
    }
}
?>
