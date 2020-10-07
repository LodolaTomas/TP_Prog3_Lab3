function AdministrarValidacion(): boolean {
    let dni: number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).value);
    let dni_min: number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).min);
    let dni_max: number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).max);
    AdministrarSpanError("spanDni",ValidarRangoNumerico(dni,dni_min,dni_max));
    AdministrarSpanError("spanApellido",ValidarCamposVacios("txtApellido"));
    AdministrarSpanError("spanNombre",ValidarCamposVacios("txtNombre"));
    AdministrarSpanError("spanCboSexo",ValidarCombo((<HTMLInputElement>document.getElementById("cboSexo")).value, "---"));
    let legajo: number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).value);
    let legajo_min: number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).min);
    let legajo_max: number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).max);
    AdministrarSpanError("spanLegajo",ValidarRangoNumerico(legajo,legajo_min,legajo_max));
    let turno_selec: string = ObtenerTurnoSeleccionado();
    let Sueldo: number = parseInt((<HTMLInputElement>document.getElementById("txtSueldo")).value);
    let sueldo_min: number = parseInt((<HTMLInputElement>document.getElementById("txtSueldo")).min);
    let sueldo_max: number = ObtenerSueldoMaximo(turno_selec);
    AdministrarSpanError("spanSueldo",ValidarRangoNumerico(Sueldo,sueldo_min,sueldo_max));
    AdministrarSpanError("spanArchivo",ValidarCamposVacios("archivo"));
    if(VerificarValidaciones("spanDni") && VerificarValidaciones("spanApellido") && VerificarValidaciones("spanNombre") 
    && VerificarValidaciones("spanCboSexo")&& VerificarValidaciones("spanLegajo") && VerificarValidaciones("spanSueldo") &&
    VerificarValidaciones("spanArchivo")){
        alert("Fomulario Enviado!");
        return true;
    }else{
        alert("Rellene correctamente en donde aparezca un *");
        return false;
    }


}


function ValidarCamposVacios(valor_id: string): boolean {
    let flag: boolean = false;
    let aux: string = (<HTMLInputElement>document.getElementById(valor_id)).value;
    if (aux == null || aux == "" || aux == "---")
        flag = true;

    return flag;
}

function ValidarRangoNumerico(valor: number, min: number, max: number): boolean {
    let flag: boolean = false;
    if ( isNaN(valor) || (valor<min || valor>max))
        flag = true;

    return flag;
}

function ValidarCombo(valor_combo: string, valor_default: string): boolean {
    let flag: boolean = false;
    if (valor_combo == valor_default)
        flag = true;

    return flag;
}

function ObtenerTurnoSeleccionado(): string {
    let aux: string = "";
    if ((<HTMLInputElement>document.getElementById("TM")).checked) {
        aux = "Mañana";
    }
    else if ((<HTMLInputElement>document.getElementById("TT")).checked) {
        aux = "Tarde";
    }
    else if ((<HTMLInputElement>document.getElementById("TN")).checked) {
        aux = "Noche";
    }
    return aux;
}

function ObtenerSueldoMaximo(valor_turno: string): number {
    let max: number = 0;

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

function AdministrarValidacionesLogin():boolean{
    let dni: number = parseInt((<HTMLInputElement>document.getElementById("txtDniLogin")).value);
    let dni_min: number = parseInt((<HTMLInputElement>document.getElementById("txtDniLogin")).min);
    let dni_max: number = parseInt((<HTMLInputElement>document.getElementById("txtDniLogin")).max);
    let apellidoCVSpan:boolean=ValidarCamposVacios("txtApellidoLogin");
    let dniCVspan:boolean=ValidarCamposVacios("txtDniLogin");
    let dniRNSpan:boolean=ValidarRangoNumerico(dni, dni_min, dni_max);
    AdministrarSpanError("spanApellido",apellidoCVSpan);
    AdministrarSpanError("spanDni",dniCVspan);
    AdministrarSpanError("spanDni",dniRNSpan);

    if(VerificarValidaciones("spanDni") && VerificarValidaciones("spanApellido")){
        alert("Fomulario Enviado!");
        return true;
    }else{
        alert("Rellene correctamente en donde aparezca un *");
        return false;
    }

}

function AdministrarSpanError(id:string, flag:boolean): void{
    if(flag)
    {
        (<HTMLInputElement>document.getElementById(id)).style.display="block";
    }
    else
    {
        (<HTMLInputElement>document.getElementById(id)).style.display="none";
    }
}

function VerificarValidaciones(span : string): boolean
{
    let retorno:boolean=false;

    if((<HTMLInputElement>document.getElementById(span)).style.display=="none")
    {
        retorno=true;
    }

    return retorno;
}


function AdministrarModificar(dni : string) : void{
    if(dni != null){
        (<HTMLInputElement>document.getElementById("hidDNI")).value = dni;
        (<HTMLFormElement>document.getElementById("frmModificar")).submit();
        console.log(dni);
    }else{
        console.log("DNI invalido");
    }
}