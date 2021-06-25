<?php
include_once 'BaseDatos.php';
include_once 'Teatro.php';
include_once 'Funcion.php';
include_once 'Cine.php';
include_once 'Musical.php';
include_once 'Obra.php';
/********************************************************************MAIN****************************************************************************************************/
$objTeatro = new Teatro();
$objFuncion = new Funcion();

do {
    $opcion = menu();
    switch ($opcion) {
        case 1:
            crearTeatro();
            break;
        case 2:
            modificarNombreTeatro($objTeatro);
            break;
        case 3:
            modificarDireccionTeatro($objTeatro);
            break;
        case 4:
            agregarFunciones($objTeatro);
            break;
        case 5:
            modificarNombreFuncion($objFuncion);
            break;
        case 6:
            modificarPrecioFuncion($objFuncion);
            break;
        case 7:
            borrarFuncion();
            break;
        case 8:
            obtenerCostoTeatro($objTeatro);
            break;
        case 9:
            mostrarDatosTeatro($objTeatro);
            break;
        case 10:
            eliminarTeatro();
            break;
        case 0:
            echo "------------------------------FIN DEL PROGRAMA------------------------------\n";
            break;
        default:
            echo "OPCION INVALIDA\n";
            break;
    }
} while ($opcion != 0);

/*
 * MENU
 * Muestra y lee la opcion a ejecutar
 */
function menu()
{
    echo "MENU DE OPCIONES\n";
    echo "1: Crear teatro\n";
    echo "2: Modificar nombre del teatro\n";
    echo "3: Modificar direccion del teatro\n";
    echo "4: Agregar funciones al teatro\n";
    echo "5: Modificar nombre de una funcion\n";
    echo "6: Modificar precio de una funcion\n";
    echo "7: Borrar una funcion\n";
    echo "8: Obtener costo total del teatro\n";
    echo "9: Mostrar datos del teatro\n";
    echo "10: Eliminar teatro\n";
    echo "0: Finalizar programa\n";
    echo "Opcion = ";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}
/**
 * OPCION 1
 */
function crearTeatro()
{
    echo "Ingrese el nombre del teatro: \n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese la direccion del teatro: \n";
    $direccion = trim(fgets(STDIN));
    $teatro = new Teatro();
    $teatro->cargar(null, $nombre, $direccion);
    $esta = $teatro->insertar();
    if ($esta) {
        echo "Teatro cargado correctamente\n";
    } else {
        echo "No se pudo cargar el teatro\n";
    }
}
/**
 * OPCION 2
 */
