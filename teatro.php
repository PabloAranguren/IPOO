<?php 
/*Un teatro se caracteriza por su nombre y su direcci�n y en �l se realizan 4 funciones al d�a. Cada funci�n tiene un nombre y un precio.
Realice la implementaci�n de la clase Teatro e implemente los m�todos necesarios para cambiar el nombre del teatro, la direcci�n, el nombre de una 
funci�n y el precio.
Implementar las 4 funciones usando un array que almacena la informaci�n correspondiente a cada funci�n. Cada funci�n es un array asociativo con las
claves �nombre� y �precio�.
*/

class teatro{
    private $nombTeatro;
    private $direcTeatro;
    private $funciones;
 
    public function __construct($nombre,$direccion) {
        $funcion1 = array("Nombre"=>"Bossi Master Show","Precio"=>400);
        $funcion2 = array("Nombre"=>"Perfectos desconocidos","Precio"=>300);
        $funcion3 = array("Nombre"=>"�Qu� hacemos con Walter?","Precio"=>200);
        $funcion4 = array("Nombre"=>"Enrique Pinti - Al fondo a la derecha","Precio"=>600);
        $this->nombTeatro = $nombre;
        $this->direcTeatro = $direccion;
        $this->funciones = array();
        $this->funciones[0] = $funcion1;
        $this->funciones[1] = $funcion2;
        $this->funciones[2] = $funcion3;
        $this->funciones[3] = $funcion4;
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
    public function setNombTeatro($nombre){
        $this->nombTeatro = $nombre;
    }
    public function setDirecTeatro($direccion){
        $this->direcTeatro = $direccion;
    }
    public function setFunciones($nuevaFuncion){
        $this->funciones = $nuevaFuncion;
    }
    public function cambiarTeatro($nombTeatro, $dirTeatro){
        $this->setNombTeatro($nombTeatro);
        $this->setDirecTeatro($dirTeatro);
    }
    
    public function cambiarFunciones($nuevaFuncion, $precioNuevo, $posicion){
        $arregloFunciones = $this->getFunciones();
        $esta = false;
        $i = 0;
        $j = count($arregloFunciones);
        while($i< $j && !$esta){
            if( $i == $posicion){
                $arregloAux = array ("nombreFuncion"=> $nuevaFuncion, "precioFuncion"=>$precioNuevo);
                $arregloFunciones[$i] = $arregloAux;
                $this->setFunciones($arregloFunciones);
                $esta = true;               
            }
            $i++;
        }
    }
    public function __toString(){
        $cadena = "El teatro ".$this->getNombTeatro(). " ubicado en ".$this->getDirecTeatro()."\n"." Presenta las funciones "."\n";//
        return $cadena;   
    }
            
}

?>