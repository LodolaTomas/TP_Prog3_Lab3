<?php

require "./Fabrica.php";

$legajo = $_GET["legajo"];
$path = "../archivos/empleados.txt";
$fabrica= new Fabrica("Google",7);
$flag= false;
$archivo = fopen($path, "r");
$datos = array();
if ($archivo) {
    while (!feof($archivo)) {
        $cadena = fgets($archivo);
        $datos = explode(' - ', $cadena);
        if (count($datos) >2) {
            if($datos[4]==$legajo){
                $flag=true;
                break;
            }
        }
    }
    fclose($archivo);
}
echo '<a href="../index.php">Index</a><br>';
echo '<a href="./mostrar.php">Mostrar</a>';
if($flag==true){
    echo '<br>Empleado Encontrado!<br>';
    $empleadoAEliminar = new Empleado($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6]);
    $empleadoAEliminar->SetPathFoto($datos[7]);
    $fabrica->TraerDeArchivo($path);
    if($fabrica->EliminarEmpleado($empleadoAEliminar,false)){
        echo '<br>Empleado Eliminado!<br>';
        $fabrica->GuardarEnArchivo($path);
    }
}else{
    echo '<br>Empleado no pudo ser Encontrado<br>';
}



