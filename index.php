<?php
include_once 'src/includes/user.php';
include_once 'src/includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    include_once 'src/vistas/home.php';

}else if(isset($_POST['usuario']) && isset($_POST['password'])){
    $userForm = $_POST['usuario'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        include_once 'src/vistas/home.php';
    }else{
            include_once 'src/vistas/login.php';
            echo '<div class="alert hide">';
            echo '<span class="fas fa-exclamation-circle"></span>';
            echo '<span class="msg">Name or password are incorrect!</span>';
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
}else{
    include_once 'src/vistas/login.php';
}
