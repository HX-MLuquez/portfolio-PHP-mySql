<!-- <?php include("navBar.php") ?>
    
    <h1>Hola soy el LOGOUT</h1>

<?php include("footer.php") ?> -->

<?php
session_start();
session_destroy();
header("location:login.php");
?>