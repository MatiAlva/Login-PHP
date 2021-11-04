<?php
/* Incluye el archivo de conexion */
include("conexion.php");

/* ----------------------------------- */
session_start();
if(isset($_SESSION['id_usuario'])){
    header("Location: admin.php");

}
?>
<?php
if(isset($_POST['pp'])){
 
    $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
    $password = mysqli_real_escape_string($conexion, $_POST['pass']);


    
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    $rows = $resultado->fetch_assoc();


    if(password_verify($password,$rows['Contrasenia'])){
        $_SESSION['user']=$rows['Nombre'];
        $_SESSION['id_usuario'] = $rows["idusuarios"];
        header("Location: admin.php");
        //echo 'verificado';
        
    } else{
        echo "Contraseña incorrecta";
        session_destroy();
    }




    // if ($rows > 0) {
    //     $row = $resultado->fetch_assoc();
    //     $_SESSION['id_usuario'] = $row["idusuarios"];
    //     header("Location: admin.php");
    //     } else {
    //         echo "<script>
    //                 alert('Los datos ingresados son incorrectos');
    //                 windows.location = 'index.php';
    //               </script>";
    //     }
}



if(!empty($_POST["remember"])) {
	setcookie ("user",$_POST["user"],time()+ 3600);
	setcookie ("password",$_POST["password"],time()+ 3600);
} else {
	setcookie("user","");
	setcookie("pass","");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Style/styles.css">
    
    <link href="http://fonts.cdnfonts.com/css/billabong" rel="stylesheet">
    <title>Instagram Log In</title>
</head>
<body>

    <div class="contenedor">
        <h1>Instagram</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="user" placeholder="Usuario" required <?php if(isset($_COOKIE["user"])) { echo $_COOKIE["user"]; } ?> />
            <input type="password" name="pass" placeholder="Contraseña" required <?php if(isset($_COOKIE["pass"])) { echo $_COOKIE["pass"]; } ?>/>
            <button type="submit" name="pp" class="iniciar-sesion"> Iniciar sesion </button>
            <input type="checkbox" name="remember" class="checkbox"> Recordarme
            
        </form>
<br>
        <div class="sub-contenedor">
            <img src="img/facebook.png">
            <h2 class=>Iniciar sesion con Facebook</h2>
        </div>
        
        <a href="registro.php">Registrarse en Instagram</a>
    </div>

    <footer>
        <div class="footer-content">
            <h3 class="footer-h3">  Grupo1 </h3>
            <p class="footer-p"> Alvarez Matias  Lian Samia  Gabril Fernandez. </p> 
        </div>
    </footer>
</body>
</html>

