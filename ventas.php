<?php require_once "includes/headers/header.php"; ?>

<<<<<<< HEAD

<div class="main" style="overflow:scroll">
    <h1 style="margin-bottom:15px;">Registrar venta</h1>
        <div style="border: black solid 1px;">
            <?php if(isset($_SESSION['existencia'])): ?>
                <h3 style="color:red;margin-top:15px;margin-left:15px;">El producto no existe</h3>
            <?php endif; ?>
            <form action="registrarVenta.php" method="POST">
                <div class="fila">
                    <div class="col" style="width: 20%;">
                         <label for="id">Código de producto:</label>
                    </div>
                    <div class="col">
                            <input type="number" name="id" maxlength="8">
                        </div>
                    </div>
                    
                    <div class="fila">
                        <div class="col" style="width: 20%;">
                            <label for="cantidad">Cantidad:</label>
                        </div>
                        <div class="col">
                            <input type="number" name="cantidad" min="0">
                        </div>
                    </div>

                    <div class="fila">
                        <div class="col"><input type="submit" name="add" value="Añadir" style="width: 110px;height: 30px;margin-bottom: 10px;background-color:#42b881;color:#fff;"></div>
                        <div class="col">
                            <button style="width: 110px;height: 30px;margin-bottom: 10px;background-color:#42b881;color:#fff;">
                                <a href="finalizarVenta.php" style="color:#fff;text-decoration:none;">Finalizar</a>
                            </button>
                            
                        </div>
                    </div>
                </div>

            </form>
            <div class="col" style="width: 100%; border: black solid 1px;margin-top:15px;text-align:center;overflow:scroll">
                <p style = "font-size:20px;">Ticket de compra</p><br>
                    <table> 
                        <tr>
                            <th>Codigo del producto</th>
                            <th>Nombre del producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Precio total</th>
                        </tr>
                        <!--Llenamos la tabla dinamicamente-->
                        <?php if(isset($_SESSION['venta'])):?>
                            <?php foreach($_SESSION['venta'] as $key):?>
                                <tr> 
                                    <?php foreach($key as $val): ?>
                                            <td><?= $val ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            
                            <?php if(isset($_SESSION['total'])): ?> 
                                <td>Total a pagar:</td>           
                                <td><?= $_SESSION['total'] ?></td>
                            <?php endif; ?>            
                        </tr>
                    </table>
=======
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
>>>>>>> alter

                <br>
            </div>
        </div><br>
            
</div>

<?php include "includes/footer.php"; ?>
