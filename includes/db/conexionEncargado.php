<?php
    function conectar() {
        $user = "root";
        $pass = "";
        $server = "localhost";
        $db = "abarrotes";//abarrotespantera
        
        $conexion = new mysqli($server,$user,$pass,$db);

        if($conexion->connect_error) {
            die ("Problemas de conexión: ".$conexion->connect_error);
        }

        return $conexion;
    
    }

    function cerrarConexion(){
        $cerrar = mysqli_close(conectar());
        return $cerrar;
    }
    
    //Esto lo agregue por el conflicto d elas sesiones. NO hay que borrarlo
    if(!isset($_SESSION)){
        session_start();
    }
    
?>