<?php

class ResponsableV{
    
    private $numero;
    private $licencia;
    private $nombre;
    private $apellido;

    public function __construct($numero, $licencia, $nombre, $apellido)
    {
        $this->numero= $numero;
        $this->licencia= $licencia;
        $this->nombre= $nombre;
        $this->apellido= $apellido;

    }

    public function getNumero(){
        return $this->numero;
    }

    public function getLicencia(){
        return $this->licencia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setLicencia($licencia){
        $this->licencia=$licencia; 
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido; 
    }

    public function __toString()
    {
        return "(".$this->getNumero().", ".$this->getLicencia().", ".$this->getNombre().", ".$this->getApellido().")";
    }
}

?>