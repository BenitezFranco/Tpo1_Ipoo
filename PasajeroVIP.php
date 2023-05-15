<?php

class PasajeroVIP extends Pasajero {
    
    private $numeroViajeroFrecuente;
    
    private $cantidadMillas;

    public function __construct($nombre, $apellido, $dni,$telefono, $nroAsiento, $nroTicket, $numeroViajeroFrecuente, $cantidadMillas) {
        parent::__construct($nombre, $apellido, $dni,$telefono, $nroAsiento, $nroTicket);
        $this->numeroViajeroFrecuente = $numeroViajeroFrecuente;
        $this->cantidadMillas = $cantidadMillas;
    }


    public function getCantidadMillas()
    {
        return $this->cantidadMillas;
    }

    public function setCantidadMillas($cantidadMillas): self
    {
        $this->cantidadMillas = $cantidadMillas;

        return $this;
    }

    public function getNumeroViajeroFrecuente()
    {
        return $this->numeroViajeroFrecuente;
    }

    public function setNumeroViajeroFrecuente($numeroViajeroFrecuente): self
    {
        $this->numeroViajeroFrecuente = $numeroViajeroFrecuente;

        return $this;
    }

    public function __toString()
    {
        return parent::__toString().", Cantidad de Millas: ".$this->getCantidadMillas().", Número Viajero Frecuente: ".$this->getNumeroViajeroFrecuente()."*)";
    }

    public function darPorcentajeIncremento(){
        $porcentaje= 0.35;
        if($this->getCantidadMillas()>300)
            $porcentaje= 0.30;
        return $porcentaje;        
    }

    public function esVIP(){
        return true;
    }
}