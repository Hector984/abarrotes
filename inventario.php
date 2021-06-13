<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventario</title>
        <link rel="stylesheet" href="styles.css" />
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
        <style> .inputtxt { width:90%; } </style>
    </head>

    <body>
        <div class="container">
            <?php
                include "includes/header.php";
                include "includes/db/conexionEncargado.php";
                $conectar = conectar();
            ?>
            
            <div class="main">
                
                <div class="fila">
                    <div class="col" style="width: 25%;"></div>
                    <div class="col" style="width: 50%; border: 1px solid black;">
                        <h2>Registrar compra de inventario</h2><br>
                        <form action="inventario.php" method="POST">
                            
                            <div class="fila">
                                <div class="col" style="width:100%;">
                                    <label for="proveedor">Proveedor y producto:</label><br>
                                    <select name="proveedor" id="proveedor" onchange="cambiarProductos()"> 
                                        <option value="">-- Proveedor --</option> 
                                        <?php
                                            $optionProveedor="select id_proveedor, nombre_proveedor from proveedores";
                                            $ejecutaConsulta=mysqli_query($conectar, $optionProveedor);
                                            $VerFilas=mysqli_num_rows($ejecutaConsulta);
                                            $filas=mysqli_fetch_array($ejecutaConsulta);
                                            
                                            for($i=0; $i<=$filas; $i++){
                                                echo "<option value='$filas[0]'>$filas[1]</option>";
                            
                                                $filas=mysqli_fetch_array($ejecutaConsulta); //consulta en el parametro arreglo
                                            }
                                        ?>
                                    </select> 
                                    <select name="producto" id="producto"></select> 
                                    <?php
                                        echo "<script>
                                        var productosDisponibles = {};";
                                        $conteoProductosPorProveedor = "select * from vista_conteoProductosPorProveedor";
                                        $ejecutaConsulta=mysqli_query($conectar, $conteoProductosPorProveedor);
                                        $VerFilas=mysqli_num_rows($ejecutaConsulta);
                                        $filas=mysqli_fetch_array($ejecutaConsulta);

                                        for($i=0; $i<=$filas; $i++){
                                            
                                            $productosPorProveedor = "select producto from vista_productosPorProveedor where id_proveedor = ".$filas[0];
                                            $ejecutaConsulta_=mysqli_query($conectar, $productosPorProveedor);
                                            $VerFilas_=mysqli_num_rows($ejecutaConsulta_);
                                            $filas_=mysqli_fetch_array($ejecutaConsulta_);

                                            echo "productosDisponibles['$filas[0]'] = [";
                                            for ($j=0; $j<$filas[2] ; $j++) {
                                                if($j==$filas[2]-1){
                                                    echo "'$filas_[0]'";
                                                } else {
                                                    echo "'$filas_[0]',";
                                                }
                                                $filas_=mysqli_fetch_array($ejecutaConsulta_);
                                            }
                                            echo "];";
                                            $filas=mysqli_fetch_array($ejecutaConsulta);
                                        }

                                        echo "function cambiarProductos() {
                                                var listaProveedores = document.getElementById('proveedor');
                                                var listaProductos = document.getElementById('producto');
                                                var selPro = listaProveedores.options[listaProveedores.selectedIndex].value;
                                                while (listaProductos.options.length) {
                                                    listaProductos.remove(0);
                                                }
                                                var prods = productosDisponibles[selPro];
                                                if (prods) {
                                                    var i;
                                                    for (i = 0; i < prods.length; i++) {
                                                        var produc = new Option(prods[i], i);
                                                        listaProductos.options.add(produc);
                                                    }
                                                }
                                            }
                                        </script>";
                                    ?>
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="cantidad">Cantidad:</label><br>
                                    <input class="inputtxt" type="number" name="cantidad" min="1">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="fecha">Fecha:</label><br>
                                    <input class="inputtxt" type="datetime-local" name="fecha">
                                </div>
                            </div>

                            <input style="font-size:15px;width:20%;" type="submit" name="add" value="Añadir">

                        </form>
                    </div>
                </div><br>

                <?php
                    if (isset($_POST['add'])) {
                        $proveedor=$_POST['proveedor'];
                        $producto=$_POST['producto'];
                        $cantidad=$_POST['cantidad'];
                        $fecha=$_POST['fecha'];

                        echo "$proveedor,$producto,$cantidad,$fecha";

                        if (empty($proveedor)||empty($producto)||empty($cantidad)||empty($fecha)){
                            //Datos incompletos
                            echo "<p style='text-align:center'>Datos incompletos, verifique la información introducida</p><br>";
                        } else {
                            //Obtener id de proveedor e id de producto
                            $obtenerIdProveedor=mysqli_fetch_array(mysqli_query($conectar,"SELECT id_proveedor FROM proveedores WHERE nombre_proveedor = '$proveedor'"));
                            echo $obtenerIdProveedor[0];

                            //Registrar compra de inventario
                            /*$consulta="INSERT INTO inventario VALUES(FORMAT(TIME, 'yyyy-MM-ddTHH:mm:ss'))";
                            $ejecutaConsulta=mysqli_query($conectar, $consulta);
                            $VerFilas=mysqli_num_rows($ejecutaConsulta);
                            $filas=mysqli_fetch_array($ejecutaConsulta);*/

                        }
                    }
                    
                    include "includes/db/consultaProveedores.php";

                ?>
            </div>
        </div>

        <!--Archivos de Javascript-->
        <script src="script.js"></script>
    </body>
    
    <?php include "includes/footer.php";?>
</html>