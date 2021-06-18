<?php
include_once 'funcion.php';
class funcionCine extends funcion{
   private $genero;
   private $pais;
   
   public function __construct($genero,$pais, $nombre, $hora, $duracion, $precio){
       parent::__construct($nombre, $hora, $duracion, $precio);
       $this->genero = $genero;
       $this->pais = $pais;
   }
   public function setpais($pais){
       $this->pais = $pais;
   }
   public function getpais(){
       return $this->pais;
   }
   public function setgenero($genero){
       $this->genero = $genero;
   }
   public function getgenero(){
       return $this->genero;
   }
   public function darPrecio(){
       $precio =  parent::darPrecio();;
       $costo = $precio + ($precio * 65) / 100;
       return $costo;
   }
   public function __toString(){
       $cadena = parent::__toString()."\nGenero: ".$this->getgenero()."\n"."Pais: ".$this->getpais()."\n-------------\n";
       return $cadena;
   }
}
?>