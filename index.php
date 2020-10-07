<?php
require_once(__DIR__. './backend/Fabrica.php');
$title="HTML 5 – Formulario Alta Empleado";
$h2="Alta Empleados";
$value="Enviar";
$dni=null;
$apellido=null;
$nombre=null;
$sexo=null;
$legajo=null;
$sueldo=null;
$turno=null;
$foto=null;
$dni=$_POST["hidDNI"]?? NULL;
if($dni!=null){
$title="HTML5 Formulario Modificar Empleado";
$h2="Modificar Empleado";
$value="Modificar";
$path="./archivos/empleados.txt";
$fabrica = new Fabrica("goooogle",7);
$fabrica->TraerDeArchivo($path);
$empleadoaModificar=null;
foreach($fabrica->GetEmpleados() as $empleado){
    if($empleado->GetDni()==$dni){
        $empleadoaModificar=$empleado;
    break;
    }
}
$apellido=$empleadoaModificar->GetApellido();
$nombre=$empleadoaModificar->GetNombre();
$sexo=$empleadoaModificar->GetSexo();
$legajo=$empleadoaModificar->GetLegajo();
$sueldo=$empleadoaModificar->GetSueldo();
$turno=$empleadoaModificar->GetTurno();
$foto=$empleadoaModificar->GetPathFoto();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./javascript/funciones.js"></script>
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<!--onsubmit="return AdministrarValidacion()"-->
  
    <form action="./backend/administracion.php"  method="POST"id="fmlbackend"enctype="multipart/form-data" name="fmlbackend"><table style="width: 350px;"> 
    <?php include_once "./backend/validarSesion.php"; ?>
    <br><a href="./backend/cerrarSesion.php">Deslogearse</a>    
    <h2><?php echo $h2?></h2>
        
        <th colspan="2"><h4>Datos Personales</h4>
        <tr><td colspan="2"><hr/></td></tr>
        <tr><th><h4>DNI:</h4></td> <td><input class="field" type="number" value="<?php echo $dni ?>" <?php echo ( $dni != null) ?"readonly":"";?> name="txtDni" id="txtDni" max="55000000" min="1000000"><span style="display: none; color:red;" id="spanDni">*</span></td></th></tr>
        <tr><th><h4>Apellido:</h4></td> <td><input class="field" type="text" value="<?php echo $apellido ?>" name="txtApellido" id="txtApellido"><span style="display: none; color:red;" id="spanApellido">*</span></td></th></tr>
        <tr><th><h4>Nombre:</h4></td> <td><input class="field" type="text" value="<?php echo $nombre ?>" name="txtNombre" id="txtNombre"><span style="display: none; color:red;" id="spanNombre">*</span></td></th></tr>
        <tr><td><h4>Sexo</h4></td>
            <td>
                <select name="cboSexo" id="cboSexo" class="field">                                
                    <option value="---" disabled >Seleccione</option>
                    <option value="Masculino" <?php echo ( $sexo == "Masculino") ?"selected":""; ?> >Masculino</option>
                    <option value="Femenino"<?php echo ( $sexo == "Femenino") ?"selected":""; ?> >Femenino</option>                               
                </select><span style="display: none; color:red;" id="spanCboSexo">*</span>
            </td></tr>

        <th colspan="2"><h4>Datos Laborales</h4>
        <tr><td colspan="2"><hr/></td></tr>
        <tr><th><h4>Legajo:</h4></td><td><input class="field" type="number" value="<?php echo $legajo ?>" <?php echo ( $legajo != null) ?"readonly":"";?> name="txtLegajo" id="txtLegajo" min="100" max="550" ><span style="display: none; color:red;"  id="spanLegajo">*</span></td></th></tr>
        <tr><th><h4>Sueldo:</h4></td><td><input class="field" type="number" value="<?php echo $sueldo ?>" name="txtSueldo" id="txtSueldo" min="8000" step="500"><span style="display: none; color:red;" id="spanSueldo">*</span></td></th></tr>
        <tr><th colspan="2"><h4>Turno:</h4></th></tr>
            <th colspan="2" class="radio" >
            <input type="radio" name="rdoTurno" value="TM" <?php echo ( $turno == "TM") ?"checked":"";?> id="TM" checked>
            <label>Mañana</label><br>
            <input type="radio" name="rdoTurno" value="TT" <?php echo ( $turno == "TT") ?"checked":"";?> id="TT">
            <label>Tarde</label><br>  
            <input type="radio" name="rdoTurno" value="TN" <?php echo ( $turno == "TN") ?"checked":"";?> id="TN">
            <label>Noche</label><br>
            </th>
        </tr>
        <tr><th><h4>Foto:</h4></td><td>
        <input type="file" id="real-file" name="real-file" style="display: none;" accept="image/*"/>
        <button type="button" id="custom-button" class="button button1">Subi un Archivo</button>
        <span id="custom-text"><?php echo ( $foto != null) ?$foto:"No file chosen, yet.";?></span>
        <span style="display: none; color:red;" id="spanArchivo">*</span></td></th></tr>
        <input type="hidden" id="hdnModificar" name="hdnModificar" value="<?php echo $foto?>">
        <td colspan="2"><hr/></td>
        <tr><td align="right" colspan="2"><input type="reset" name="btnLimpiar" value="Limpiar" class="button button1" ></td></tr>   
        <tr><td align="right" colspan="2"><input type="submit" name="btnEnviar" value="<?php echo $value ?>" onclick="return AdministrarValidacion()" class="button button1"></td></tr> 
        <!---->
    </table></form>
</body>
<script type="text/javascript">
const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
  realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
  if (realFileBtn.value) {
    customTxt.innerHTML = realFileBtn.value.match(
      /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
  } else {
    customTxt.innerHTML = "No file chosen, yet.";
  }
}); 
    </script> 
</html>