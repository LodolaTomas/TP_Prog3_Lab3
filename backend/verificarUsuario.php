<?php

$dni = $_POST['txtDniLogin'] ?? NULL;
$apellido = $_POST['txtApellidoLogin'] ?? NULL;
$flag=false;

$path = "../archivos/empleados.txt";
$archivo = fopen($path, "r");
$datos = array();
if ($archivo) {
    while (!feof($archivo)) {
        $cadena = fgets($archivo);
        $datos = explode(' - ', $cadena);
        if (count($datos) >2) {
            if($datos[1]==$apellido && $datos[2]==$dni){
                $flag=true;
                session_start();
                $_SESSION["DNIEmpleado"]=$dni;
                break;
            }
        }
    }
    fclose($archivo);
}

if($flag){
    header("LOCATION: ./mostrar.php");
}else{
    echo 'Usuario Inexistente CAPO!';
    echo '<a href="../login.html" ><h4>logearse<h4></a>';
}