function modificarNombreTeatro($objTeatro)
{
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo $teatro;
        echo "\n----------------------------------------\n";
    }
    echo "Ingrese el id del teatro que desea modificar: \n";
    $idTeatro = trim(fgets(STDIN));
    $objTeatroBusqueda = new Teatro();
    $respBusqueda = $objTeatroBusqueda->buscar($idTeatro);
    if ($respBusqueda) {
        echo "TEATRO ENCONTRADO: \n";
        echo "--------------------------------------------------------\n";
        echo "Ingrese el nuevo nombre: \n";
        $nuevoNombre = trim(fgets(STDIN));
        $objTeatroBusqueda->setNombre($nuevoNombre);
        $exito = $objTeatroBusqueda->modificar($idTeatro);
        if ($exito) {
            echo "Nombre del teatro modificado correctamente\n";
        } else {
            echo "Nombre del teatro NO puede ser modificado\n";
        }
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 3
 */
function modificarDireccionTeatro($objTeatro)
{
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo $teatro;
        echo "\n----------------------------------------\n";
    }
    echo "Ingrese el id del teatro que desea modificar: \n";
    $idTeatro = trim(fgets(STDIN));
    $objTeatroBusqueda = new Teatro();
    $respBusqueda = $objTeatroBusqueda->buscar($idTeatro);
    if ($respBusqueda) {
        echo "TEATRO ENCONTRADO: \n";
        echo "--------------------------------------------------------\n";
        echo "Ingrese la nueva direccion: \n";
        $nuevaDireccion = trim(fgets(STDIN));
        $objTeatroBusqueda->setDireccion($nuevaDireccion);
        $exito = $objTeatroBusqueda->modificar($idTeatro);
        if ($exito) {
            echo "Direccion del teatro modificado correctamente\n";
        } else {
            echo "La direccion del teatro NO puedo ser modificada\n";
        }
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 4
 */
function agregarFunciones($objTeatro)
{
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo "\n---------------------------------------------------------\n" . $teatro . "\n---------------------------------------------------------\n";
    }
    echo "Ingrese el id del teatro al que desea agregarle funciones: \n";
    $idTeatro = trim(fgets(STDIN));
    $respBusqueda = $objTeatro->Buscar($idTeatro);
    if ($respBusqueda) {
        $valida = false;
        do {
            echo "Ingrese el nombre de la funcion: ";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese el precio de la funcion: ";
            $precio = trim(fgets(STDIN));
            echo "Ingrese la fecha de la funcion: \n";
            echo "Ingrese el Dia: ";
            $dia = trim(fgets(STDIN));
            echo "Ingrese el Mes: ";
            $mes = trim(fgets(STDIN));
            echo "Ingrese el Anio: ";
            $anio = trim(fgets(STDIN));
            echo "Ingrese la hora de inicio (hh:mm): ";
            $horainicio = trim(fgets(STDIN));
            echo "Ingrese la duracion en minutos: ";
            $duracion = trim(fgets(STDIN));
            $fecha = $anio . "/" . $mes . "/" . $dia;
            $datos = [
                'idfuncion' => null,
                'nombre' => $nombre,
                'precio' => $precio,
                'fecha' => $fecha,
                'horainicio' => $horainicio,
                'duracion' => $duracion,
                'objteatro' => $objTeatro,
                'genero' => null,
                'pais' => null,
                'director' => null,
                'cantpersonas' => null,
            ];
            echo "Ingrese el tipo de funcion: (cine/musical/obra) \n";
            $tipo = strtolower(trim(fgets(STDIN)));
            switch ($tipo) {
                case "cine":
                    echo "Ingrese el genero: ";
                    $genero = trim(fgets(STDIN));
                    echo "Ingrese el pais de origen: ";
                    $pais = trim(fgets(STDIN));
                    $datos['genero'] = $genero;
                    $datos['pais'] = $pais;
                    $valida = true;
                    break;
                case "musical":
                    echo "Ingrese el director: ";
                    $director = trim(fgets(STDIN));
                    echo "Ingrese la cantidad de personas en escena: ";
                    $cantpersonas = trim(fgets(STDIN));
                    $datos['director'] = $director;
                    $datos['cantpersonas'] = $cantpersonas;
                    $valida = true;
                    break;
                case "obra":
                    $valida = true;
                    break;
                default:
                    echo "Tipo de funcion invalido\n";
                    $valida = false;
                    break;
            }
            if ($valida) {
                $esta = $objTeatro->agregarFuncion($datos, $tipo, $idTeatro);
                if ($esta) {
                    echo "Funcion agregada correctamente\n";
                } else {
                    echo "La Funcion NO se pudo Agregar\n";
                }
            }
            echo "Desea agregar una nueva funcion? (s/n)";
            $op = strtolower(trim(fgets(STDIN)));
        } while ($op != 'n');
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 5
 */
function modificarNombreFuncion($objFuncion)
{
    $coleccionFunciones = $objFuncion->listar("");
    foreach ($coleccionFunciones as $funcion) {
        echo $funcion . "\n----------------------------------------------------------\n";
    }
    echo "Ingrese el ID de la funcion que quiera modificar: \n";
    $idFuncion = trim(fgets(STDIN));
    $objFuncionBusqueda = new Funcion();
    $respBusqueda = $objFuncionBusqueda->Buscar($idFuncion);
    if ($respBusqueda) {
        echo "Nombre actual: " . $objFuncionBusqueda->getNombre() . "\n";
        echo "Ingrese el nuevo nombre de la funcion: \n";
        $nuevoNombre = trim(fgets(STDIN));
        $objFuncionBusqueda->setNombre($nuevoNombre);
        $exito = $objFuncionBusqueda->modificar();
        if ($exito) {
            echo "Modificacion realizada correctamente\n";
        } else {
            echo "Modificacion NO realizada\n";
        }
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 6
 */
function modificarPrecioFuncion($objFuncion)
{
    $coleccionFunciones = $objFuncion->listar("");
    foreach ($coleccionFunciones as $funcion) {
        echo $funcion . "\n----------------------------------------------------------\n";
    }
    echo "Ingrese el ID de la funcion que quiera modificar: \n";
    $idFuncion = trim(fgets(STDIN));
    $objFuncionBusqueda = new Funcion();
    $respBusqueda = $objFuncionBusqueda->Buscar($idFuncion);
    if ($respBusqueda) {
        echo "Precio actual: $" . $objFuncionBusqueda->getPrecio() . "\n";
        echo "Ingrese el nuevo precio de la funcion: \n";
        $nuevoPrecio = trim(fgets(STDIN));
        $objFuncionBusqueda->setPrecio($nuevoPrecio);
        $exito = $objFuncionBusqueda->modificar();
        if ($exito) {
            echo "Modificacion realizada correctamente\n";
        } else {
            echo "La Modificacion NO pudo ser realizada\n";
        }
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 7
 */
function borrarFuncion()
{
    echo "Ingrese el id de la funcion que desea borrar: \n";
    $idFuncion = trim(fgets(STDIN));
    $objFuncionBusqueda = new Funcion();
    $respBusqueda = $objFuncionBusqueda->Buscar($idFuncion);
    if ($respBusqueda) {
        $exito = $objFuncionBusqueda->eliminar($idFuncion);
        if ($exito) {
            echo "Borrado realizado correctamente\n";
        } else {
            echo "El Borrado no pudo ser realizado\n";
        }
    } else {
        echo "Teatro inexistente\n";
    }
}
/**
 * OPCION 8
 */
function obtenerCostoTeatro($objTeatro)
{
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo $teatro . "\n---------------------------------------------------------\n";
    }
    echo "Ingrese el id del teatro que quiere mostrar el costo: \n";
    $idTeatro = trim(fgets(STDIN));
    $objTeatroBusqueda = new Teatro();
    $respBusqueda = $objTeatroBusqueda->Buscar($idTeatro);
    if ($respBusqueda) {
        $costo = $objTeatroBusqueda->darCostos();
        echo "El costo total del teatro $idTeatro es: $" . $costo . "\n";
    }
}
/**
 * OPCION 9
 */
function mostrarDatosTeatro($objTeatro)
{
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo  "\n--------------------------------------\n" . $teatro;
    }
}
/**
 * OPCION 10
 */
function eliminarTeatro()
{
    $objTeatro = new Teatro();
    $coleccionTeatros = $objTeatro->listar("");
    foreach ($coleccionTeatros as $teatro) {
        echo  "\n--------------------------------------\n" . $teatro;
    }
    echo "Ingrese el id del teatro que desea borrar: \n";
    $idTeatro = trim(fgets(STDIN));
    $objTeatro = new Teatro();
    $resultado = $objTeatro->Buscar($idTeatro);
    if ($resultado) {
        $operacion = $objTeatro->eliminar();
        if ($operacion) {
            echo "El teatro se elimino correctamente\n";
        } else {
            echo "El teatro no pudo ser eliminado\n";
        }
    } else {
        echo "EL teatro no existe\n";
    }
}
