<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Abarrotes Pantera</title>
        <link rel="stylesheet" href="styles.css" />
        <link href="css/all.css" rel="stylesheet">
        <script
            src="https://kit.fontawesome.com/5a8aa1d43e.js"
            crossorigin="anonymous"
        ></script>
    </head>
    
    <body>
    <?php include "includes/db/conexionEncargado.php"; ?>
        <div class="container">
            
            <header class="menu">
                <h1 class="title">Abarrotes la pantera</h1>
                    <ul>
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        
                        <!--Muestra las pestañas que debe ver el publico en general-->
                        <?php session_start();?>
                        <?php if(!isset($_SESSION['usuario'])):?>
                            <li>
                                <a href="">Nuevos</a>
                            </li>
                            <li>
                                <a href="">Los mas vendidos</a>
                            </li>
                        <!--Muestra las pestañas que debe ver un empleado-->
                        <?php elseif(isset($_SESSION['usuario']) && strcmp($_SESSION['usuario']['cargo'],"empleado") == 0): ?>
                        
                            <li>
                                <a href="ventas.php">Ventas</a>
                            </li>
                        <!--Muestra las pestañas que debe vel el encargado-->
                        <?php elseif(isset($_SESSION['usuario']) && strcmp($_SESSION['usuario']['cargo'],"encargado") == 0): ?>
                        
                            <li>
                                <a href="productos.php">Productos</a>
                            </li>
                            
                            <li>
                                <a href="personal.php">Personal</a>
                            </li>
                            
                        <?php endif; ?>

                        <li>
                            <a href="#contacto">Contacto</a>
                        </li>
                    </ul>

                <?php if(!isset($_SESSION['usuario']) ): ?>
                    <button type="submit" class="btn" style="width: 110px;height: 30px;margin-bottom: 20px;background-color:#42b881; "><a href="iniciaSesion.php" style="color:#fff;">Iniciar sesion</a></button>
                <?php else: ?>
                    <button type="submit" class="btn" style="width: 110px;height: 30px;margin-bottom: 20px;background-color:#42b881; "><a href="cerrarSesion.php" style="text-decoration: none; color:#fff;">Cerrar sesion</a></button>
                    <h3 style="color:#fff; float:right;margin-right:-106px;"><?= "Bienvenido, "." ".$_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido_paterno']." ".$_SESSION['usuario']['apellido_materno'] ?></h3>
                    
                <?php endif; ?>    
            </header>
        </div>