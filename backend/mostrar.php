<?php

include "./Fabrica.php";

$path = "../archivos/empleados.txt";
$listaEmpleados = array();
$unaFabrica = new Fabrica("Google", 7);
$unaFabrica->TraerDeArchivo($path);
$listaEmpleados=$unaFabrica->GetEmpleados();


echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>HTML 5 – Listado de Empleados</title>
        <link rel="stylesheet" href="../style.css">
        <script src="../javascript/funciones.js"></script>
    </head>
    <body>
    <form action="../index.php" id="frmModificar" method="POST">' .
        '<input type="hidden" id="hidDNI" name="hidDNI">'.
        '</form>
    <form id="fmlMostrar" id="fmlMostrar"><table>'; 
     include_once './validarSesion.php';
    echo '<h2>Listado de Empleados<h2>
    
    <th><h3>Info<h3>
    <tr><td colspan="4"><hr/></td></tr>';

foreach ($listaEmpleados as $unEmpleado) {
    echo "<tr>" .
        '<td><h4>' .
        $unEmpleado->ToString() .
        "</h4></td>" . "<td>".
        '<img src='.'../fotos\\'.$unEmpleado->GetPathFoto().'width="90" height="90">'.
        "</td>".
        "<td>" .
        '<a href="./eliminar.php?legajo=' . $unEmpleado->GetLegajo() . ' ">Eliminar</a>' .
        "<td>".
        '<input type="button" onclick="AdministrarModificar('.$unEmpleado->GetDni().')" value="modificar" name="btnMod" class="button button1"/>'.
        "</td>".
        "</td>" .
        "</tr>";
}
echo '
    <tr><tr><td colspan="4"><hr/></td></tr></tr>
    </table>
    <a href="../index.php" ><h4>Alta de Empleados<h4></a>
    <a href="./cerrarSesion.php"><h4>Deslogearse<h4></a>
    <a href="./MostrarPDF.php ">Mostrar en formato PDF</a>
    </body>
    </html>';
