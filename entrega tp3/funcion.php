<?php
class funcion {
    private $nombreFunc;
    private $horaInicioFunc;
    private $duracionFunc;
    private $precioFunc;
    
    public function __construct($nombre, $hora, $duracion, $precio){
        $this->nombreFunc = $nombre;
        $this->horaInicioFunc = $hora;
        $this->duracionFunc = $duracion;
        $this->precioFunc = $precio;
    }
    public function getNombreFunc(){
        return $this->nombreFunc;
    }
    public function getHoraInicioFunc(){
        return $this->horaInicioFunc;
    }
    public function getDuracionFunc(){
        return $this->duracionFunc;
    }
    public function getPrecioFunc(){
        return $this->precioFunc;
    }
    public function setNombreFunc($nombreFuncion){
        $this->nombreFunc = $nombreFuncion;
    }
    public function setHoraInicioFunc($horaFuncion){
        $this->horaInicioFunc = $horaFuncion;
    }
    public function setDuracionFunc($duracion){
        $this->duracionFunc = $duracion;
    }
    public function setPrecioFunc($precio){
        $this->precioFunc = $precio;
    }
    public function darPrecio(){
        $precio = $this->getPrecioFunc();
        return $precio;
    }
    
    public function __toString(){
        $cadena = "El nombre de la funcion es: ".$this->getNombreFunc()."\n"."Inicia a las ".$this->getHoraInicioFunc()."\n"."Posee una duracion de ".
            $this->getDuracionFunc()."hs"."\n"."Precio funcion: ".$this->getPrecioFunc();
            return $cadena;
    }
    
}



?>