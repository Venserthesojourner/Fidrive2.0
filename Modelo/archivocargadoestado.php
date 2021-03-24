<?php

class archivocargadoestado
{
    private $archivocargadoestado; // Int
    private $estadotipos; // Int
    private $acedescripcion; // String
    private $usuario; // Int
    private $acefechaingreso; // DATE
    private $acefechafin; // DATE
    private $archivocargado; // Int
    private static $mensajedeoperacion;

    public function __construct()
    {
        $this->archivocargadoestado = 0;
        $this->estadotipos = new estadotipos();
        $this->acedescripcion = "";
        $this->usuario = new usuario();
        $this->acefechaingreso = (new DateTime())->format('Y-m-d H:i:s');
        $this->acefechafin = 'null';
        $this->archivocargado = new archivocargado();
        self::$mensajedeoperacion = "";
    }

    public static function ace_construct(array $param)
    {
        if (array_key_exists("idarchivocargado", $param)) {
            $idET = estadotipos::buscarDB("idestadotipos", $param['idestadotipos']);
            $iduser = usuario::buscarDB("idusuario", $param['idusuario']);
            $idAC = archivocargado::buscarDB("idarchivocargado", $param['idarchivocargado']);
        }
        $obj = new archivocargadoestado();
        $obj->setarchivocargadoestado(array_key_exists("idarchivocargadoestado", $param) ? $param['idarchivocargadoestado'] : null);
        $obj->setestadotipos(isset($idET) ? $idET : null);
        $obj->setAcedescripcion(array_key_exists("acedescripcion", $param) ? $param['acedescripcion'] : null);
        $obj->setusuario(isset($iduser) ? $iduser : null);
        $obj->setarchivocargado(isset($idAC) ? $idAC : null);
        $obj->setAcefechaingreso(array_key_exists("acefechaingreso", $param) ? $param['acefechaingreso'] : (new DateTime())->format('Y-m-d H:i:s'));
        $obj->setAcefechafin(array_key_exists("acfechafin", $param) ? $param['acefechafin'] : null);
        return $obj;
    }

    public function getArchivoCargadoestado()
    {
        return $this->archivocargadoestado;
    }
    public function getEstadoTipos()
    {
        return $this->estadotipos;
    }
    public function getAcedescripcion()
    {
        return $this->acedescripcion;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getAcefechaingreso()
    {
        return $this->acefechaingreso;
    }
    public function getAcefechafin()
    {
        return $this->acefechafin;
    }
    public function getArchivoCargado()
    {
        return $this->archivocargado;
    }

    public static function getMensajeoperacion()
    {
        return self::$mensajedeoperacion;
    }

    private function getIDusuario()
    {
        return $this->getUsuario()->getIduser();
    }
    private function getIDarchivocargado()
    {
        return $this->getArchivoCargado()->getIDarchcargado();
    }
    private function getIDestadotipos()
    {
        return $this->getEstadoTipos()->getIdEstado();
    }

    public function setarchivocargadoestado($archivocargadoestado)
    {
        $this->archivocargadoestado = $archivocargadoestado;
    }
    public function setestadotipos($estadotipos)
    {
        $this->estadotipos = $estadotipos;
    }
    public function setAcedescripcion($acedescripcion)
    {
        $this->acedescripcion = $acedescripcion;
    }
    public function setusuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function setAcefechaingreso($acefechaingreso)
    {
        $this->acefechaingreso = $acefechaingreso;
    }
    public function setAcefechafin($acefechafin)
    {
        $this->acefechafin = $acefechafin;
    }
    public function setarchivocargado($archivocargado)
    {
        $this->archivocargado = $archivocargado;
    }

    public static function setMensajeoperacion($mensaje)
    {
        self::$mensajedeoperacion = $mensaje;
    }

    public function insertDB(): bool
    {
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO archivocargadoestado 
        (idestadotipos, acedescripcion, idusuario, idarchivocargado)
        VALUES
        ({$this->getIDEstadoTipos()},'{$this->getAcedescripcion()}',{$this->getIDusuario()},{$this->getIDArchivoCargado()})";


        if ($base->Iniciar()) {

            $id = $base->Ejecutar($consulta);

            if ($id <> -1) {

                $this->setarchivocargadoestado($id);
                $resp = true;
            } else {
                // Mensaje de error: Fallo de Consulta
                self::setMensajeoperacion("Archivo Cargado Estado -> Insertar: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de Conexion
            self::setMensajeoperacion("Archivo Cargado Estado -> Insertar: {$base->getError()}");
        }

        return $resp;
    }

    public static function listarDB($condicion = ""): array
    {
        $base = new BaseDatos();
        $listado = array();

        /*Generamos la consulta correspondiente*/
        $consulta = "SELECT * FROM archivocargadoestado";
        if ($condicion != "") {
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idarchivocargadoestado";
        if ($base->Iniciar()) {

            if ($base->Ejecutar($consulta)) {

                while ($row2 = $base->Registro()) {
                    //Creamos el objeto de la clase
                    $find = self::ace_construct($row2);
                    array_push($listado, $find);
                }
            } else {
                // Mensaje de error: Fallo de Consulta
                self::setMensajeOperacion("Estado Tipos->Listar: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajeOperacion("Estado Tipos->Listar: {$base->getError()}");
        }

        return $listado;
    }

    public static function buscarDB($campo, $parametro): archivocargadoestado
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM archivocargadoestado WHERE {$campo} = {$parametro}";
        $find = null;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $row2 = $base->Registro();
                //Creamos el objeto de la clase
                $find = self::ace_construct($row2);
            } else {
                // Mensaje de error: Fallo de busqueda
                self::setMensajeOperacion("Estado Tipos->Buscar - FB: {$base->getError()}");
            }
        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajeOperacion("Estado Tipos->Buscar - FL: {$base->getError()}");
        }

        return $find;
    }

    public function actualizardDB($condicion): int
    {
        $resp = 0;
        $base = new BaseDatos();
        $ref = $this->getArchivoCargadoestado();
        if ($base->Iniciar()) {
            $consulta = "UPDATE archivocargadoestado SET {$condicion} WHERE idarchivocargadoestado = {$ref}";
            $resp = $base->Ejecutar($consulta);
        } else {
            //Mensaje de Error: Fallo de Conexion
            self::setMensajeoperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
        }
        return $resp;
    }
}
