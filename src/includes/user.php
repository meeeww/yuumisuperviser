<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;
    private $rol;


    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :user AND contrasena = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);
        if($query->rowCount()){
            $_SESSION["logged"]=true;
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->username = $currentUser['nombre_usuario'];
            $this->rol = $currentUser['tipo'];
        }
    }

    public function getNombre(){
        return $this->username;
        
    }
    public function getRol(){
        return $this->rol;
        
    }
    
}

?>