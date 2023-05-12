<?php

include 'Pasajero.php';
include 'ResponsableV.php';

class Viaje{

    private $codigo;

    private $destino;

    private $cantidad;

    private $pasajeros;

    private $responsable;

    private $costo;

    private $sumaCosto;

    public function __construct($codigo,$destino,$cantidad,$pasajeros, $responsable, $costo, $sumaCosto)
    {
        $this->codigo= $codigo;
        $this->destino= $destino;
        $this->cantidad= $cantidad;
        $this->pasajeros= $pasajeros;
        $this->responsable= $responsable;
        $this->costo=$costo;
        $this->sumaCosto=$sumaCosto;
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

    public function getCosto()
    {
        return $this->costo;
    }

    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    public function getSumaCosto()
    {
        return $this->sumaCosto;
    }

    public function setSumaCosto($sumaCosto)
    {
        $this->sumaCosto = $sumaCosto;

        return $this;
    }

    /**
     * Agrega un pasajero al arreglo de pasajeros si todavia hay espacio
     * @param Pasajero Un Objeto de tipo Pasajero
     * @return double Retorna el costo a abonar por el pasajero
     */

    public function venderPasaje($pasajero){
        $importe=0;
        $band = $this->hayPasajesDisponible();
        if($band){
            $indice=count($this->pasajeros);
            $this->pasajeros[$indice]= $pasajero;
            $importe= $this->getCosto()*(1+$pasajero->darPorcentajeIncremento());
            $this->sumaCosto= $this->sumaCosto+$importe;
        }
        return $importe;
    }
    public function __toString()
    {
        return "(".$this->codigo.", ".$this->destino.", ".$this->cantidad.", ".($this->getResponsable())->__toString().", ".$this->auxToString().", ".$this->getCosto().", ".$this->getSumaCosto().")";
    }

    private function auxToString(){
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

    public function hayPasajesDisponible(){
        $hayLugar= count($this->getPasajeros())== $this->getCantidad();
        return $hayLugar;
    }

}

?>