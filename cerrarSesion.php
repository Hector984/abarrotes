<?php
/*Aqui voy a incluir la conexion a tu base de datos pero la voy a comentar 
Por el momento voy a añadir la conexion a mi base de datos pero la borras cuando presentemos el proyecto para no tener problemas*/

//require_once "includes/db/conexion.php";

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

//Cerramos sesion

if(isset($_SESSION['usuario'])){
    unset($_SESSION['usuario']);
    session_destroy();
}

header("Location:index.php");





?>