<?php
define("DB_HOST", "localhost");
define("DB_USER", "cisswwy3_sender_app");
define("DB_PASSWORD", "Sender!23490");
define("DB_DATABASE", "cisswwy3_sender_app");
$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($con,DB_DATABASE);
$sSQL= 'SET CHARACTER SET utf8'; 

mysqli_query($con,$sSQL);
?>