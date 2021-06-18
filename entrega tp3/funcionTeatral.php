<?php
include_once 'funcion.php';
class funcionTeatral extends funcion{
    
    public function __construct($nombre, $hora, $duracion, $precio){
        parent::__construct($nombre, $hora, $duracion, $precio);
    }
    public function darPrecio(){
        $precio = parent::darPrecio();;
        $costo = ($precio * 45) / 100;
        return $costo;
    }
}
?>