<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal</title>
        <link rel="stylesheet" href="styles.css" />
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
        <style>
            label {
                height: 50px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <?php include "includes/header.php" ?>
            
            <div class="main">
                
                <div class="fila">
                    <div class="col" style="width: 40%; border: 1px solid black;">
                        <h2>Registrar compra de inventario</h2><br>
                        <form action="personal.php" method="POST">
                            
                            <label for="">datos...:</label><br>
                            <input class="inputtxt" type="text" name="" maxlength="50"><br><br>


                        </form>
                    </div>
                </div><br>


                <?php
                    include "includes/db/conexionEncargado.php";
                    $conectar = conectar();

                    //include "includes/db/consultaInventario.php";

                ?>
            </div>
        </div>

        <!--Archivos de Javascript-->
        <script src="script.js"></script>
    </body>
    
    <?php include "includes/footer.php";?>
</html>