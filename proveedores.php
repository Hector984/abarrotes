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
        <style> .inputtxt { width:90%; } </style>
    </head>

    <body>
        <div class="container">
            <?php include "includes/header.php" ?>
            
            <div class="main">
                
                <div class="fila">
                    <div class="col" style="width: 50%; border: 1px solid black;">
                        <h2>Registrar nuevo proveedor</h2><br>
                        <form action="personal.php" method="POST">
                            
                            <label for="nombre">Nombre completo:</label><br>
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
                            </div><hr>

                            <div class="fila">
                                <div class="col" style="width: 50%;">
                                    <label for="cargo">Cargo:</label><br>
                                    <input class="inputtxt" type="text" name="cargo" minlength="8" maxlength="9">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="telefono">Telefono:</label><br>
                                    <input class="inputtxt" type="text" name="telefono" minlength="10" maxlength="10">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="correo">Correo:</label><br>
                                    <input class="inputtxt" type="email" name="correo">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="pass">Contraseña:</label><br>
                                    <input class="inputtxt" type="password" name="pass">
                                </div>
                            </div><br>

                            <input style="font-size:15px;width:20%;" type="submit" name="add" value="Añadir">

                        </form>
                    </div>
                    <div class="col"></div>
                    <div class="col" style="width: 40%; border: 1px solid black;">
                        <h2>Eliminar empleado del registro</h2><br>
                        <form action="personal.php" method="POST">
                            <label for="id">Id de empleado:</label><br>
                            <input class="inputtxt" type="text" name="id" maxlength="50"><br><br>

                            <input type="submit" name="eliminar" value="Eliminar">

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

                        $registro= "INSERT INTO personal (nombre_empleado,calle,numero,colonia,municipio,telefono) VALUES ('$nombre','$calle','$numero','$colonia','$municipio','$telefono');";
                        $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                        if (!$resultado){
                            echo "Error al registrar datos";
                        } /*else {
                            echo "Registro exitoso";
                        }*/
                    }
                    if (isset($_POST['eliminar'])){
                        $id=$_POST['id'];

                        $eliminar ="DELETE FROM personal WHERE id_empleado = '$id'";
                        $resultado=	mysqli_query($conectar,$eliminar);  //Ejecutamos la instruccion
                        if (!$resultado){
                            echo "Error al registrar datos";
                        }
                    }

                    include "includes/db/consultaPersonal.php";

                ?>
            </div>
        </div>

        <!--Archivos de Javascript-->
        <script src="script.js"></script>
    </body>
    
    <?php include "includes/footer.php";?>
</html>