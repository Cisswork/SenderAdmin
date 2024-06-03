<?php
     @SESSION_START();
     unset($_SESSION['id']);
     echo "<script>window.location.href='index.php'</script>";
?>