<?php require_once "includes/headers/header.php"; ?>
        <div class="container">
            
            <div class="main" style="height: auto;display:flex;justify-content:space-around;">
                
                <div class="fila" style="display:flex;justify-content:space-around;">
                    <div class="col" style="width: 50%; border: 1px solid black;">
                        <h2 style="text-align:center;margin:10px 0;">Registrar nuevo empleado</h2><br>
                        <form action="personal.php" method="POST">
                            
                            <h3 style="margin-left:20px;">Nombre</h3>

                            <div class="fila" style="display:flex;justify-content:space-around;margin-bottom:10px;">
                                <div class="col" style="width: 30%;">
                                    <label for="nombre">Nombre(s):</label><br>
                                    <input type="text" name="nombre" maxlength="50" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 30%;">
                                    <label for="app">Apellido paterno:</label><br>
                                    <input type="text" name="app" maxlength="50" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 30%;">
                                    <label for="apm">Apellido materno:</label><br>
                                    <input type="text" name="apm" maxlength="50" style="margin-top:10px;">
                                </div>
                            </div>

                            <h3 style="margin-left:20px;">Direccion</h3><br>

                            <div class="fila" style="margin-left:5px;">
                                <div class="col" style="width: 50%;">
                                    <label for="calle">Calle:</label><br>
                                    <input class="inputtxt" type="text" name="calle" maxlength="50" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="numero">Numero:</label><br>
                                    <input class="inputtxt" type="text" name="numero" maxlength="10" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="colonia">Colonia:</label><br>
                                    <input class="inputtxt" type="text" name="colonia" maxlength="50" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="municipio">Municipio:</label><br>
                                    <input class="inputtxt" type="text" name="municipio" maxlength="50" style="margin-top:10px;">
                                </div>
                            </div><hr>

                            <div class="fila" style="margin-left:5px;">
                                <div class="col" style="width: 50%;">
                                    <label for="cargo">Cargo:</label><br>
                                    <input class="inputtxt" type="text" name="cargo" minlength="8" maxlength="9" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="telefono">Telefono:</label><br>
                                    <input class="inputtxt" type="text" name="telefono" minlength="10" maxlength="10" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="correo">Correo:</label><br>
                                    <input class="inputtxt" type="email" name="correo" style="margin-top:10px;">
                                </div>
                                <div class="col" style="width: 50%;">
                                    <label for="pass">Contraseña:</label><br>
                                    <input class="inputtxt" type="password" name="pass" style="margin-top:10px;">
                                </div>
                            </div><br>

                            <input style="width: 100px;height: 30px;margin-bottom: 20px;background-color:#42b881;color:#fff;margin-left:20px; " type="submit" name="add" value="Añadir">

                        </form>
                    </div>
                    <div class="col"></div>
                    <div class="col" style="width: 40%; border: 1px solid black;height:225px;">
                        <h2 style="text-align:center;margin:10px 0;margin-bottom:44px;">Eliminar empleado del registro</h2><br>
                        <form action="personal.php" method="POST">
                            <label for="id">Id de empleado:</label><br>
                            <input class="inputtxt" type="text" name="id" maxlength="50" style="margin-top:10px;"><br><br>

                            <input type="submit" name="eliminar" value="Eliminar" style="width: 100px;height: 30px;margin-bottom: 20px;background-color:#42b881;color:#fff ">

                        </form>
                    </div>
                </div><br>


                <?php
                
                    //include "includes/db/conexionEncargado.php";
                    $conectar = conectar();

                    if (isset($_POST['add'])) {
                        $nombre=$_POST['nombre'];
                        $app=$_POST['app'];
                        $apm=$_POST['apm'];
                        $calle=$_POST['calle'];
                        $numero=$_POST['numero'];
                        $colonia=$_POST['colonia'];
                        $municipio=$_POST['municipio'];
                        $telefono=$_POST['telefono'];
                        $correo=$_POST['correo'];
                        $pass=$_POST['pass'];
                        $cargo=$_POST['cargo'];

                        if (empty($nombre)||empty($app)||empty($apm)||empty($calle)||empty($numero)||empty($colonia)||empty($municipio)||empty($telefono)||empty($correo)||empty($pass)||empty($cargo)) {
                            //datos incompletos
                            echo "<p style='text-align:center'>Datos incompletos, verifique la información introducida</p><br>";

                        } else {
                            //datos completos, verificar no esté previamente registrado
                            $verificarEmpleadoNoRegistrado = "SELECT id_empleado FROM personal WHERE (nombre_empleado = '$nombre') AND (apellido_paterno = '$app') AND (apellido_materno = '$apm');" ;
                            
                            $ejecutaConsulta=mysqli_query($conectar, $verificarEmpleadoNoRegistrado);
                            
                            $VerFilas=mysqli_num_rows($ejecutaConsulta);
                            $filas=mysqli_fetch_array($ejecutaConsulta);

                            if ($VerFilas == 1) {
                                //Ya existe el empleado
                                echo "<p style='text-align:center'>Empleado ya registrado, cuenta con el Id de empleado : ".$filas[0]."</p><br>";

                            } else {
                                //Registrar nuevo empleado

                                if ($cargo == "encargado"){
                                    //Verificar la existencia de un solo encargado
                                    $verificarEncargadoNoRegistrado="select id_empleado from personal where cargo = 'encargado'";

                                    $ejecutaConsulta=mysqli_query($conectar, $verificarEncargadoNoRegistrado);
                                    $VerFilas=mysqli_num_rows($ejecutaConsulta);
                                    $filas=mysqli_fetch_array($ejecutaConsulta);

                                    if($VerFilas==1) {
                                        //Ya existe un encargado, notifica de su registro, pero como empleado
                                        echo "<p style='text-align:center'>Encargado ya registrado, solo puede haber un encargado, Id de empleado : ".$filas[0]."</p><br>";
                                        echo "<p style='text-align:center'>Nuevo empleado registrado como \"empleado\"</p><br>";
                                        $registro= "INSERT INTO personal (nombre_empleado,apellido_p,apellido_m,calle,numero,colonia,municipio,telefono,correo,password) VALUES ('$nombre','$app','$apm','$calle','$numero','$colonia','$municipio','$telefono','$correo','$pass');";
                                        $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                                        if (!$resultado){
                                            echo "<p style='text-align:center'>Error al registrar</p><br>";
                                        } else {
                                            echo "<p style='text-align:center'>Registro exitoso</p><br>";
                                        }

                                    } else {
                                        //Se registra encargado
                                        $registro= "INSERT INTO personal (nombre_empleado,apellido_p,apellido_m,calle,numero,colonia,municipio,cargo,telefono,correo,password) VALUES ('$nombre','$app','$apm','$calle','$numero','$colonia','$municipio','$cargo','$telefono','$correo','$pass');";
                                        $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                                        if (!$resultado){
                                            echo "<p style='text-align:center'>Error al registrar</p><br>";
                                        } else {
                                            echo "<p style='text-align:center'>Registro exitoso</p><br>";
                                        }
                                    }
                                } else if ($cargo == "empleado"){
                                    //Se registra empleado
                                    $registro= "INSERT INTO personal (nombre_empleado,apellido_p,apellido_m,calle,numero,colonia,municipio,telefono,correo,password) VALUES ('$nombre','$app','$apm','$calle','$numero','$colonia','$municipio','$telefono','$correo','$pass');";
                                    $resultado=	mysqli_query($conectar,$registro);  //Ejecutamos la instruccion
                                    if (!$resultado){
                                        echo "<p style='text-align:center'>Error al registrar</p><br>";
                                    } else {
                                        echo "<p style='text-align:center'>Registro exitoso</p><br>";
                                    }
                                } else {
                                    echo "<p style='text-align:center'>Error al registrar, verifique la información introducida</p><br>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['eliminar'])){
                        $id=$_POST['id'];

                        $eliminar ="DELETE FROM personal WHERE id_empleado = '$id'";
                        $resultado=	mysqli_query($conectar,$eliminar);  //Ejecutamos la instruccion
                        if (!$resultado){
                            echo "<p style='text-align:center'>Error al eliminar empleado</p><br>";
                        }
                    }

                    //include "includes/db/consultaPersonal.php";
                    
                ?>
            </div>
            
        </div>

        <!--Archivos de Javascript-->
        <script src="script.js"></script>

    
    <?php include "includes/footer.php";?>
