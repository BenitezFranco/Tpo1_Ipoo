<?php

include 'Pasajero.php';
include 'ResponsableV.php';

class Viaje{

    private $codigo;

    private $destino;

    private $cantidad;

    private $pasajeros;

    private $responsable;

    public function __construct($codigo,$destino,$cantidad,$pasajeros, $responsable)
    {
        $this->codigo= $codigo;
        $this->destino= $destino;
        $this->cantidad= $cantidad;
        $this->pasajeros= $pasajeros;
        $this->responsable= $responsable;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getPasajeros(){
        return $this-> pasajeros;
    }

    public function getResponsable(){
        return $this->responsable;
    }

    public function setCodigo($codigo){
        $this->codigo= $codigo;
    }

    public function setDestino($destino){
        $this->destino= $destino;
    }

    public function setCantidad($cantidad){
        $this->cantidad= $cantidad;
    }

    public function setPasajeros($pasajeros){
        $this->pasajeros= $pasajeros;
    }

    public function setResponsable($responsable){
        $this->responsable= $responsable;
    }

    /**
     * Agrega un pasajero al arreglo de pasajeros si todavia hay espacio
     * @param array Un arreglo asociativo
     * @return bool Retorna false si ya se alcanzo el maximo de pasajeros sino devuelve true y suma un pasajero en el arreglo de pasajeros
     */

    public function agregarPasajero($pasajero){
        $band = false;
        $indice=count($this->pasajeros);
        if($this->cantidad > $indice){
            $this->pasajeros[$indice]= $pasajero;
            $band =true;
        }
        return $band;
    }
    public function __toString()
    {
        return "(".$this->codigo.", ".$this->destino.", ".$this->cantidad.", ".($this->getResponsable())->__toString().", ".$this->auxToString().")";
    }

    public function auxToString(){
        $cadena="[";
        $indice=count($this->pasajeros);
        if($indice==0){
            $cadena = "No hay pasajeros";
        }else{
            $arreglo=  $this->getPasajeros();
            for($i=0;$i<$indice;$i++){
                $cadena= $cadena.($arreglo[$i]-> __toString()).", ";
            }
                $cadena= substr($cadena, 0,-2)."]";
        }
        return $cadena;
    }
}

?>