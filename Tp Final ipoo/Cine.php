<?php

class Cine extends Funcion
{
    //Atributos de la clase
    private $genero;
    private $pais;
    private $mensajeOperacion;

    //Metodo constructor
    public function __construct()
    {
        parent::__construct();
        $this->genero = "";
        $this->pais = "";
        $this->mensajeOperacion = "";
    }
    //funcion para cargar datos
    public function cargar($datosFuncion)
    {
        parent::cargar($datosFuncion);
        $this->setGenero($datosFuncion['genero']);
        $this->setPais($datosFuncion['pais']);
    }
    //Metodos Acceso GET y SET
    //Metodos GET
    public function getGenero()
    {
        return $this->genero;
    }
    public function getPais()
    {
        return $this->pais;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    //Metodos SET
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    public function setPais($pais)
    {
        $this->pais = $pais;
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
        return parent::__toString() .
            "\n\tGenero: " . $this->getGenero() .
            "\n\tPais de origen: " . $this->getPais();
    }
    /**
     * Retorna el costo de la funcion con el porcentaje adicional
     */
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 65) / 100;
        return $costo;
    }
    /********************************************************************************************************************************************************************* */
    /**
     * 
     * Setea al objeto con los valores recuperados de la tabla cine
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function Buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM cine WHERE idfuncion = " . $idfuncion;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($idfuncion);
                    $this->setGenero($row2['genero']);
                    $this->setPais($row2['pais']);
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
     * Carga un arreglo con los valores recuperados de cada tupla de la tabla cine
     * Retorna un arreglo cargado con objetos o null.
     * @param string $condicion
     * @return array $arregloCine
     */
    public function listar($condicion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM cine  INNER JOIN funcion ON cine.idFuncion=funcion.idFuncion ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY genero ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloCine = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Cine();
                    $obj->Buscar($row2['idfuncion']);
                    array_push($arregloCine, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloCine;
    }
    /**
     * Inserta un nueva tupla en la tabla cine, el objeto debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;

        if (parent::insertar()) {
            $consulta = "INSERT INTO cine(idfuncion, genero, pais)
				VALUES (" . parent::getIdFuncion() . ", '" . $this->getGenero() . "', '" . $this->getPais() . "')";
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
     * Actualiza los valores de los atributos del objeto, el mismo debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consulta = "UPDATE cine SET genero = '" . $this->getGenero() . "', pais = '" . $this->getPais() . "' WHERE idfuncion = " . parent::getIdFuncion();
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
     * Elimina una tupla de la tabla cine, el objeto debe estar previamente cargado. 
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function eliminar($idfuncion)
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM cine WHERE idfuncion = " . parent::getIdFuncion();
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
