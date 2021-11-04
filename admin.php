<?php
include("conexion.php");



session_start();
if(!isset($_SESSION['id_usuario'])){
     header("Location: index.php");

}
$iduser =  $_SESSION['id_usuario'];

$sql = "SELECT idusuarios, Nombre, Imagen FROM usuarios WHERE idusuarios= '$iduser'";

$resultado = $conexion->query($sql);

$row = $resultado->fetch_assoc();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./Style/stylesUsuario.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

<!-- Mostar nombre de usuario -->
    <div class="container">
        <div class="relleno">
                <h1 class="tituloUsuario">Bienvenido</h1>
        
        
             <h1 class="nombre"> <?php echo utf8_decode($row['Nombre']); ?></h1>
                <div class="imagen">
                    <?php 
                        echo '  <img src ="imagenesbdd/'.$row['Imagen'].'" style="width:225px; height:225px; border-radius:46%">';
                    ?>
                </div>
                <a class="boton" href="salir.php">Salir</a>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <h3 class="footer-h3">  Grupo1 </h3>
            <p class="footer-p"> Alvarez Matias  Lian Samia  Gabriel Fernandez. </p> 
        </div>
    </footer>  
</body>
</html>