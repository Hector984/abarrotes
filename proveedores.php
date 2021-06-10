<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proveedores</title>
        <link rel="stylesheet" href="styles.css" />
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
        <style> .inputtxt { width:90%; } </style>
    </head>

    <body>
        <div class="container">
            <?php include "includes/header.php" ?>
            
            <div class="main">
                
                <div class="fila">
                    <div class="col" style="width: 25%;"></div>
                    <div class="col" style="width: 50%; border: 1px solid black;">
                        <h2>Registrar nuevo proveedor</h2><br>
                        <form action="proveedores.php" method="POST">
                            
                            <label for="nombre">Nombre proveedor:</label><br>
                            <input class="inputtxt" type="text" name="nombre" maxlength="50"><br><br><hr><br>

                            <h3>Direccion</h3><br>

                            <div class="fila">
                                <div class="col" style="width: 50%;">
                                    <label for="calle">Calle:</label><br>
                                    <input class="inputtxt" type="text" name="calle" maxlength="50">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="numero">Numero:</label><br>
                                    <input class="inputtxt" type="text" name="numero" maxlength="10">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="colonia">Colonia:</label><br>
                                    <input class="inputtxt" type="text" name="colonia" maxlength="50">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="municipio">Municipio:</label><br>
                                    <input class="inputtxt" type="text" name="municipio" maxlength="50">
                                </div>
                                <div class="col" style="width: 50%;">
                                <label for="telefono">Telefono:</label><br>
                                <input class="inputtxt" type="text" name="telefono" minlength="10" maxlength="10">
                            </div>
                            </div>

                            <input style="font-size:15px;width:20%;" type="submit" name="add" value="Añadir">

                        </form>
                    </div>
                </div><br>

                <?php
                    include "includes/db/conexionEncargado.php";
                    $conectar = conectar();

                    if (isset($_POST['add'])) {
                        $nombre=$_POST['nombre'];
                        $calle=$_POST['calle'];
                        $numero=$_POST['numero'];
                        $colonia=$_POST['colonia'];
                        $municipio=$_POST['municipio'];
                        $telefono=$_POST['telefono'];

                        if (empty($nombre)||empty($calle)||empty($numero)||empty($colonia)||empty($municipio)||empty($telefono)){
                            //Datos incompletos
                            echo "<p style='text-align:center'>Datos incompletos, verifique la información introducida</p><br>";

                        } else {
                            $verificarProveedorNoRegistrado = "select id_proveedor from proveedores where (nombre_proveedor = '$nombre') or ((calle = '$calle') and (numero = '$numero') and (colonia = '$colonia') and (municipio = '$municipio'));" ;
                            
                            $ejecutaConsulta=mysqli_query($conectar, $verificarProveedorNoRegistrado);
                            $VerFilas=mysqli_num_rows($ejecutaConsulta);
                            $filas=mysqli_fetch_array($ejecutaConsulta);

                            if ($VerFilas == 1){
                                //Ya existe proveedor
                                echo "<p style='text-align:center'>Proveedor ya registrado, Id de proveedor: ".$filas[0]."</p><br>";
                            } else {
                                //Registra el nuevo proveedor
                                $registro="INSERT INTO proveedores (nombre_proveedor,calle,numero,colonia,municipio,telefono_movil) VALUES ('$nombre','$calle','$numero','$colonia','$municipio','$telefono');";
                                $resultado=	mysqli_query($conectar,$registro);
                                if (!$resultado){
                                    echo "<p style='text-align:center'>Ha ocurrido un error</p><br>";
                                } else {
                                    echo "<p style='text-align:center'>Registro exitoso</p><br>";
                                }
                            }
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