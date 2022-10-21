<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <tittle></tittle>
        <link rel="stylesheet" href="src/styles/signup.css">
    </head>
    <body>
        <?php
        include "conexion_db.php";
        include "controlador.php";
        ?>
        <div class="box">
            <form class="form" method="post" action="">
                <h2>Yuumi Superviser</h2>
                <div class="inputBox">
                    <input type="usuario" id="usuario" class="input" name="usuario" required="required">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="email" id="email" class="input" name="email" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" id="password" class="input" name="password" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="http://localhost/YuumiSuperviser/forgotpassword">Forgot Password</a>
                    <a href="http://localhost/YuumiSuperviser/login">Sign In</a>
                </div>
                <input type="submit" name="btningresar" class="btn" value="Sign Up">
            </div>
        </div>
    </body>
</html>