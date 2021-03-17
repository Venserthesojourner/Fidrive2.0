<?php

class rol
{
    private int $idrol;
    private string $roldesc;
    private int $cantGBdisponibles;
    private static string $mensajeoperacion;

    public function __construct()
    {
        $this->idrol = 0;
        $this->roldesc = "";
        $this->cantGBdisponibles = 0;
        self::$mensajeoperacion = "";
    }

    public static function rolConstruct($param)
    {
        $obj = new rol();
        $obj->setIDrol(isset($param["idrol"]) ? $param["idrol"] : null);
        $obj->setIDdesc(isset($param["idrol"]) ? $param["idrol"] : null);
        $obj->setCantGBDisp(isset($param["idrol"]) ? $param["idrol"] : null);
        self::$mensajeoperacion = "";
    }

    public function getIDrol()
    {
        return $this->idrol;
    }
    public function getRoldesc()
    {
        return $this->roldesc;
    }
    public function getcGBdisp()
    {
        return $this->cantGBdisponibles;
    }

    public function setIDrol($id)
    {
        $this->idrol = $id;
    }
    public function setIDdesc($desc)
    {
        $this->roldesc = $desc;
    }
    public function setCantGBDisp($cantGB)
    {
        $this->cantGBdisponibles = $cantGB;
    }

    public static function getMensajeOperacion()
    {
        return self::$mensajeoperacion;
    }
    public static function setMensajedeOperacion($msj)
    {
        self::$mensajeoperacion = $msj;
    }
    /* Metodos SQL*/
    public function insertDB()
    {
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO rol (idrol,roldescripcion,cantGBdisponibles) 
            VALUES ({$this->getIDrol()},'{$this->getRoldesc()}',{$this->getcGBdisp()})";

        if ($base->Iniciar()) {

            $sqlresponse = $base->Ejecutar($consulta);

            if ($sqlresponse != -1) {
                // Como la operacion fue exitosa obtuvimos el id del estado.
                $this->setIDrol($sqlresponse);
                $resp = true;
            } else {
                // Mensaje de error: Fallo de Consulta
                self::setMensajedeOperacion("Estado Tipos->Insertar: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajedeOperacion("Estado Tipos->Insertar: {$base->getError()}");
        }

        return $resp;
    }

    public static function listarDB($condicion = "")
    {
        $base = new BaseDatos();
        $listado = array();

        /*Generamos la consulta correspondiente*/
        $consulta = "SELECT * FROM rol";
        if ($condicion != "") {
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idrol";

        if ($base->Iniciar()) {

            if ($base->Ejecutar($consulta)) {

                while ($row2 = $base->Registro()) {

                    //Creamos el objeto de la clase
                    $newOBJET = self::rolConstruct($row2);
                    array_push($listado, $newOBJET);
                }
            } else {
                // Mensaje de error: Fallo de Consulta
                self::setMensajedeOperacion("Estado Tipos->Listar: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajedeOperacion("Estado Tipos->Listar: {$base->getError()}");
        }

        return $listado;
    }

    public static function buscarDB($campo, $parametro)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM rol WHERE {$campo} = {$parametro}";
        $find = null;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $row2 = $base->Registro();
                //Creamos el objeto de la clase
                $find = self::rolConstruct($row2);
            } else {
                // Mensaje de error: Fallo de busqueda
                self::setMensajedeOperacion("Estado Tipos->Buscar - FB: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajedeOperacion("Estado Tipos->Buscar - FL: {$base->getError()}");
        }

        return $find;
    }

    public function actualizarDB($parametros)
    {
        $resp = 0;
        $base = new BaseDatos();
        $ref = $this->getIDrol();
        if ($base->Iniciar()) {

            $consulta = "UPDATE rol SET {$parametros} WHERE idrol = {$ref}";
            echo $consulta;
            if ($base->Ejecutar($consulta)) {
                $resp++;
            } else {
                //Mensaje de Error: Fallo de Conexion
                self::setMensajedeOperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
            }
        } else {
            //Mensaje de Error: Fallo de Conexion
            self::setMensajedeOperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
        }
        return $resp;
    }
}
