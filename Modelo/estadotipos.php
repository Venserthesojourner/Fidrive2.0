<?php

class estadotipos {
    private $idEstado;
    private $tipoEstado;
    private $descEstado;
    private static $mensajedeoperacion;

    /**
    * METODOS CONSTRUCTORES:
    */

    public function __construct(){
        $this->idEstado = 0;
        $this->tipoEstado = 1;
        $this->descEstado = "";
        self::$mensajedeoperacion = "";
    }

    public static function eT_construct($param){
        $obj = new estadotipos();
        $obj->setIdEstado($param['idestadotipos']);
        $obj->setTipoEstado($param['etactivo']);
        $obj->setDescEstado($param['etdescripcion']);
        return $obj;
    }

    public function cargar($id,$tipo,$desc){
        $this->setIdEstado($id);
        $this->setTipoEstado($tipo);
        $this->setDescEstado($desc);
    }

    public function setIdEstado($idEstado){$this->idEstado = $idEstado;}
    public function setTipoEstado($tipoEstado){$this->tipoEstado = $tipoEstado;}
    public function setDescEstado($descEstado){$this->descEstado = $descEstado;}
    private static function setMensajeOperacion($mensaje){self::$mensajedeoperacion = $mensaje;}

    public function getIdEstado() {return $this->idEstado;}    
    public function getTipoEstado(){return $this->tipoEstado;}    
    public function getDescEstado(){return $this->descEstado;}
    private static function getMensajedeoperacion(){return self::$mensajedeoperacion;}
    

    /* Metodos SQL*/
    public function insertDB(){
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO estadotipos (etdescripcion,etactivo) VALUES ('{$this->getDescEstado()}','{$this->getTipoEstado()}')";

        if ($base->Iniciar()){

            $sqlresponse = $base->Ejecutar($consulta);

            if ( $sqlresponse != -1){
                // Como la operacion fue exitosa obtuvimos el id del estado.
                $this->setIdEstado($sqlresponse);
                $resp = true;

            } else {
                // Mensaje de error: Fallo de Consulta
                self::setMensajeOperacion("Estado Tipos->Insertar: {$base->getError()}");
            }


        } else {
            // Mensaje de error: Fallo de conexion
            self::setMensajeOperacion("Estado Tipos->Insertar: {$base->getError()}");
        }

        return $resp;
    }

    public static function listarDB ($condicion = ""){
        $base = new BaseDatos();
        $listado = array();

        /*Generamos la consulta correspondiente*/
        $consulta = "SELECT * FROM estadotipos";
        if ($condicion != ""){
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idestadotipos";

        if ($base->Iniciar()){

            if ($base ->Ejecutar($consulta)){
                
                while ( $row2 = $base->Registro() ){

                    $id = $row2['idestadotipos'];
                    $desc = $row2['etdescripcion'];
                    $tipo = $row2['etactivo'];

                    //Creamos el objeto de la clase
                    $newOBJET = self::eT_construct($id,$desc,$tipo);
                    array_push($listado,$newOBJET);
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
        $consulta = "SELECT * FROM estadotipos WHERE {$campo} = {$parametro}";
        $find = null;
        
        if ($base->Iniciar()){
            if ($base->Ejecutar ( $consulta )) {
                $row2 = $base->Registro ();

                //Creamos el objeto de la clase
                $find = self::eT_construct($row2);
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
        $ref = $this->getIdEstado();
        if ($base->Iniciar()){
            foreach ($parametros as $clave => $parametro){
            $consulta = "UPDATE estadotipos SET {$clave}={$parametro} WHERE idestadotipos = {$ref}";
            echo $consulta;
            if ($base->Ejecutar ( $consulta )) {
                $resp++;
            } else {
                //Mensaje de Error: Fallo de Conexion
                self::setMensajeoperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
            }
            }

        } else {
            //Mensaje de Error: Fallo de Conexion
            self::setMensajeoperacion("Estado Tipo-> Actualizar-FL: {$base->getError()}");
        }
        return $resp;
    }
}
?>