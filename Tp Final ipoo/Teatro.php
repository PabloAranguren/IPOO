<?php
class Teatro
{
    //Atributos de la clase
    private $idteatro;
    private $nombre;
    private $direccion;
    private $colFunciones;
    private $mensajeOperacion;

    //Metodo Constuctor
    public function __construct()
    {
        $this->idteatro = "";
        $this->nombre = "";
        $this->direccion = "";
        $this->colFunciones = [];
        $this->mensajeOperacion = "";
    }
    //funcion para cargar datos
    public function cargar($id, $nombre, $direccion)
    {
        $this->setIdTeatro($id);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
    }
    //Metodos de Acceso GET y SET
    //Metodos GET
    public function getIdTeatro()
    {
        return $this->idteatro;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getColFunciones()
    {
        $idteatro = $this->getIdTeatro();
        $condicion = " idteatro=" . $idteatro;
        $musical = new Musical();
        $cine = new Cine();
        $obra = new Obra();
        $funcionesMusical = $musical->listar($condicion);
        $funcionesCine = $cine->listar($condicion);
        $funcionesObra = $obra->listar($condicion);
        $coleccionFunciones = array_merge($funcionesMusical, $funcionesCine, $funcionesObra); //Combina los elementos de uno o más arrays juntándolos de modo  que los valores de uno se anexan al final del anterior. Retorna el array resultante.*/
        $this->setColFunciones($coleccionFunciones);

        return $this->colFunciones;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    //Metodos SET
    public function setIdTeatro($id)
    {
        $this->idteatro = $id;
    }
    public function setNombre($n)
    {
        $this->nombre = $n;
    }
    public function setDireccion($d)
    {
        $this->direccion = $d;
    }
    public function setColFunciones($aF)
    {
        $this->colFunciones = $aF;
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
        return "ID Teatro: " . $this->getIdTeatro() . "\n" .
            "Teatro: " . $this->getNombre() . "\n" .
            "Direccion: " . $this->getDireccion() . "\n" .
            "Funciones:\n" . $this->verFuncion();
    }

    /**
     * Retorna la coleccion de funciones en forma de cadena de caracteres
     */
    private function verFuncion()
    {
        //Array Funcion $arreglo
        //String $retorno
        $retorno = "";
        $arreglo = $this->getColFunciones();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }
    //metodo para incorporar una funcion
    public function agregarFuncion($datosFuncion, $opcion, $idteatro)
    {
        $exito = false;
        $funcion = new Funcion();
        $coleccionFunciones = $funcion->listar("idteatro = $idteatro");
        $existe = false;
        $i = 0;
        while ($i < count($coleccionFunciones) && !$existe) {
            $existe = $this->validarFuncion($datosFuncion, $coleccionFunciones[$i]);
            $i++;
        }
        if (!$existe) {
            $exito = $this->crearFuncion($datosFuncion, $opcion);
        }
        return $exito;
    }
    //metodo para crear una funcion para poder agregarla
    private function crearFuncion($datos, $op)
    {
        $datos['idteatro'] = $this->getIdTeatro();
        switch ($op) {
            case "cine":
                $nuevaFuncion = new Cine();
                $nuevaFuncion->cargar($datos);
                break;
            case "musical":
                $nuevaFuncion = new Musical();
                $nuevaFuncion->cargar($datos);
                break;
            case "obra":
                $nuevaFuncion = new Obra();
                $nuevaFuncion->cargar($datos);
                break;
        }
        $exito = $nuevaFuncion->insertar();
        return $exito;
    }
    //metodo para verificar funcion comparando hora y fecha
    private function validarFuncion($datos, $objFuncion)
    {
        $horaInicioNueva = $datos['horainicio'];
        $fechaNueva = $datos['fecha'];
        $duracionNueva = $datos['duracion'];
        $horaAMinutosNueva = (intval(substr($horaInicioNueva, 0, 2)) * 60) + intval(substr($horaInicioNueva, 3));
        $duracionObjCargado = $objFuncion->getDuracion();
        $fechaObjCargado = $objFuncion->getFecha();
        $horaAMinutosObjCargado = $objFuncion->horaAMinutos();
        $horaFinalNueva = $horaAMinutosNueva + $duracionNueva;
        $horaFinalObjCargado = $horaAMinutosObjCargado + $duracionObjCargado;
        $existe = false;
        $mesFechaNueva = intval(substr($fechaNueva, 5, -3));
        $mesFechaObjCargado = intval(substr($fechaObjCargado, 5, -3));
        $diaFechaNueva = intval(substr($fechaNueva, 8));
        $diaFechaObjCargado = intval(substr($fechaObjCargado, 8));
        if ($mesFechaNueva == $mesFechaObjCargado && $diaFechaNueva == $diaFechaObjCargado) {
            if (($horaAMinutosNueva <= $horaFinalObjCargado) || $horaAMinutosObjCargado > $horaFinalNueva) {
                $existe = true;
            }
        }
        return $existe;
    }
    public function darCostos()
    {
        $arregloFunciones = $this->getColFunciones();
        $costoObra = 0;
        $costoCine = 0;
        $costoMusical = 0;
        $costoTotal = 0;
        foreach ($arregloFunciones as $objFuncion) {
            $precioFuncion = $objFuncion->darCostos();
            switch (get_class($objFuncion)) {
                case "Obra":
                    $costoObra += $precioFuncion;
                    break;
                case "Cine":
                    $costoCine += $precioFuncion;
                    break;
                case "Musical":
                    $costoMusical += $precioFuncion;
                    break;
            }
        }
        $costoTotal = $costoCine + $costoMusical + $costoObra;
        return "\n\tObras: $" . $costoObra .
            "\n\tCine: $" . $costoCine .
            "\n\tMusicales: $" . $costoMusical .
            "\n\tCosto total: $" . $costoTotal;
    }
    /************************************************************************************************************************************************************************* */
    /**
     * 
     * Setea al objeto con los valores recuperados de la tabla teatro
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @param int $idteatro
     * @return boolean $resp
     */
    public function Buscar($idteatro)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM teatro WHERE idteatro = " . $idteatro;
        $resp = false;
        if ($base->Iniciar()) { //devuelve true/false si se pudo establecer conexion con la base de datos
            if ($base->Ejecutar($consulta)) { //ejecuta la consulta y me devuelve si se pudo concretar o no (true o fale)
                if ($row2 = $base->Registro()) { //me devuelve una array asociativo con la tupla de la tabla en la que esta apuntando el cursor en ese momento, luego avansa al siguiente punto. 
                    $this->setIdTeatro($idteatro);
                    $this->setNombre($row2['nombre']);
                    $this->setDireccion($row2['direccion']);
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
     * Carga un arreglo con los valores recuperados de cada tupla de la tabla teatro
     * Retorna un arreglo cargado con objetos o null.
     * @param string $condicion
     * @return array $arregloTeatro
     */
    public function listar($condicion)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM teatro ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY nombre";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloTeatro = [];
                while ($row2 = $base->Registro()) { // row2 es un arreglo asociativo q corresponde a una tupla de la tabla
                    $idteatro = $row2['idteatro'];
                    $teatro = new Teatro();
                    $teatro->buscar($idteatro);
                    array_push($arregloTeatro, $teatro); //agrega un nuevo objeto ala coleccion de teatros
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloTeatro;
    }
    /**
     * Inserta un nueva tupla en la tabla teatro, el objeto debe estar previamente cargado.
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $nombre = $this->getNombre();
        $direccion = $this->getDireccion();
        $consulta = "INSERT INTO teatro(nombre, direccion)
		VALUES ('{$nombre}', '{$direccion}')";
        //echo "\n".$consulta."\n";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consulta)) { //se usa cuando se trabaja con id autoincrementables, me devuelve la id si la consulta pudo ser realizada
                $this->setIdTeatro($id);
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
     * @param int $idteatro
     * @return boolean $resp
     */
    public function modificar($idteatro)
    {
        $resp = false;
        $base = new BaseDatos();
        $consulta = "UPDATE teatro SET nombre = '" . $this->getNombre() . "', direccion = '" . $this->getDireccion() . "' WHERE idteatro = " . $idteatro;
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
     * Elimina una tupla de la tabla teatro, el objeto debe estar previamente cargado. 
     * Retorna true si la ejecucion fue correcta, false caso contrario.
     * @return boolean $resp
     */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM teatro WHERE idteatro = " . $this->getIdTeatro();
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
