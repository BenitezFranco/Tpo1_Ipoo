<?php

class Pasajero{

    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $nroAsiento;
    private $nroTicket;

    public function __construct($nombre, $apellido, $dni,$telefono, $nroAsiento, $nroTicket)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->nroAsiento = $nroAsiento;
        $this->nroTicket =$nroTicket;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido; 
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }


    public function getNroAsiento()
    {
        return $this->nroAsiento;
    }

    public function setNroAsiento($nroAsiento)
    {
        $this->nroAsiento = $nroAsiento;

        return $this;
    }

    public function getNroTicket()
    {
        return $this->nroTicket;
    }

    public function setNroTicket($nroTicket)
    {
        $this->nroTicket = $nroTicket;

        return $this;
    }

    public function __toString()
    {
        return "(".$this->getNombre().", ".$this->getApellido().", ".$this->getDni().", ".$this->getTelefono().", ".$this->getNroAsiento().", ".$this->getNroTicket().")"; 
    }

    public function darPorcentajeIncremento(){
        return 0.1;        
    }

    public function esVIP(){
        return false;
    }

    public function esConNecesidades(){
        return false;
    }

    }
?>