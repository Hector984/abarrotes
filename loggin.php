<?php

//iniciamos conexion con la base de datos
$usuario = 'root';
$host = 'localhost';
$nombreBaseDatos = 'abarrotes';
$contrasenia = '';

$conexion = mysqli_connect($host,$usuario,$contrasenia,$nombreBaseDatos);

if(mysqli_connect_errno()){
    echo 'Fallo la conexion'.mysqli_error();
}

mysqli_query($conexion,'SET NAMES utf8');

if(!isset($_SESSION)){
    session_start();
}

//require_once "includes/db/conexion.php";
$email = $_POST['email'] ? mysqli_real_escape_string($conexion,trim($_POST['email'])) : false;

$pass = $_POST['password'] ? mysqli_escape_string($conexion,$_POST['password']) : false;

//Consulta para comprobar las credenciales del usuario

$querySelect = "SELECT * FROM personal WHERE email = '$email';";
$login = mysqli_query($conexion,$querySelect);

if($login && mysqly_num_rows($login) == 1){
    //Comprobar la contraseña
    $usuario = mysqli_fetch_assoc($login);

    $contraseniaVerif = password_verify($pass,$usuario['password']);

        if($contraseniaVerif){
            //Utilizamos una sesion para guardar los datos del usuario
            $_SESSION['usuario'] = $usuario;

            if($_SESSION['error_login']){
                unset($_SESSION['error_login']);
            }//fin del if
        }else{
            $_SESSION['error_login'] = "login incorrecto";
        }//fin del if

}else{
    $_SESSION['error_login'] = "login incorrecto";
}//Fin del if

//Redirigimos al index
header("Location:index.php");

?>