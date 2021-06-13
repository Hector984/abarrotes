<?php
/*Aqui voy a incluir la conexion a tu base de datos pero la voy a comentar 
Por el momento voy a añadir la conexion a mi base de datos pero la borras cuando presentemos el proyecto para no tener problemas*/

//require_once "includes/db/conexionEncargado.php";

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

//Cerramos sesion de registrar producto

if(isset($_SESSION['registro'])){
    unset($_SESSION['registro']);
    //session_destroy();
}

//Cerramos sesion de actualizar producto

if(isset($_SESSION['actualizarCantidad'])){
    unset($_SESSION['actualizarCantidad']);
    //session_destroy();
}

if(isset($_SESSION['errorRegistro'])){
    unset($_SESSION['errorRegistro']);
    //session_destroy();
}

//Sesion de carrito de compra
if(isset($_SESSION['ventas'])){
    unset($_SESSION['ventas']);
}

//Sesion que arroja un error si el producto no esta en la base de datos
if(isset($_SESSION['existencia'])){
    unset($_SESSION['existencia']);
}

//Sesion del total de compra
if(isset($_SESSION['total'])){
    unset($_SESSION['total']);
}
?>