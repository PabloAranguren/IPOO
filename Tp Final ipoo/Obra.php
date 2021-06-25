<?php
class Obra extends Funcion
{
    private $mensajeOperacion;
    //CONSTRUCTOR
    public function __construct()
    {
        parent::__construct();
        $this->mensajeOperacion = "";
    }
    //funcion cargar
    public function cargar($datosFuncion)
    {
        parent::cargar($datosFuncion);
    }
    //Metodos de ACCeso GET y SET
    //Metodos GET
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    //Metodos SET
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }
    /**
     * Metodo toString
     */
    public function __toString()
    {
        return parent::__toString();
    }
    /**
     * Retorna el costo de la funcion con el porcentaje adicional
     */
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 45) / 100;
        return $costo;
    }
    /********************************************************************************************************************************************************************* */
    /**
     * 
     * Setea al objeto con los valores recuperados de la tabla obra
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function Buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM obra WHERE idfuncion = " . $idfuncion;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($idfuncion);
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
     * Carga un arreglo con los valores recuperados de cada tupla de la tabla obra
     * Retorna un arreglo cargado con objetos o null.
     * @param string $condicion
     * @return array $arregloObra
     */
    public function listar($condicion)
    {
        $arregloObra = [];
        $base = new BaseDatos();
        $consulta = "SELECT * FROM obra INNER JOIN funcion ON obra.idFuncion=funcion.idFuncion ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloObra = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Obra();
                    $obj->Buscar($row2['idfuncion']);
                    array_push($arregloObra, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloObra;
    }
    /**
     * Inserta un nueva tupla en la tabla obra, el objeto debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        if (parent::insertar()) {
            $consulta = "INSERT INTO obra(idfuncion)
				VALUES (" . parent::getIdFuncion() . ")";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consulta)) {
                    $resp = true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    /**
     * Elimina una tupla de la tabla obra, el objeto debe estar previamente cargado. 
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function eliminar($idfuncion)
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM obra WHERE idfuncion = " . parent::getIdFuncion();
            if ($base->Ejecutar($consulta)) {
                if (parent::eliminar($idfuncion)) {
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
}
