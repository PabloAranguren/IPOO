<?php
include_once 'teatro2.php';
include_once 'funcion.php';

function menu(){
    echo "Menu de opciones"."\n";
    echo "1 - Ingresar datos al teatro"."\n";
    echo "2 - Verificar si las funciones se repiten en un mismo horario en el Teatro"."\n";
    echo "3 - Cambiar nombre de teatro y direccion"."\n";
    echo "4 - Cambiar una funcion "."\n";
    echo "5 - Visualizar informacion"."\n";
    echo "0 - Salir"."\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

function main(){
   
    do{
        $opcionMenu = menu();
        if( $opcionMenu == 1){
            echo "Ingrese nombre de teatro"."\n";
            $nombTeatro = trim(fgets(STDIN));
            echo "Ingrese direccion de teatro\n";
            $direcTeatro = trim(fgets(STDIN));
            echo "Ingrese cantidad de funciones a agregar";
            $cantidadFuncion = trim(fgets(STDIN));
            $arregloFuncion = array();
            for($i = 0; $i < $cantidadFuncion; $i++){
                echo "Ingrese nombre de la funcion"."\n";
                $nombFuncion = trim(fgets(STDIN));
                echo "Ingrese precio de la funcion"."\n";
                $precioFuncion = trim(fgets(STDIN));
                echo "Ingrese hora de la funcion"."\n";
                $horaInicio = trim(fgets(STDIN));
                echo "Ingrese duracion de la funcion"."\n";
                $duracion = trim(fgets(STDIN));
                $funcion = new funcion ($nombFuncion,$horaInicio,$duracion,$precioFuncion);
                $arregloFuncion[$i] = $funcion;
            }
            $teatro = new teatro($nombTeatro,$direcTeatro,$arregloFuncion);
           }
           elseif($opcionMenu == 2){
               $horarepetida = $teatro->verificarFuncion();
               if($horarepetida){
                   echo "hay funciones que tienen el mismo horario"."\n";
               }else{
                   echo "no hay horas iguales"."\n";
               }
           }     
           elseif( $opcionMenu == 3){
                echo "Ingrese nuevo nombre del teatro"."\n";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese nueva direccion del teatro"."\n";
                $direccion = trim(fgets(STDIN));
                $teatro->cambiarTeatro($nombre, $direccion);
            }
            elseif( $opcionMenu == 4){
                echo "Ingrese el nombre de la nueva funcion"."\n";
                $nuevaFuncion = trim(fgets(STDIN));
                echo "Ingrese precio de la nueva funcion"."\n";
                $precioNuevo = trim(fgets(STDIN));
                echo "Ingrese duracion de la nueva funcion"."\n";
                $duracion = trim(fgets(STDIN));
                echo "Ingrese hora de la nueva funcion"."\n";
                $hora = trim(fgets(STDIN));
                echo "Ingrese el numero de la funcion a reemplazar"."\n";
                $posicion = trim(fgets(STDIN));
                $teatro->cambiarFunciones($nuevaFuncion, $precioNuevo, $duracion, $hora, $posicion);
            }
            elseif($opcionMenu == 5){
                echo $teatro;
            } 
    }while ($opcionMenu != 0);
}
main();

?>
