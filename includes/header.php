<?php
    include "includes/usuario.php";
    if ($usuario == "encargado"){
        include "includes/headers/headerEncargado.php";
    } else if ($usuario == "empleado"){
        include "includes/headers/headerEmpleado.php";
    } else {
        include "includes/headers/header.php";
    }
