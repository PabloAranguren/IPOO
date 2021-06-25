<?php
class Musical extends Funcion
{
    //ATRIBUTOS
    private $director;
    private $cantPersonas;
    private $mensajeOperacion;

    //CONSTRUCTOR
    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantPersonas = "";
        $this->mensajeOperacion = "";
    }
    //funcion cargar
    public function cargar($datosFuncion)
    {
        parent::cargar($datosFuncion);
        $this->setDirector($datosFuncion['director']);
        $this->setCantPersonas($datosFuncion['cantpersonas']);
    }
    //Metodos de Acceso GET y SET
    //Metodos GET
    public function getDirector()
    {
        return $this->director;
    }
    public function getCantPersonas()
    {
        return $this->cantPersonas;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    //Metodos SET
    public function setDirector($d)
    {
        $this->director = $d;
    }
    public function setCantPersonas($cantPersonas)
    {
        $this->cantPersonas = $cantPersonas;
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
            "\n\tDirector: " . $this->getDirector() .
            "\n\tCantidad de personas en escena: " . $this->getCantPersonas();
    }
    /**
     * Retorna el costo de la funcion con el porcentaje adicional
     */
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 12) / 100;
        return $costo;
    }
    /********************************************************************************************************************************************************************* */
    /**
     * 
     * Setea al objeto con los valores recuperados de la tabla musical
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */

    public function Buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM musical WHERE idfuncion = " . $idfuncion;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($idfuncion);
                    $this->setDirector($row2['director']);
                    $this->setCantPersonas($row2['cantpersonas']);
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
     * Carga un arreglo con los valores recuperados de cada tupla de la tabla musical
     * Retorna un arreglo cargado con objetos o null.
     * @param string $condicion
     * @return array $arregloMusical
     */
    public function listar($condicion)
    {
        $arregloMusical = [];
        $base = new BaseDatos();
        $consulta = "SELECT * FROM musical INNER JOIN funcion ON musical.idFuncion=funcion.idFuncion ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY director ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloMusical = array();

                while ($row2 = $base->Registro()) {
                    $obj = new Musical();
                    $obj->Buscar($row2['idfuncion']);
                    array_push($arregloMusical, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloMusical;
    }
    /**
     * Inserta un nueva tupla en la tabla musical, el objeto debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        if (parent::insertar()) {
            $consulta = "INSERT INTO musical(idfuncion, director, cantpersonas)
				VALUES (" . parent::getIdFuncion() . ", '" . $this->getDirector() . "', " . $this->getCantPersonas() . ")";

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
            $consulta = "UPDATE musical SET director = '" . $this->getDirector() . "', cantpersonas = " . $this->getCantPersonas() . "WHERE idfuncion = " . parent::getIdFuncion();
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
     * Elimina una tupla de la tabla musical, el objeto debe estar previamente cargado. 
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idfuncion
     * @return boolean $resp
     */
    public function eliminar($idfuncion)
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM musical WHERE idfuncion = " . parent::getIdFuncion();
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
