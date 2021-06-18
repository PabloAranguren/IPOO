<?php

class Teatro{
    private $nombTeatro;
    private $direcTeatro;
    private $funciones;
    
    public function __construct($nombre, $direccion, $funcion){
        $this->nombTeatro = $nombre;
        $this->direcTeatro = $direccion;
        $this->funciones = $funcion;
    }
    public function getNombTeatro(){
        return $this->nombTeatro;
    }
    public function getDirecTeatro(){
        return $this->direcTeatro;
    }
    public function getFunciones(){
        return $this->funciones;
    }
    public function setNombTeatro($nomb){
        $this->nombTeatro = $nomb;
    }
    public function setDirecTeatro($dTeatro){
        $this->direcTeatro = $dTeatro;
    }
    public function setFunciones($func){
        $this->funciones = $func;
    }
    
    public function cambiarTeatro($nuevoTeatro, $direcNueva){
        $this->setNombTeatro($nuevoTeatro);
        $this->setDirecTeatro($direcNueva);
    }
    
    public function cambiarFunciones($nombreFuncionBuscar, $nombreFuncNueva, $precioFunc, $duracion, $hora){
        $FuncionNueva = $this->getFunciones();
        $i = 0;
        while($i< count($FuncionNueva)){
            $nombreFuncion = $FuncionNueva[$i]->getNombreFunc();
            if( $nombreFuncion == $nombreFuncionBuscar){
                $FuncionNueva[$i]->setNombreFunc($nombreFuncNueva);
                $FuncionNueva[$i]->setPrecioFunc($precioFunc);
                $FuncionNueva[$i]->setDuracionFunc($duracion);
                $FuncionNueva[$i]->setHoraInicioFunc($hora);
                $this->setFunciones($FuncionNueva);
            }
            $i++;
        }
    }
    public function darCostos(){
        $colfunciones = $this->getFunciones();
        $costo = 0;
        for ($i = 0; $i < count($colfunciones); $i++) {
            $precio = $colfunciones[$i]->darprecio();
            $costo = $costo + $precio;
        }
        return $costo;
    }
    public function verificarFuncion(){
        $func = $this->getFunciones();
        $ver = false;
        $funcHora = array();
        $duracion = array();
        for ($i = 0; $i < count($func); $i++) {
            $funcHora[$i] = $func[$i]->getHoraInicioFunc();
            $duracion[$i] = $func[$i]->getDuracionFunc();
        }
        if((count($funcHora) > count(array_unique($funcHora))) && (count($duracion) > count(array_unique($duracion)))){
            $ver = true;
        }
        return $ver;
    }
    public function __toString(){
        $cadena = "El teatro ".$this->getNombTeatro(). " se encuentra en ".$this->getDirecTeatro().
        " y presenta las funciones:"."\n";
        $Func = $this->getFunciones();
        foreach ($Func as $nombre){
            $cadena.= $nombre;
        }
        return $cadena;
    }
}
?>

