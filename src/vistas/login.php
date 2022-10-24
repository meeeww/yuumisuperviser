<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <tittle></tittle>
    <link rel="stylesheet" href="src/styles/login.css">
    <link rel="stylesheet" href="../styles//login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
    <div class="box">
        <form class="form" method="post" action="">
            <h2>Yuumi Superviser</h2>
            <div class="inputBox">
                <input type="usuario" id="usuario" class="input" name="usuario" required="required">
                <span>Username</i></span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" id="password" class="input" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="http://localhost/YuumiSuperviser/forgotpassword">Forgot Password</a>
                <a href="http://localhost/YuumiSuperviser/signup">Sign Up</a>
            </div>
            <input type="submit" value="Login" name="yuumilogin">
        </form>
    </div>
</body>

</html>