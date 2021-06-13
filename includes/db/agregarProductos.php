<?php
require_once "consultaProductos.php";
    $conectar = conectar();

    if (isset($_POST['add'])) {
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];
        $codigo=$_POST['codigo'];
        $error = array();

        //if(empty($nombre)){
            //$errores['nombre'];
       // }

        if ((empty($nombre) && empty($precio) && empty($cantidad) && empty($codigo)|| (!empty($nombre) && empty($precio) && empty($cantidad) && empty($codigo)) || (!empty($nombre) && !empty($precio) && !empty($cantidad) && empty($codigo)))){
            //Registro de datos incorrectos
            $error['error'] = "Error al registrar el producto";
           $_SESION['errorRegistro'] = $error;
            echo "<p style='text-align:center'>Datos incorrectos, verifique la información introducida 1</p><br>";

        } else if (!empty($nombre) && empty($precio) && !empty($cantidad)){
            //Registro de nombre y cantidad, caso de actualizacion

            $consultaProducto ="SELECT nombre_producto FROM productos WHERE nombre_producto = '$nombre'";
            $ejecutaConsulta=mysqli_query($conectar, $consultaProducto);
            $VerFilas=mysqli_num_rows($ejecutaConsulta);
            
            //Actualiza la cantidad
            if($VerFilas == 1){
                $actualizarCantidad = "UPDATE productos set cantidad = cantidad + $cantidad WHERE nombre_producto = '$nombre'";
                $resultado = mysqli_query($conectar, $actualizarCantidad);
                if (!$resultado){
                    $_SESION['errorRegistro'] = $resultado;
                    echo "<p style='text-align:center'>Error al registrar 2</p><br>";
                } else {
                    echo "<p style='text-align:center'>Actualizacion de cantidad del producto: $nombre, +$cantidad unidades</p><br>";
                }


            }
        } else if(!empty($nombre) && !empty($precio) && !empty($cantidad) && !empty($codigo)){
            //Registro con todos los campos llenos
            
            $consultaProducto ="SELECT nombre_producto FROM productos WHERE nombre_producto = '$nombre'";
            $ejecutaConsulta=mysqli_query($conectar, $consultaProducto);
            $VerFilas=mysqli_num_rows($ejecutaConsulta);
            
            //Si ya existe, solo actualiza la cantidad
            if($VerFilas == 1){
                $actualizarCantidad = "UPDATE productos SET cantidad = cantidad + $cantidad WHERE nombre_producto = '$nombre'";
                $resultado = mysqli_query($conectar, $actualizarCantidad);
                if (!$resultado){
                    $_SESION['errorRegistro'] = "Error al registrar el producto";
                    echo "<p style='text-align:center'>Error al registrar 4</p><br>";
                   
                } else {
                    
                    $_SESSION['actualizarCantidad'] = $resultado;
                    echo "<p style='text-align:center'>Actualizacion de cantidad del producto: $nombre, +$cantidad unidades</p><br>";
                }

            //Si no existe, lo añade
            } else if ($VerFilas == 0){
                $registro= "INSERT INTO productos (id_producto,nombre_producto,precio_venta,precio_neto,cantidad) VALUES ($codigo,'$nombre',$precio,$precio/1.16,$cantidad);";
                $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                
                $_SESSION['registro'] = $resultado;
                
                if (!$resultado){
                    $_SESION['errorRegistro'] = "Error al registrar el producto";
                    echo "<p style='text-align:center'>Error al registrar</p><br>";
                } else {
                    echo "<p style='text-align:center'>Registro exitoso</p><br>";
                }
            }

        //DESCARTADO REGISTRO SIN CODIGO
        } /*else if (!empty($nombre) && !empty($precio) && !empty($cantidad) && empty($codigo)){
            //Registro con datos, menos el código de producto, asignado por el sistema
            $consultaProducto ="SELECT nombre_producto FROM productos WHERE nombre_producto = '$nombre'";
            $ejecutaConsulta=mysqli_query($conectar, $consultaProducto);
            $VerFilas=mysqli_num_rows($ejecutaConsulta);
            
            //Si ya existe, solo actualiza la cantidad
            if($VerFilas == 1){
                $actualizarCantidad = "UPDATE productos set cantidad = cantidad + $cantidad WHERE nombre_producto = '$nombre'";
                $resultado = mysqli_query($conectar, $actualizarCantidad);
                if (!$resultado){
                    echo "<p style='text-align:center'>Error al registrar</p><br>";
                } else {
                    echo "<p style='text-align:center'>Actualizacion de cantidad del producto: $nombre, +$cantidad unidades</p><br>";
                }

            //Si no existe, lo añade, el codigo lo asigna la BD
            } else if ($VerFilas == 0){
                $registro= "INSERT INTO productos (nombre_producto,precio_venta,precio_neto,cantidad) VALUES ('$nombre',$precio,$precio/1.16,$cantidad);";
                $resultado=	mysqli_query($conectar,$registro);
                if (!$resultado){
                    echo "<p style='text-align:center'>Error al registrar</p><br>";
                } else {
                    echo "<p style='text-align:center'>Registro exitoso</p><br>";
                }
            }
            
        }*/

    }

    header("Location:../../productos.php");
?>
