<?php
/* Incluye el archivo de conexion */
include("conexion.php");
/* ----------------------------------- */

/* Registro */
if (isset($_POST['registrar'])){
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
    $password = mysqli_real_escape_string($conexion, $_POST['pass']);
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        $archivo = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'imagenesbdd/'.$archivo);
    }
    $sqluser = "SELECT idusuarios FROM usuarios WHERE usuario = '$usuario' ";
    $resultadouser = $conexion->query($sqluser);
    $filas =$resultadouser->num_rows;
    if ($filas > 0) {
        echo "<script>
                alert('El usuario ya existe');
                window.location = 'index.php';
                </script> ";
    } else {
        $sqlusuario = "INSERT INTO usuarios(
                Nombre, Correo, Usuario, Contrasenia, Imagen)
                VALUES ('$nombre', '$correo', '$usuario', '$password_encriptada', '$archivo')";
        $resultadousuario = $conexion->query($sqlusuario);
        if ($resultadousuario > 0) {
            echo "<script>
                alert('Registro exitoso');
                window.location = 'index.php';
                </script>";
        } else{
            echo "<script>
                alert('Error al registrarse');
                window.location = 'index.php';
                </script>";
        }

    }
}
/* -------- */


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Style/styles2.css">
    <link href="http://fonts.cdnfonts.com/css/billabong" rel="stylesheet">
    <title>Instagram Sing Up</title>
</head>
<body>
    <div class="contenedor" id="contenedor-form-registro">
        <a href= "index.php" class="titulo-h1"><h1>Instagram</h1></a>
        <h2 class="registro-h2">Registro</h2>
        <form action="registro.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre Completo"required/>
            <input type="email" name="correo" placeholder="Email" required/>
            <input type="text" name="user" placeholder="Usuario" required/>
            <input type="password" name="pass" placeholder="Contraseña" required/>
            <input type="password" name="pass" placeholder="Repetir contraseña" required/>
            <input type="file" name="foto" accept="image/png,image/jpeg" required/>
            <button type="submit" name="registrar" class="iniciar-sesion"> Registrar </button> 
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <h3 class="footer-h3">  Grupo1 </h3>
            <p class="footer-p"> Alvarez Matias  Lian Samia  Gabril Fernandez. </p> 
        </div>
    </footer>


</body>
</html>