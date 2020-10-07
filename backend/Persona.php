<?php

abstract class Persona{

private $_nombre;
private $_dni;
private $_apellido;
private $_sexo;


public function __construct($nombre, $apellido,$dni,$sexo){
    
    $this->_nombre= $nombre;
    $this->_apellido=$apellido;
    $this->_dni=$dni;
    $this->_sexo=$sexo;
}

public function GetApellido(){
    return $this->_apellido;
}
public function GetDni(){
    return $this->_dni;
}
public function GetNombre(){
    return $this->_nombre;
}

public function GetSexo(){
   return $this->_sexo;
}


abstract function Hablar($idioma);

public function ToString(){
    return sprintf("%s - %s - %s - %s" , $this->GetNombre(), $this->GetApellido(), $this->GetDni(), $this->GetSexo());
}

}
?>