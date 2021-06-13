<?php require_once "includes/headers/header.php"; ?>


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

                <br>
            </div>
        </div><br>
            
</div>

<?php include "includes/footer.php"; ?>
