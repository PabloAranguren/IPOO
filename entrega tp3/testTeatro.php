<?php
include_once 'teatro.php';
include_once 'funcionesCine.php';
include_once 'funcionMusical.php';
include_once 'funcionTeatral.php';

$funcion1 = new funcionCine("accion", "EE.UU", "Volver al futuro", 21, 2, 200);
$funcion2 = new funcionMusical("Jennifer Lee", 50, "Frozzen", 19, 3, 400);
$funcion3 = new funcionCine("commedia", "EE.UU", "Son como niños 2", 15, 2, 190);
$funcion4 = new funcionTeatral("A ver que veo", 12, 2, 150);
$funcion5 = new funcionMusical("Warren Casey", 100, "Grease", 20, 3, 350);
$funcion6 = new funcionTeatral("100 metros cuadrados", 22, 2, 200);

$colFunciones = array($funcion1,$funcion2,$funcion3,$funcion4,$funcion5,$funcion6);
$teatro = new Teatro("Colon", "Bs.As 1234", $colFunciones);
//visualizar teatro.
echo $teatro;
echo "\n---------------------------------------------------\n";
//cambiar funcion
echo "Ingrese el nombre de la funcion a cambiar"."\n";
$nuevaFuncionBuscar = trim(fgets(STDIN));
echo "Ingrese el nombre de la nueva funcion"."\n";
$nuevaFuncion = trim(fgets(STDIN));
echo "Ingrese precio de la nueva funcion"."\n";
$precioNuevo = trim(fgets(STDIN));
echo "Ingrese duracion de la nueva funcion"."\n";
$duracion = trim(fgets(STDIN));
echo "Ingrese hora de la nueva funcion"."\n";
$hora = trim(fgets(STDIN));
$teatro->cambiarFunciones($nuevaFuncionBuscar, $nuevaFuncion, $precioNuevo, $duracion, $hora);
echo "\n---------------------------------------------------\n";
//corroborar solapamiento de funciones
$funcionRepetida = $teatro->verificarFuncion();
if($funcionRepetida){
    echo "hay funciones que se solapan";
}else{
    echo "no hay funciones solapadas";
}
echo "\n---------------------------------------------------\n";
//dar precio aSlquiler
echo "precio alquiler: ".$teatro->darCostos();
echo "\n---------------------------------------------------\n";

//cambiar nombre teatro.
echo "Ingrese nuevo nombre del teatro";
$nombre = trim(fgets(STDIN));
echo "Ingrese nueva direccion del teatro";
$direccion = trim(fgets(STDIN));
$teatro->cambiarTeatro($nombre, $direccion);
echo $teatro;
?>
