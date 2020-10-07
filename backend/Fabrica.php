<?php

use function PHPSTORM_META\type;

require_once(__DIR__. './Empleado.php');
require_once(__DIR__. './interfaces.php');

class Fabrica implements IArchivo
{

    private $_cantidadMaxima;
    private $_empleados;
    private $_razonSocial;


    function __construct($razonSocial, $cantidadMaxima)
    {
        $this->_razonSocial = $razonSocial;
        $this->_cantidadMaxima = $cantidadMaxima;
        $this->_empleados = array();
    }

    public function AgregarEmpleados($emp): bool
    {
        $flag = false;
        if (count($this->_empleados) <= $this->_cantidadMaxima) {
            array_push($this->_empleados, $emp);
            $this->EliminarEmpleadoRepetido();
            $flag = true;
        }
        return $flag;
    }
    public function GetEmpleados()
    {
        return $this->_empleados;
    }

    function CalcularSueldos()
    {
        $acum = 0;
        foreach ($this->_empleados as $key) {
            $acum = $acum + $key->GetSueldo();
        }
        return $acum;
    }

    function EliminarEmpleado($emp,$modificar): bool
    {
        $flag = false;
        /* con trim elimino el \r\n con el que se guarda el empleado al final para poder hacer un unlink sin problemas */
        $fotoAEliminar=trim($emp->GetPathFoto());
        foreach ($this->_empleados as $key => $datosEmp) {
            if ($emp == $datosEmp) {
                if($modificar==false){
                unlink('../fotos\\'.$fotoAEliminar);
                }
                unset($this->_empleados[$key]);
                $flag = true;
            }
        }
        return $flag;
    }

    private function EliminarEmpleadoRepetido()
    {
        $this->_empleados = array_unique($this->_empleados, SORT_REGULAR);
    }

    function ToString()
    {
        $str = $this->_razonSocial . "<br>" . "Cantidad Maxima :" . $this->_cantidadMaxima . "<br>" . "EMPLEADOS" . "<br>";
        foreach ($this->_empleados as $key) {
            $str .= $key->ToString();
        }
        echo $str;
    }

    function GuardarEnArchivo(string $nombreArchivo): void
    {
        $archivo = fopen($nombreArchivo, "w");
        if ($archivo) {
            foreach ($this->_empleados as $unEmpleado) {
                fwrite($archivo, $unEmpleado->ToString() . "\r\n");
            }
            fclose($archivo);
        }
    }
    function TraerDeArchivo(string $nombreArchivo): void
    {
        $archivo = fopen($nombreArchivo, "r");
        $datos = array();

        if ($archivo) {
            while (!feof($archivo)) {
                $cadena = fgets($archivo);
                $datos = explode(' - ', $cadena);
                if (count($datos) > 2) {
                    $nuevoEmpleado = new Empleado($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6]);
                    $nuevoEmpleado->SetPathFoto($datos[7]);
                    $this->AgregarEmpleados($nuevoEmpleado);
                }
            }
            fclose($archivo);
        }
    }
}
