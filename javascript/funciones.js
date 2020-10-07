function AdministrarValidacion() {
    var dni = parseInt(document.getElementById("txtDni").value);
    var dni_min = parseInt(document.getElementById("txtDni").min);
    var dni_max = parseInt(document.getElementById("txtDni").max);
    AdministrarSpanError("spanDni", ValidarRangoNumerico(dni, dni_min, dni_max));
    AdministrarSpanError("spanApellido", ValidarCamposVacios("txtApellido"));
    AdministrarSpanError("spanNombre", ValidarCamposVacios("txtNombre"));
    AdministrarSpanError("spanCboSexo", ValidarCombo(document.getElementById("cboSexo").value, "---"));
    var legajo = parseInt(document.getElementById("txtLegajo").value);
    var legajo_min = parseInt(document.getElementById("txtLegajo").min);
    var legajo_max = parseInt(document.getElementById("txtLegajo").max);
    AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajo, legajo_min, legajo_max));
    var turno_selec = ObtenerTurnoSeleccionado();
    var Sueldo = parseInt(document.getElementById("txtSueldo").value);
    var sueldo_min = parseInt(document.getElementById("txtSueldo").min);
    var sueldo_max = ObtenerSueldoMaximo(turno_selec);
    AdministrarSpanError("spanSueldo", ValidarRangoNumerico(Sueldo, sueldo_min, sueldo_max));
    if(document.getElementById("txtDni").readOnly!=true){AdministrarSpanError("spanArchivo", ValidarCamposVacios("real-file"));}
    if (VerificarValidaciones("spanDni") && VerificarValidaciones("spanApellido") && VerificarValidaciones("spanNombre")
        && VerificarValidaciones("spanCboSexo") && VerificarValidaciones("spanLegajo") && VerificarValidaciones("spanSueldo") &&
        VerificarValidaciones("spanArchivo")) {
        alert("Fomulario Enviado!");
        return true;
    }
    else {
        alert("Rellene correctamente en donde aparezca un *");
        return false;
    }
}
function ValidarCamposVacios(valor_id) {
    var flag = false;
    var aux = document.getElementById(valor_id).value;
    if (aux == null || aux == "" || aux == "---")
        flag = true;
    return flag;
}
function ValidarRangoNumerico(valor, min, max) {
    var flag = false;
    if (isNaN(valor) || (valor < min || valor > max))
        flag = true;
    return flag;
}
function ValidarCombo(valor_combo, valor_default) {
    var flag = false;
    if (valor_combo == valor_default)
        flag = true;
    return flag;
}
function ObtenerTurnoSeleccionado() {
    var aux = "";
    if (document.getElementById("TM").checked) {
        aux = "Mañana";
    }
    else if (document.getElementById("TT").checked) {
        aux = "Tarde";
    }
    else if (document.getElementById("TN").checked) {
        aux = "Noche";
    }
    return aux;
}
function ObtenerSueldoMaximo(valor_turno) {
    var max = 0;
    switch (valor_turno) {
        case "Mañana":
            max = 20000;
            break;
        case "Tarde":
            max = 18500;
            break;
        case "Noche":
            max = 25000;
            break;
        default:
            break;
    }
    return max;
}
function AdministrarValidacionesLogin() {
    var dni = parseInt(document.getElementById("txtDniLogin").value);
    var dni_min = parseInt(document.getElementById("txtDniLogin").min);
    var dni_max = parseInt(document.getElementById("txtDniLogin").max);
    var apellidoCVSpan = ValidarCamposVacios("txtApellidoLogin");
    var dniCVspan = ValidarCamposVacios("txtDniLogin");
    var dniRNSpan = ValidarRangoNumerico(dni, dni_min, dni_max);
    AdministrarSpanError("spanApellido", apellidoCVSpan);
    AdministrarSpanError("spanDni", dniCVspan);
    AdministrarSpanError("spanDni", dniRNSpan);
    if (VerificarValidaciones("spanDni") && VerificarValidaciones("spanApellido")) {
        alert("Fomulario Enviado!");
        return true;
    }
    else {
        alert("Rellene correctamente en donde aparezca un *");
        return false;
    }
}
function AdministrarSpanError(id, flag) {
    if (flag) {
        document.getElementById(id).style.display = "block";
    }
    else {
        document.getElementById(id).style.display = "none";
    }
}
function VerificarValidaciones(span) {
    var retorno = false;
    if (document.getElementById(span).style.display == "none") {
        retorno = true;
    }
    return retorno;
}
function AdministrarModificar(dni) {
    if (dni != null) {
        document.getElementById("hidDNI").value = dni;
        document.getElementById("frmModificar").submit();
        console.log(dni);
    }
    else {
        console.log("DNI invalido");
    }
}
