<?php
    function conectar() {
        $user = "pma";
        $pass = "";
        $server = "localhost";
        $db = "abarrotespantera";
        
        $conexion = new mysqli($server,$user,$pass,$db);

        if($conexion->connect_error) {
            die ("Problemas de conexión: ".$conexion->connect_error);
        }
        
        return $conexion;
    
    }

    /*function cerrarConexion(){
        $cerrar = mysqli_close(conectar());
        return $cerrar;
    }*/
?>