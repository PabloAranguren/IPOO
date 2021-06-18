<?php 
include_once 'teatro.php';
/*
Implementar un script testTeatro.php que cree una instancia de la clase Teatro y presente un menú  que permita cargar la información del Teatro,
modificar y ver sus datos 
*/

$teatro = new Teatro("colon", "corrientes 2000");
echo $teatro;
print_r($teatro->getFunciones());
echo " ----------Nuevo teatro------ "."\n";
$teatro-cambiarTeatro("fulano", "calle no existe");
echo $teatro;
print_r($teatro->getFunciones());
echo " ----------Nueva Funcion------ "."\n";
$teatro-cambiarFunciones("Frozen", 700, 2);
echo $teatro;
print_r($teatro->getFunciones());

?>
