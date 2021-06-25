<?php
include_once 'Teatro.php';
class Funcion
{
    //Atributos de la clase
    private $idFuncion;
    private $nombre;
    private $precio;
    private $fecha;
    private $horaInicio;
    private $duracion;
    private $objTeatro;
    private $mensajeOperacion;

    //Metodo Constructor
    public function __construct()
    {
        $this->idFuncion = 0;
        $this->nombre = "";
        $this->precio = "";
        $this->fecha = "";
        $this->horaInicio = "";
        $this->duracion = "";
        $this->objTeatro = null;
        $this->mensajeOperacion = "";
    }
    //Metodo para cargar datos
    public function cargar($datos)
    {
        $this->setIdFuncion($datos['idfuncion']);
        $this->setNombre($datos['nombre']);
        $this->setPrecio($datos['precio']);
        $this->setFecha($datos['fecha']);
        $this->setHoraInicio($datos['horainicio']);
        $this->setDuracion($datos['duracion']);
        $this->setObjTeatro($datos['objteatro']);
    }
    //Metodos de Acceso GET y SET
    //Metodos GET
    public function getIdFuncion()
    {
        return $this->idFuncion;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }
    public function getDuracion()
    {
        return $this->duracion;
    }
    public function getObjTeatro()
    {
        return $this->objTeatro;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    //Metodos SET
    public function setIdFuncion($idFuncion)
    {
        $this->idFuncion = $idFuncion;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    public function setObjTeatro($idTeatro)
    {
        $this->objTeatro = $idTeatro;
    }
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }
    /**
     * Metodo toString
     */
    public function __toString()
    {
        return "\tID Funcion: " . $this->getIdFuncion() .
            "\n\tNombre: " . $this->getNombre() .
            "\n\tPrecio: $" . $this->getPrecio() .
            "\n\tHora funcion: " . $this->getHoraInicio() .
            "\n\tDuracion: " . $this->getDuracion() . " minutos";
    }
    //funcion convertir hora a minutos
    //intval Devuelve el valor integer de una var, con la especificada base para la conversión
    //substr Devuelve una parte del string	
    public function horaAMinutos()
    {
        $horario = $this->getHoraInicio();
        $minutos = intval(substr($horario, 0, 2)) * 60;
        $minutos += intval(substr($horario, 3));
        return $minutos;
    }
    public function darCostos()
    {
        return $this->getPrecio();
    }
    /************************************************************************************************************************************************************************* */
    /**
     * 
     * Setea al objeto con los valores recuperados de la tabla funcion
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function Buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consultaPersona = "SELECT * FROM funcion WHERE idfuncion = " . $idfuncion;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) {
                    $objteatro = new Teatro();
                    $objteatro->Buscar($row2['idteatro']);
                    $this->setIdFuncion($idfuncion);
                    $this->setNombre($row2['nombre']);
                    $this->setPrecio($row2['precio']);
                    $this->setFecha($row2['fecha']);
                    $this->setHoraInicio($row2['horainicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setObjTeatro($objteatro);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    /**
     * Carga un arreglo con los valores recuperados de cada tupla de la tabla funcion
     * Retorna un arreglo cargado con objetos o null.
     * @param string $condicion
     * @return array $arregloFuncion
     */
    public function listar($condicion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM funcion ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY nombre";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {
                    $funcion = new Funcion();
                    $funcion->Buscar($row2['idfuncion']);
                    array_push($arregloFuncion, $funcion);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloFuncion;
    }
    /**
     * Inserta un nueva tupla en la tabla funcion, el objeto debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $nombre = $this->getNombre();
        $precio = $this->getPrecio();
        $fecha = $this->getFecha();
        $hora = $this->getHoraInicio();
        $duracion = $this->getDuracion();
        $obj = $this->getObjTeatro();
        $idteatro = $obj->getIdTeatro();
        $consulta = "INSERT INTO funcion(nombre, precio, fecha, horainicio, duracion, idteatro)
		VALUES ('$nombre', $precio, '$fecha', '$hora', $duracion, $idteatro)";
        //echo "\n".$consulta."\n";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consulta)) {
                $this->setIdFuncion($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }
    /**
     * Actualiza los valores de los atributos del objeto, el mismo debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $id = $this->getObjTeatro()->getIdTeatro();
        $consulta = "UPDATE funcion SET nombre = '" . $this->getNombre() . "', precio = " . $this->getPrecio() . ", fecha = '" . $this->getFecha() . "', horainicio = '" . $this->getHoraInicio() .
            "', duracion = " . $this->getDuracion() . ",idteatro = " . $id . " WHERE idfuncion = " . $this->getIdFuncion();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    /**
     * Elimina una tupla de la tabla funcion, el objeto debe estar previamente cargado. 
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function eliminar($idfuncion)
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM funcion WHERE idfuncion = " . $idfuncion;
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
}
