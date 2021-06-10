<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ventas</title>
        <link rel="stylesheet" href="styles.css" />
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
    </head>

    <body>
        <div class="container">
            <?php include "includes/header.php"; $cadena?>
        </div>
        
        <div class="main">
            <div style="border: black solid 1px;" class="fila">
                <form action="ventas.php" method="POST">
                    <div class="col" style="width:30%;">
                        <label for="id">Código de producto:</label>
                        <input type="number" name="id" id="id" maxlength="8">
                    </div>
                    
                    <div class="col" style="width:30%;">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" min="0">
                    </div>

                    <div class="col" style="width:40%;">
                        <input type="submit" name="enviar" id="enviar" value="Enviar" style="width: 100px; height: 30px;"><br><br>
                        <input type="submit" name="add" id="add" value="Añadir" style="width: 100px; height: 30px;">
                    </div>
                </form>

            </div><br>
            <div class="fila" style="width: 100%; border: black solid 1px; padding: 10px;">
                <p style = "font-size:20px;">Ticket</p><br>
                
                <table id="tabla"> 
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>

                    <?php
                        include "includes/db/conexion.php";
                        $i=0;
                        if(isset($_POST['add'])){
                            $conectar = conectar();

                            $id_producto = $_POST['id'];
                            $cantidad_producto = $_POST['cantidad'];

                            $consulta="select cantidad from productos where id_producto = $id_producto;";
                            $ejecutaConsulta=mysqli_query($conectar, $consulta);
                            $filas=mysqli_fetch_array($ejecutaConsulta);

                            if((strlen($_POST['id'])>0 && strlen($_POST['id'])<=8) && strlen(($_POST['cantidad'])>0 && ($_POST['cantidad'])>0)){
                                $nombre_producto = mysqli_fetch_array(mysqli_query($conectar,"select nombre_producto from productos where id_producto = $id_producto"));
                                $cadena[$i][0] = $nombre_producto[0];
                                $cadena[$i][1] = $id_producto;
                                $cadena[$i][2] = $cantidad_producto;

                                echo $i;
                                echo $cadena[$i][0].",".$cadena[$i][1].",".$cadena[$i][2];
                                
                                for ($j=0; $j <= $i ; $j++) { 
                                    echo "<tr> <td>".$cadena[$j][0]."</td> <td>".$cadena[$j][2]."</td> </tr>";
                                }
                                
                                $i++;
                            } else {
                                
                            }
                        }
                    ?>

                </table>

                <br>
            </div>
        </div>

        <script src="script.js"></script>
    </body>

    <?php include "includes/footer.php"; ?>
</html>