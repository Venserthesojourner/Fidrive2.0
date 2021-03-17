<?php

class archivocargadoestado {
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

    public static function ace_construct($param){
        if (isset($param['idarchivocargado'])){
        $idET = estadotipos::buscarDB("idestadotipos",$param['idestadotipos']);                
        $iduser = usuario::buscarDB("idusuario",$param['idusuario']);
        $idAC = archivocargado::buscarDB("idarchivocargado",$param['idarchivocargado']);
        }
        $obj = new archivocargadoestado();
        $obj->setarchivocargadoestado(isset($param['idarchivocargadoestado'])?$param['idarchivocargadoestado']:null);
        $obj->setestadotipos(isset($idET)?$idET:null);
        $obj->setAcedescripcion(isset($param['acedescripcion'])?$param['acedescripcion']:null);
        $obj->setusuario(isset($iduser)?$iduser:null);
        $obj->setarchivocargado(isset($idAC)?$idAC:null);
        $obj->setAcefechaingreso(isset($param['acefechaingreso'])?$param['acefechaingreso']:(new DateTime())->format('Y-m-d H:i:s'));
        $obj->setAcefechafin(isset($param['acefechafin'])?$param['acefechafin']:null);
        return $obj;
    }

    public function getArchivoCargadoestado(){return $this->archivocargadoestado;}
    public function getEstadoTipos(){return $this->estadotipos;}
    public function getAcedescripcion(){return $this->acedescripcion;}
    public function getUsuario(){return $this->usuario;}
    public function getAcefechaingreso(){return $this->acefechaingreso;}
    public function getAcefechafin(){return $this->acefechafin;}
    public function getArchivoCargado(){return $this->archivocargado;}

    public static function getMensajeoperacion (){return self::$mensajedeoperacion;}

    private function getIDusuario(){return $this->getUsuario()->getIduser();}
    private function getIDarchivocargado(){return $this->getArchivoCargado()->getIDarchcargado();}
    private function getIDestadotipos(){return $this->getEstadoTipos()->getIdEstado();}

    public function setarchivocargadoestado($archivocargadoestado){$this->archivocargadoestado = $archivocargadoestado;}
    public function setestadotipos($estadotipos){$this->estadotipos = $estadotipos;}
    public function setAcedescripcion($acedescripcion){$this->acedescripcion = $acedescripcion;}
    public function setusuario($usuario){$this->usuario = $usuario;}
    public function setAcefechaingreso($acefechaingreso){$this->acefechaingreso = $acefechaingreso;}
    public function setAcefechafin($acefechafin){$this->acefechafin = $acefechafin;}
    public function setarchivocargado($archivocargado){$this->archivocargado = $archivocargado;}

    public static function setMensajeoperacion ($mensaje){self::$mensajedeoperacion = $mensaje;}

    public function insertDB (){
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO archivocargadoestado 
        (idestadotipos, acedescripcion, idusuario, idarchivocargado)
        VALUES
        ({$this->getIDEstadoTipos()},'{$this->getAcedescripcion()}',{$this->getIDusuario()},{$this->getIDArchivoCargado()})";


        if ($base->Iniciar()){

            $id = $base->Ejecutar($consulta);

            if ($id <> -1){

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

    public static function listarDB ($condicion = ""){
        $base = new BaseDatos();
        $listado = array();

        /*Generamos la consulta correspondiente*/
        $consulta = "SELECT * FROM archivocargadoestado";
        if ($condicion != ""){
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idarchivocargadoestado";
        if ($base->Iniciar()){

            if ($base ->Ejecutar($consulta)){
                
                while ( $row2 = $base->Registro() ){
                    //Creamos el objeto de la clase
                    $find = self::ace_construct($row2);
                    array_push($listado,$find);
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

    public static function buscarDB ($campo, $parametro){
        $base = new BaseDatos ();
        $consulta = "SELECT * FROM archivocargadoestado WHERE {$campo} = {$parametro}";
        $find = null;
        
        if ($base->Iniciar()){
            if ($base->Ejecutar ( $consulta )) {
                $row2 = $base->Registro ();
                
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

    public function actualizardDB ($parametros){
        $resp = 0;
        $base = new BaseDatos();
        $ref = $this->getArchivoCargadoestado();
        if ($base->Iniciar()){
            $condition = "";
            foreach ($parametros as $clave => $parametro){
                if ($condition != ""){
                    $condition .= " , ";
                }
                $condition .= "{$clave}={$parametro}";
            }
            $consulta = "UPDATE archivocargadoestado SET {$condition} WHERE idarchivocargadoestado = {$ref}";

            echo $consulta;
            if ($base->Ejecutar ( $consulta )) {
                $resp++;
            } else {
                //Mensaje de Error: Fallo de Conexion
                self::setMensajeoperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
            }
          

        } else {
            //Mensaje de Error: Fallo de Conexion
            self::setMensajeoperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
        }
        return $resp;
    }
}


?>