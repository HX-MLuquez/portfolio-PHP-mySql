<?php

session_start();
// print_r($_SESSION);
// print_r(isset($_SESSION['loginAdmin']));
// print_r($_SESSION['loginAdmin']);

//* ISSET isset() simplemente verifica si la variable existe y en este caso siempre guarda 1:1
// $login=isset($_SESSION['login']);
// $loginAdmin=isset($_SESSION['loginAdmin']);

$login=$_SESSION['login'];
$loginAdmin=$_SESSION['loginAdmin'];

$unlockAdmin=false; 
$unlockUser=false;

// echo "dentro de NavBar";
// print_r($login);
// print_r($loginAdmin);

if(($login != true) && ($loginAdmin!= true)){
    header("location:login.php");
    // exit();
}
else if(($login== true) && ($loginAdmin== false)){
    // echo "dentro de login normal";
    $unlockUser=true;
}
else if(($login == false) && ($loginAdmin == true)){
    // echo "dentro de loginAdmin";
    $unlockAdmin=true;
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navBar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <a class="navbar-brand" href="index.php">Inicio</a> 
            <?php 
            if($unlockAdmin == true){
                echo '<a class="navbar-brand" href="gallery.php">Galería</a>';
            }
            
            ?>
            
            <a class="navbar-brand" href="logout.php">Cerrar</a> 

        </div>
    </nav>



    