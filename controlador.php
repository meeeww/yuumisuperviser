<?php

if(!empty($_POST["btningresar"])){
    if(empty($_POST["usuario"]) and empty($_POST["password"])){
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["password"];
        $email=$_POST["email"];
        $sql=$conexion->query("INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo_usuario`, `contrasena`, `fecha_registro`, `tipo`, `suscripcion`) 
        VALUES (NULL, '.$usuario.', '.$email.', '.$contrasena.', NULL, NULL, NULL)");
        header("location: login.php");
    }
}

?>