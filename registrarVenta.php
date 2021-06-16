<?php
    require_once "includes/db/conexionEncargado.php";

    $conectar = conectar();
    $metodoPago = $_POST['metodo'];
                        
        if(isset($_POST['add'])){
            
           
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
            header("Location:ventas.php");
            }//Fin del if
        }//Fin del POSt['add']
        
        if(isset($_POST['enviar'])){
             //Insertamos en la tabla compras
            $idEmpleado = $_SESSION['usuario']['id_empleado'];
            $compra = "INSERT INTO compra VALUES(null,null,$idEmpleado,CONCAT(CURDATE(),' ',CURTIME()),'$metodoPago');";
            
            $queryCompra = mysqli_query($conectar,$compra);
            //$compraProductos = mysqli_fetch_assoc($queryCompra);
            

             //Insertar en ticket
             $sqlLastId = "SELECT LAST_INSERT_ID() AS 'compra';";
             $queryId = mysqli_query($conectar,$sqlLastId);
             $compra_id = mysqli_fetch_assoc($queryId); 
             $compra_id = (int)$compra_id['compra'];
             //var_dump(gettype($_SESSION['venta'][1]['id_producto']));
            
            for($i = 0;$i < count($_SESSION['venta']); $i++){
                
                $idP = (int)$_SESSION['venta'][$i]['id_producto'];//id del producto
                $cant = (int)$_SESSION['venta'][$i]['cantidad'];//cantidad del producto
                
                $sqlTicket = "INSERT INTO ticket VALUES (null,$compra_id,$idP,$cant);";
                
                $queryTicket = mysqli_query($conectar,$sqlTicket);
                
            }//Fin del for
            
            header("Location:finalizarVenta.php");
        }//Fin del POSt['enviar']

    //header("Location:ventas.php");
?>