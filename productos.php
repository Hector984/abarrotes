<?php require_once "includes/headers/header.php" ?>
            
<div class="main">
    <div class="fila" style="text-align:center;">
        <div class="col" style="width: 25%;"></div>
            <div class="col" style="width: 50%; border: 1px solid black;margin-top:15px;">
                <h2 style="text-align:center;">Agregar nuevo producto</h2><br>
                <?php if(isset($_SESSION['registro'])): ?>
                    <h3 style="color: green;">Registro exitoso </h3>
                <?php elseif(isset($_SESSION['actualizarCantidad'])): ?>
                    <h3 style="color: blue;">Se actualizo el producto</h3>
                <?php endif; ?>
                <?php if(isset($_SESSION['errorRegistro'])): ?>
                    <h3 style="color: red;">Error al registrar el producto</h3>
                <?php endif; ?>
                <form action="includes/db/agregarProductos.php" method="POST" style="text-align:center;">
                    <style> .inputtxt { width:70%; } </style>
                    
                    <label for="nombre" >Nombre del producto:</label><br>
                    <input class="inputtxt" type="text" name="nombre" maxlength="50" style="margin-top:10px;"><br><br>

                    <label for="precio">Precio de venta:</label><br>
                    <input class="inputtxt" type="number" step="0.01" max="1000" name="precio" style="margin-top:10px;"><br><br>

                    <label for="cantidad">Cantidad:</label><br>
                    <input class="inputtxt" type="number" name="cantidad" min="1" style="margin-top:10px;"><br><br>

                    <label for="codigo">Código de producto:</label><br>
                    <input class="inputtxt" type="number" name="codigo" max="99999999" style="margin-top:10px;"><br><br>

                    <input style="width: 110px;height: 30px;margin-bottom: 10px;background-color:#42b881;color:#fff;" type="submit" name="add" value="Añadir">

                </form>
            </div><!--Fin del div-->
    </div><!--Fin del div fila-->
</div><!--Fin del div principal-->
<!--Cerramos sesion de registro exitoso-->
<?php require_once "cerrarRegistro.php"; ?>
<?php include "includes/footer.php"; ?>
