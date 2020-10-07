<?php

require "./Fabrica.php";

$nombre = $_POST['txtNombre'] ?? NULL;
$apellido = $_POST['txtApellido'] ?? NULL;
$dni = $_POST['txtDni'] ?? NULL;
$sexo = $_POST['cboSexo'] ?? NULL;
$legajo = $_POST['txtLegajo'] ?? NULL;
$sueldo = $_POST['txtSueldo'] ?? NULL;
$turno = $_POST['rdoTurno'] ?? NULL;
$fotoModificar = $_POST['hdnModificar'] ?? NULL;
$bandera=true;
if ($_FILES["real-file"]["name"] == null) {
    $archivo_imagen = "../fotos\\" . chop($fotoModificar);
    $imagenMoficaPath="../fotos\\" . chop($fotoModificar);
} else {
    $bandera = false;
    $archivo_imagen = "../fotos\\" . $_FILES["real-file"]["name"];
    $variable = $_FILES["real-file"]["tmp_name"];
}


$imagen_tipo = strtolower(pathinfo($archivo_imagen, PATHINFO_EXTENSION));
$flag_img = true;

if ($imagen_tipo != "jpg" && $imagen_tipo != "png" && $imagen_tipo != "jpeg" && $imagen_tipo != "gif") {
    echo "Lo siento, solo imagenes JPG, JPEG, PNG y GIF son aceptadas.";
    $flag_img = false;
}
if ($_FILES["real-file"]["name"] != null) {
    $size = $_FILES["real-file"]["size"];
    if ($size > 1000000000000) {
        echo "Lo siento, la imagen es muy pesada.";
        $flag_img = false;
    }
    if (file_exists($archivo_imagen)) {
        echo "Lo siento, la imagen ya Existe.";
        $flag_img = false;
    }
}
if ($flag_img) {
    
    ($_FILES["real-file"]["name"] != null) ? $_FILES["real-file"]["name"] = $dni . "-" . $apellido . "." . $imagen_tipo : "";
    ($_FILES["real-file"]["name"] != null) ? $archivo_imagen = "../fotos\\" . $_FILES["real-file"]["name"] :"";
    ($_FILES["real-file"]["name"] == null) ? $archivo_imagen = "../fotos\\" . $dni . "-" . $apellido . "." . $imagen_tipo: "";
    ($_FILES["real-file"]["name"] != null) ? move_uploaded_file($_FILES["real-file"]["tmp_name"], $archivo_imagen) : rename($imagenMoficaPath,$archivo_imagen);
    $empleado = new Empleado($nombre, $apellido, $dni, $sexo, $legajo, $sueldo, $turno);
    $path = "../archivos/empleados.txt";
    $fabrica = new Fabrica("Google", 7);
    $flag = false;
    $fabrica->TraerDeArchivo($path);
    foreach ($fabrica->GetEmpleados() as $otroEmpleado) {
        if ($otroEmpleado->GetDni() == $empleado->GetDni()) {
            $flag = true;
            $fabrica->EliminarEmpleado($otroEmpleado,$bandera);
            $fabrica->GuardarEnArchivo($path);
            break;
        }
    }
    ($_FILES["real-file"]["name"] != null) ? $empleado->SetPathFoto($_FILES["real-file"]["name"]) : $empleado->SetPathFoto($dni . "-" . $apellido . "." . $imagen_tipo);
    if ($fabrica->AgregarEmpleados($empleado)) {

        $fabrica->GuardarEnArchivo($path);
        if ($flag == true) {
            echo "Empleado Modificado Correctamente!</br>";
            echo '<a href="../backend/mostrar.php">Mostrar</a>';
        } else {
            echo "Empleado Agregado Correctamente!</br>";
            echo '<a href="../backend/mostrar.php">Mostrar</a>';
        }
    }
} else {
    echo "Error, El empleado no pudo ser Agregado.. </br>";
    echo '<a href="../index.html">index</a>';
}
