<div class="fila">
    <div class="col" style="width: 25%;"></div>
    <div class="col" style="width: 50%; border: 1px solid black;">
        <h2>Agregar nuevo producto</h2><br>
        <form action="productos.php" method="POST">
            <style> .inputtxt { width:70%; } </style>
            
            <label for="nombre">Nombre del producto:</label><br>
            <input class="inputtxt" type="text" name="nombre" maxlength="50"><br><br>

            <label for="precio">Precio de venta:</label><br>
            <input class="inputtxt" type="number" step="0.01" max="1000" name="precio"><br><br>

            <label for="cantidad">Cantidad:</label><br>
            <input class="inputtxt" type="number" name="cantidad" min="1"><br><br>

            <label for="codigo">Código de producto:</label><br>
            <input class="inputtxt" type="number" name="codigo" max="99999999"><br><br>

            <input style="font-size:15px;width:20%;" type="submit" name="add" value="Añadir">

        </form>
    </div>
</div><br>


<?php
    $conectar = conectar();

    if (isset($_POST['add'])) {
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];
        $codigo=$_POST['codigo'];

        if ((empty($nombre) && empty($precio) && empty($cantidad) && empty($codigo)|| (!empty($nombre) && empty($precio) && empty($cantidad) && empty($codigo)) || (!empty($nombre) && !empty($precio) && !empty($cantidad) && empty($codigo)))){
            //Registro de datos incorrectos
            echo "<p style='text-align:center'>Datos incorrectos, verifique la información introducida</p><br>";

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
                    echo "<p style='text-align:center'>Error al registrar</p><br>";
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
                $actualizarCantidad = "UPDATE productos set cantidad = cantidad + $cantidad WHERE nombre_producto = '$nombre'";
                $resultado = mysqli_query($conectar, $actualizarCantidad);
                if (!$resultado){
                    echo "<p style='text-align:center'>Error al registrar</p><br>";
                } else {
                    echo "<p style='text-align:center'>Actualizacion de cantidad del producto: $nombre, +$cantidad unidades</p><br>";
                }

            //Si no existe, lo añade
            } else if ($VerFilas == 0){
                $registro= "INSERT INTO productos (id_producto,nombre_producto,precio_venta,precio_neto,cantidad) VALUES ($codigo,'$nombre',$precio,$precio/1.16,$cantidad);";
                $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                if (!$resultado){
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
?>
