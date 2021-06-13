<?php
require_once "conexionEncargado.php";

$conectar = conectar();
$consulta="SELECT * FROM productos;";//vista_productos
$ejecutaConsulta=mysqli_query($conectar, $consulta);
$VerFilas=mysqli_num_rows($ejecutaConsulta); //numero de filas
$filas=mysqli_fetch_array($ejecutaConsulta);

if (!$ejecutaConsulta){
    echo "Error al consultar";
} else {
    if ($VerFilas<1) {
        echo "<table><tr></th> <th> Sin </th> <th> Registro </th></table>";
    } else {
        echo "<table> <tr> <th>Código de producto</th> <th>Producto</th> <th>Precio</th> <th>Disponibles</th> </tr>";
        //echo "#Filas= $VerFilas";
        for($i=0; $i<=$filas; $i++){
            echo "<tr> <td>$filas[0]</td> <td>$filas[1]</td> <td>$filas[2]</td> <td>$filas[3]</td></tr>";

            $filas=mysqli_fetch_array($ejecutaConsulta);
        }

        echo "</table>";
    }
}