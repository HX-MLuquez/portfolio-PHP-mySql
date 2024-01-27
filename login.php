<?php
session_start();
    if($_POST){
        $user = $_POST['user'];
        $password = $_POST['password'];
        if(($_POST['user'] == "Mauro") && ($_POST['password'] == "101")){
            // echo "<script>alert('Logueado con Éxito, OK!!!');</script> ";

            //* Manera de cargar SESSION para validar desde las otras vistas
            // $_SESSION['user']='Mauro';
            // $_SESSION['password']='101';

            //* Otro modo de manejar es con un boolean mediante $_SESSION['login']=true;
            $_SESSION['login']=true;
            $_SESSION['loginAdmin']=false;
            
            header("location:index.php");
        } 

        //* Para el Ingreso como Admin y poder acceder a la galería para agregar Proyectos
        elseif(($_POST['user'] == "Admin") && ($_POST['password'] == "1234")){
            $_SESSION['loginAdmin']=true;
            $_SESSION['login']=false;
            header("location:index.php");
        } 
        elseif($_POST['user'] == "") {
            echo "<script>alert('Falta ingresar el usuario');</script> ";
        }
        elseif($_POST['password'] == "") {
            echo "<script>alert('Falta ingresar la contraseña');</script> ";
        } 
        elseif(($_POST['user'] == "Mauro") && ($_POST['password'] != "101")) {
            echo "<script>alert('Contraseña Incorrecta');</script> ";
            $password="";
        }
        elseif((($_POST['user'] != "Mauro") || ($_POST['user'] != "Admin")) && ($_POST['password'] == "101")) {
            echo "<script>alert('Ese usuario no existe');</script> ";
            $user="";
        }  

    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body><br/>
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">

            <div class="card">
                
                <div class="card-header">Portfolio de Mauricio Gastón Lúquez</div>
                <div class="card-body">
                    <h4 class="card-title">LOGIN</h4>
                    <p class="card-text"></p>
                    <form action="login.php" method="post">
                Usuario:
                <input class="form-control" type="text" name="user" id="user" value="<?php echo isset($user) ? htmlspecialchars($user) : ''; ?>"></input>
                <br />
                Contraseña:
                <input class="form-control" type="password" name="password" id="password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>"></input>
                <br />
                <button type="submit" class="btn btn-success">Ingresar</button>
            </form>   
                </div>
               
            </div>
            
           
            </div>
            <div class="col-md-4">
                
            </div>
            
        </div>
        
        </div>
        
    </body>
</html>
