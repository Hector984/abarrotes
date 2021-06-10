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
            <?php include "includes/header.php"; $cadena="_"?>
        </div>

        <div class="main">
            <div style="border: black solid 1px;">
                <form action="ventas.php" method="POST">
                    <div class="fila">
                        <div class="col" style="width: 20%;"><label for="id">Código de producto</label></div>
                        <div class="col"><input type="number" name="id" maxlength="8"></div>
                    </div>
                    
                    <div class="fila">
                        <div class="col" style="width: 20%;"><label for="cantidad">Cantidad</label></div>
                        <div class="col"><input type="number" name="cantidad" min="0"></div>
                    </div>

                    <div class="fila">
                        <div class="col"><input type="submit" name="add" value="Añadir" style="width: 100px; height: 30px;"></div>
                        <div class="col"><input type="submit" name="enviar" value="Enviar" style="width: 100px; height: 30px;"></div>
                    </div>

                </form>
            </div><br>
            <div class="col" style="width: 100%; border: black solid 1px;">
                <p style = "font-size:20px;">Ticket</p><br>
                <table> 
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>

                    <?php
                        include "includes/db/conexion.php";
                        
                        if(isset($_POST['add'])){
                            $conectar = conectar();

                            $id_producto = $_POST['id'];
                            $cantidad_producto = $_POST['cantidad'];

                            $consulta="select cantidad from productos where id_producto = $id_producto;";
                            $ejecutaConsulta=mysqli_query($conectar, $consulta);
                            $filas=mysqli_fetch_array($ejecutaConsulta);

                            if((strlen($_POST['id'])>0 && strlen($_POST['id'])<=8) && strlen(($_POST['cantidad'])>0 && ($_POST['cantidad'])<=$filas[0])){
                                $nombre_producto=mysqli_fetch_array(mysqli_query($conectar,"select nombre_producto from productos where id_producto = $id_producto"));
                                $cadena = $cadena.$id_producto.",".$cantidad_producto."_";
                                echo $cadena;
                                
                            } else {
                                echo $cadena;
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