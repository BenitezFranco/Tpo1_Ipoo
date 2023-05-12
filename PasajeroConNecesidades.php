<?php

class PasajeroConNecesidades extends Pasajero {
    
    private $silla;

    private $comida;

    private $asistencia;

    public function __construct($nombre, $apellido, $dni,$telefono, $nroAsiento, $nroTicket,$silla,$comida)
    {
        parent::__construct($nombre, $apellido, $dni,$telefono, $nroAsiento, $nroTicket);
        $this->silla= $silla;
        $this->comida=$comida;

    }

    public function getSilla()
    {
        return $this->silla;
    }

    public function setSilla($silla)
    {
        $this->silla = $silla;

        return $this;
    }

    public function getComida()
    {
        return $this->comida;
    }

    public function setComida($comida)
    {
        $this->comida = $comida;

        return $this;
    }

    public function getAsistencia()
    {
        return $this->asistencia;
    }

    public function setAsistencia($asistencia): self
    {
        $this->asistencia = $asistencia;

        return $this;
    }


    public function __toString()
    {
        return parent::__toString().", Necesita silla: ".$this->getSilla().", Necesita comida: ".$this->getComida().", Necesita asistencia: ".$this->getAsistencia().")";
    }

    public function darPorcentajeIncremento(){

        $aumento=0;
        if($this->getSilla())
            $aumento=$aumento+0.15;
        if($this->getComida())
            $aumento=$aumento+0.15;
        if($this->getAsistencia())
            $aumento=$aumento+0.15;

        if($aumento>0.30)
            $aumento=0.30;

        return $aumento;
    }

    public function esConNecesidades(){
        return true;
    }

}