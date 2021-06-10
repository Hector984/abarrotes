<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Productos</title>
        <link rel="stylesheet" href="styles.css" />
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
    </head>

    <body>
        <div class="container">
            <?php include "includes/header.php" ?>

            <div class="main">
                <?php
                    if ($usuario=="encargado") {
                        include "includes/db/conexionEncargado.php";
                        include "includes/db/agregarProductos.php";
                    } else {
                        include "includes/db/conexion.php";
                    }
                    
                    include "includes/db/consultaProductos.php";
                ?>
            </div>
        </div>

        <script src="script.js"></script>
    </body>

    <?php include "includes/footer.php"; ?>
</html>