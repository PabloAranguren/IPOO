<?php
include_once 'funcion.php';
class funcionMusical extends funcion{
    private $director;
    private $cantPersonas;
    
    public function __construct($dire, $cant, $nombre, $hora, $duracion, $precio){
        parent::__construct($nombre, $hora, $duracion, $precio);
        $this->cantPersonas = $cant;
        $this->director = $dire;
    }
    public function setcantPersonas($cantPersonas){
        $this->cantPersonas = $cantPersonas;
    }
    public function getcantPersonas(){
        return $this->cantPersonas;
    }
    public function setdirector($director){
        $this->director = $director;
    }
    public function getdirector(){
        return $this->director;
    }
    public function darPrecio(){
        $precio = parent::darPrecio();
        $costo = $precio + ($precio * 12) / 100;
        return $costo;
    }
    public function __toString(){
        $cadena = parent::__toString()."\nDierector: ".$this->getdirector()."\n"."Cantidad Actores: ".$this->getcantPersonas()."\n-------------\n";
        return $cadena;
    }
}
?>