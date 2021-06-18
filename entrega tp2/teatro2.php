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
    
    public function cambiarFunciones($funcNueva, $precioFunc, $duracion, $hora, $lugar){
        $FuncionNueva = $this->getFunciones();
        $i = 0;
        while($i< count($FuncionNueva)){
            if( $i == $lugar){
                $FuncionNueva[$i]->setNombreFunc($funcNueva);
                $FuncionNueva[$i]->setPrecioFunc($precioFunc);
                $FuncionNueva[$i]->setDuracionFunc($duracion);
                $FuncionNueva[$i]->setHoraInicioFunc($hora);
                $this->setFunciones($FuncionNueva);
            }
            $i++;
        }
    }
    public function verificarFuncion(){
        $func = $this->getFunciones();
        $ver = false;
        $i = 0;
        $funcHora = array();
        while ($i < count($func)) {
           $funcHora[$i] = $func[$i]->getHoraInicioFunc();
           $i++;
        }
        if(count($funcHora) > count(array_unique($funcHora))){
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
