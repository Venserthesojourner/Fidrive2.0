<?php


class archivocargado
{
    private $idarchivocargado;
    private $acnombre;
    private $acdescripcion;
    private $acicono;
    private $idusuario;
    private $aclinkacceso;
    private $accantidaddescarga;
    private $accantidadusada;
    private $acfechainiciocompartir;
    private $acefechafincompartir;
    private $acprotegidoclave;
    private static $mensajedeoperacion;

    public function __construct()
    {
        $this->idarchivocargado = 0;
        $this->acnombre = "";
        $this->acdescripcion = "";
        $this->acicono = "";
        $this->idusuario = new usuario();
        $this->aclinkacceso = "";
        $this->accantidaddescarga = 0;
        $this->accantidadusada = 0;
        $this->acfechainiciocompartir = null;
        $this->acefechafincompartir = null;
        $this->acprotegidoclave = "";
        self::$mensajedeoperacion = "";
    }

    public static function AC_construct($param)
    {
        $obj = new archivocargado();
        $obj->setIDarchivocargado(isset($param['idarchivocargado']) ? $param['idarchivocargado'] : null);
        $obj->setACnombre(isset($param['acnombre']) ? $param['acnombre'] : null);
        $obj->setACdescription(isset($param['acdescripcion']) ? $param['acdescripcion'] : null);
        $obj->setACIcon(isset($param['acicono']) ? $param['acicono'] : null);
        $obj->setAClink(isset($param['aclinkacceso']) ? $param['aclinkacceso'] : null);
        $obj->setACantDescargas(isset($param['accantidaddescarga']) ? $param['accantidaddescarga'] : null);
        $obj->getACantusadas(isset($param['accantidadusada']) ? $param['accantidadusada'] : null);
        $obj->getAFechaini(isset($param['acfechainiciocompartir']) ? $param['acfechainiciocompartir'] : null);
        $obj->getAFechafin(isset($param['acefechafincompartir']) ? $param['acefechafincompartir'] : null);
        $obj->getAPClave(isset($param['acprotegidoclave']) ? $param['acprotegidoclave'] : null);

        if (isset($param['idusuario'])) {
            $user = usuario::buscarDB("idusuario", $param['idusuario']);

            $obj->setIDusuario($user);
        }
        return $obj;
    }

    public function getIDarchcargado()
    {
        return $this->idarchivocargado;
    }
    public function getACnombre()
    {
        return $this->acnombre;
    }
    public function getACdesc()
    {
        return $this->acdescripcion;
    }
    public function getAicon()
    {
        return $this->acicono;
    }
    public function getUsuario()
    {
        return $this->idusuario;
    }
    public function getACLink()
    {
        return $this->aclinkacceso;
    }
    public function getACantDescargas()
    {
        $this->accantidaddescarga;
    }
    public function getACantusadas()
    {
        $this->accantidadusada;
    }
    public function getAFechaini()
    {
        $this->acfechainiciocompartir;
    }
    public function getAFechafin()
    {
        $this->acefechafincompartir;
    }
    public function getAPClave()
    {
        $this->acprotegidoclave;
    }
    public static function getMensajedeOperacion()
    {
        return self::$mensajedeoperacion;
    }

    private function getIDusuario()
    {
        return $this->getUsuario()->getIduser();
    }

    public function setIDarchivocargado($idAC)
    {
        $this->idarchivocargado = $idAC;
    }
    public function setACnombre($acname)
    {
        $this->acnombre = $acname;
    }
    public function setACdescription($acdesc)
    {
        $this->acdescripcion = $acdesc;
    }
    public function setACIcon($acicon)
    {
        $this->acicono = $acicon;
    }
    public function setIDusuario($iduser)
    {
        $this->idusuario = $iduser;
    }
    public function setAClink($aclink)
    {
        $this->aclinkacceso = $aclink;
    }
    public function setACantDescargas($acadesc)
    {
        $this->acfechainiciocompartir = $acadesc;
    }
    public function setACantusadas($acusada)
    {
        $this->accantidadusada = $acusada;
    }
    public function setAFechaini($fechaini)
    {
        $this->acfechainiciocompartir = $fechaini;
    }
    public function setAFechafin($fechafin)
    {
        $this->acefechafincompartir = $fechafin;
    }
    public function setAPClave($apclave)
    {
        $this->acprotegidoclave = $apclave;
    }
    public static function setMensajedeOperacion($msj)
    {
        self::$mensajedeoperacion = $msj;
    }

    /* Metodos SQL*/
    public function insertDB(): bool
    {
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO archivocargado (acnombre,acdescripcion,acicono,idusuario) 
    VALUES ('{$this->getACnombre()}','{$this->getACdesc()}','{$this->getAicon()}','{$this->getIDusuario()}')";

        if ($base->Iniciar()) {

            $sqlresponse = $base->Ejecutar($consulta);

            if ($sqlresponse != -1) {
                // Como la operacion fue exitosa obtuvimos el id del estado.
                $this->setIDarchivocargado($sqlresponse);
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
        $consulta = "SELECT * FROM archivocargado";
        if ($condicion != "") {
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idarchivocargado";

        if ($base->Iniciar()) {

            if ($base->Ejecutar($consulta)) {

                while ($row2 = $base->Registro()) {
                    //Creamos el objeto de la clase
                    $newOBJET = self::AC_construct($row2);
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
        $consulta = "SELECT * FROM archivocargado WHERE {$campo} = {$parametro}";
        $find = null;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $row2 = $base->Registro();
                //Creamos el objeto de la clase
                $find = self::AC_construct($row2);
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

    public function actualizardDB($condicion)
    {
        $resp = 0;
        $base = new BaseDatos();
        $ref = $this->getIDarchcargado();
        $consulta = "UPDATE archivocargado SET {$condicion} WHERE idarchivocargado = {$ref}";
        if ($base->Iniciar()) {
            $resp = $base->Ejecutar($consulta);
        } else {
            //Mensaje de Error: Fallo de Conexion
            self::setMensajedeOperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
        }
        return $resp;
    }
}
