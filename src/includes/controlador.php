<?php

if (!empty($_POST["btningresar"])) {
    if (empty($_POST["usuario"]) and empty($_POST["password"])) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["password"];
        $email = $_POST["email"];

        $hash = md5($contrasena);

        if (password_verify($contrasena, $hash)) {
        }

        $todolimpio = true;

        #<!--comprobar si ya existe-->
        if ($todolimpio == true) {
            $sqlcheck = $conexionsignup->query("SELECT * FROM `usuarios` WHERE `nombre_usuario` = '$usuario'");
            if ($sqlcheck->num_rows) {
                echo '<div class="alert hide">';
                echo '<span class="fas fa-exclamation-circle"></span>';
                echo '<span class="msg">Account already exists!</span>';
                echo '<div class="close-btn">';
                echo '<span class="fas fa-times"></span>';
                echo '</div>';
                echo '</div>';
                echo '<script>';
                echo "$('.alert').addClass('show');";
                echo "$('.alert').removeClass('hide');";
                echo "$('.alert').addClass('showAlert');";
                echo 'setTimeout(function(){';
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '},5000);';
                echo "$('.close-btn').click(function(){";
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '});';
                echo '</script>';
                $todolimpio = false;
            }
        }
        if ($todolimpio == true) {
            $sqlcheck = $conexionsignup->query("SELECT * FROM `usuarios` WHERE `correo_usuario` = '$email'");
            if ($sqlcheck->num_rows) {
                echo '<div class="alert hide">';
                echo '<span class="fas fa-exclamation-circle"></span>';
                echo '<span class="msg">Email already taken!</span>';
                echo '<div class="close-btn">';
                echo '<span class="fas fa-times"></span>';
                echo '</div>';
                echo '</div>';
                echo '<script>';
                echo "$('.alert').addClass('show');";
                echo "$('.alert').removeClass('hide');";
                echo "$('.alert').addClass('showAlert');";
                echo 'setTimeout(function(){';
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '},5000);';
                echo "$('.close-btn').click(function(){";
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '});';
                echo '</script>';
                $todolimpio = false;
            }
        }
        if ($todolimpio == true) {
            $sqlcheck = $conexionsignup->query("SELECT * FROM `usuarios` WHERE `nombre_usuario` = '$usuario' AND `correo_usuario` = '$email'");
            if ($sqlcheck->num_rows) {
                echo '<div class="alert hide">';
                echo '<span class="fas fa-exclamation-circle"></span>';
                echo '<span class="msg">Account already exists!</span>';
                echo '<div class="close-btn">';
                echo '<span class="fas fa-times"></span>';
                echo '</div>';
                echo '</div>';
                echo '<script>';
                echo "$('.alert').addClass('show');";
                echo "$('.alert').removeClass('hide');";
                echo "$('.alert').addClass('showAlert');";
                echo 'setTimeout(function(){';
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '},5000);';
                echo "$('.close-btn').click(function(){";
                echo "$('.alert').removeClass('show');";
                echo "$('.alert').addClass('hide');";
                echo '});';
                echo '</script>';
                $todolimpio = false;
            }
        }

        if ($todolimpio == true) {
            date_default_timezone_set('Europe/Madrid');
            $date = date('m/d/Y', time());
            $sql = $conexionsignup->query("INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo_usuario`, `contrasena`, `fecha_registro`, `tipo`, 
            `email_verificado`) VALUES (NULL, '$usuario', '$email', '$hash', '$date', '0', '0')");
            #########################
            echo '<div class="alert hide">';
            echo '<span class="fas fa-check-circle"></span>';
            echo '<span class="msg">Account created!</span>';
            echo '<div class="close-btn">';
            echo '<span class="fas fa-times"></span>';
            echo '</div>';
            echo '</div>';
            echo '<script>';
            echo "$('.alert').addClass('show');";
            echo "$('.alert').removeClass('hide');";
            echo "$('.alert').addClass('showAlert');";
            echo 'setTimeout(function(){';
            echo "$('.alert').removeClass('show');";
            echo "$('.alert').addClass('hide');";
            echo '},5000);';
            echo "$('.close-btn').click(function(){";
            echo "$('.alert').removeClass('show');";
            echo "$('.alert').addClass('hide');";
            echo '});';
            echo '</script>';
        }
    }
}
