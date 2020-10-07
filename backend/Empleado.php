<?php
require "Persona.php";
class Empleado extends Persona
{

    protected $_legajo;
    protected $_pathFoto;
    protected $_sueldo;
    protected $_turno;

    public function __construct($nombre, $apellido, $dni, $sexo, $legajo, $sueldo, $turno)
    {
        parent::__construct($nombre, $apellido, $dni, $sexo);

        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
        $this->_turno = $turno;
    }

    public function GetLegajo()
    {
        return $this->_legajo;
    }
    public function GetPathFoto()
    {
        return $this->_pathFoto;
    }

    public function SetPathFoto($foto){
        $this->_pathFoto=$foto;
    }

    public function GetSueldo()
    {
        return $this->_sueldo;
    }

    public function GetTurno()
    {
        return $this->_turno;
    }

    function Hablar($idioma)
    {
        $str = "El empleado habla ";
        foreach ($idioma as $key) {
            $str = $str . $key . ", ";
        }
        $str = substr($str, 0, strlen($str) - 2); //quito la ultima coma
        $str = $str . "."; //la reemplazo por un punto
        return $str;
    }

    public function ToString()
    {
        return sprintf("%s - %s - %s - %s - %s", parent::ToString(), $this->GetLegajo(), $this->GetSueldo(), $this->GetTurno(), $this->GetPathFoto());
    }
}
