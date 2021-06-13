<?php
    require_once "includes/db/conexionEncargado.php";
                        
        if(isset($_POST['add'])){
            $conectar = conectar();
           
            $idProducto = $_POST['id'];
            $cantidadProducto = $_POST['cantidad'];

            $consulta="SELECT id_producto,nombre_producto,cantidad,precio_venta,(precio_venta*$cantidadProducto) AS 'unitario' FROM productos WHERE id_producto = $idProducto;";
            $ejecutaConsulta=mysqli_query($conectar, $consulta);
            $filas=mysqli_fetch_array($ejecutaConsulta, MYSQLI_ASSOC);
            $filas['cantidad'] = $cantidadProducto;
            
            //var_dump($_SESSION['venta']);
            /*$i =0;
            foreach($_SESSION['venta'] as $key => $v){
                foreach($key as $l => $val){
                    echo $val."</br>";  
                }
            }*/
            
            //Verificar si existe el id o no
            if(mysqli_num_rows($ejecutaConsulta) == 0){
                $_SESSION["existencia"]= $ejecutaConsulta;
            }else{
                $_SESSION['venta'][] = array(
                    "id_producto" => $filas['id_producto'],
                    "nombre_producto" => $filas['nombre_producto'],
                    "cantidad" => $filas['cantidad'],
                    "precio_venta" => $filas['precio_venta'],
                    "unitario" => $filas['unitario']
                );
                if(!isset($_SESSION['total'])){
                    $_SESSION['total'] = $filas['unitario'];
                }else{
                    $_SESSION['total'] += $filas['unitario'];
                }

                //Actualizamos la tabla de productos
                $actualizar = "UPDATE productos SET cantidad = (cantidad-$cantidadProducto) WHERE id_producto = $idProducto;";
                $queryActualizar = mysqli_query($conectar,$actualizar);

                //unset($_SESSION['venta']);
                //unset($_SESSION['total']);
            //header("Location:ventas.php");
            }
        }
        
        if(isset($_POST['enviar'])){
            header("Loction:finalizarVenta.php");
        }
    header("Location:ventas.php");
?>