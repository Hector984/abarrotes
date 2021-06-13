<?php

include "includes/db/conexionEncargado.php";
    $conectar = conectar();

        if (isset($_POST['add'])) {
            $nombre=$_POST['nombre'];
            $app=$_POST['app'];
            $apm=$_POST['apm'];
            $calle=$_POST['calle'];
            $numero=$_POST['numero'];
            $colonia=$_POST['colonia'];
            $municipio=$_POST['municipio'];
            $telefono=$_POST['telefono'];
            $correo=$_POST['correo'];
            $pass=$_POST['pass'];

            $verificarEmpleadoNoRegistrado = "select id_empleado from personal where ()" ;

            $registro= "INSERT INTO personal (nombre_empleado,apellido_paterno,apellido_materno,calle,numero,colonia,municipio,telefono,correo,password) VALUES ('$nombre','$app','$apm','$calle','$numero','$colonia','$municipio','$telefono','$correo','$pass');";
                        $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                if (!$resultado){
                     echo "Error al registrar datos";
                } /*else {
                            echo "Registro exitoso";
                        }*/
        }

        //Aliminar el personal del sistema por id
        if (isset($_POST['eliminar'])){
            $id=$_POST['id'];

            $eliminar ="DELETE FROM personal WHERE id_empleado = '$id'";
            $resultado=	mysqli_query($conectar,$eliminar);  //Ejecutamos la instruccion
            if (!$resultado){
                 echo "Error al registrar datos";
            }
        }

include "includes/db/consultaPersonal.php";


?>