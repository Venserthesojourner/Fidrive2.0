<?php
class usuario{
    private $idUser;
    private $uName;
    private $uApellido;
    private $uLogin;
    private $uPassword;
    private $uActivo;
    private $roles;
    private static $mensajedeoperacion;

    public function __construct(){
        $this->idUser = 0;
        $this->uName = "";
        $this->uApellido = "";
        $this->uLogin = "";
        $this->uPassword = "";
        $this->uActivo = 1;
        $this->roles = array();
        self::$mensajedeoperacion = "";
    }

    public static function U_construct($param):usuario{
        $obj = new usuario();
        $obj->setIduser(isset ($param['idusuario']) ? $param['idusuario'] : null);
        $obj->setUname($param['usnombre']);
        $obj->setUapellido($param['usapellido']);
        $obj->setUlogin($param['uslogin']);
        $obj->setUpassword($param['usclave']);
        $obj->setRoles(isset ($param['idusuario']) ? $obj->obtenerListaRoles($param['idusuario']): null);
        return $obj;
    }

    public function getIduser(){return $this->idUser;}
    public function getUname(){return $this->uName;}
    public function getUapellido(){return $this->uApellido;}
    public function getUlogin(){return $this->uLogin;}
    public function getUpassword(){return $this->uPassword;}
    public function getUactivo(){return $this->uActivo;}
    public function getRoles(){return $this->roles;}
    public static function getmensajedeoperacion(){return self::$mensajedeoperacion;}

    public function setIduser($idUser){$this->idUser = $idUser;}
    public function setUname($uName){$this->uName = $uName;}
    public function setUapellido($uApellido){$this->uApellido = $uApellido;}
    public function setUlogin($uLogin){$this->uLogin = $uLogin;}
    public function setUpassword($uPassword){$this->uPassword = $uPassword;}
    public function setUactivo($uActivo){$this->uActivo = $uActivo;}
    public function setRoles($roles){$this->roles = $roles;}
    public static function setMensajedeOperacion($msj){self::$mensajedeoperacion = $msj;}


        /* Metodos SQL*/
    public function insertDB(){
        $base = new BaseDatos();
        $resp = false;

        $consulta = "INSERT INTO usuario (usnombre,usapellido,uslogin,usclave,usactivo) 
        VALUES ('{$this->getUname()}','{$this->getUapellido()}','{$this->getUlogin()}','{$this->getUpassword()}',{$this->getUactivo()})";

        if ($base->Iniciar()){

            $sqlresponse = $base->Ejecutar($consulta);

            if ( $sqlresponse != -1){
                // Como la operacion fue exitosa obtuvimos el id del estado.
                $this->setIduser($sqlresponse);
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

    public static function listarDB ($condicion = ""){
        $base = new BaseDatos();
        $listado = array();

        /*Generamos la consulta correspondiente*/
        $consulta = "SELECT * FROM usuario";
        if ($condicion != ""){
            $consulta = "{$consulta} WHERE {$condicion}";
        }
        $consulta = "{$consulta} ORDER BY idusuario";

        if ($base->Iniciar()){

            if ($base ->Ejecutar($consulta)){
                
                while ( $row2 = $base->Registro() ){                

                    //Creamos el objeto de la clase
                    $newOBJET = self::U_construct($row2);
                    array_push($listado,$newOBJET);
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
        $consulta = "SELECT * FROM usuario WHERE {$campo} = {$parametro}";
        $find = null;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $row2 = $base->Registro();
                //Creamos el objeto de la clase
                $find = self::U_construct($row2);
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

    public function actualizarDB ($parametros){
        $resp = 0;
        $base = new BaseDatos();
        $ref = $this->getIduser();
        if ($base->Iniciar()){
            
            $consulta = "UPDATE usuario SET {$parametros} WHERE idusuario = {$ref}";
            echo $consulta;
            if ($base->Ejecutar ( $consulta )) {
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

    public function añadirRol($rol){
        $consulta = "INSERT INTO usuariorol (idrol,idusuario) VALUES ({$rol},{$this->getIduser()}) ";
        $resp = False;
        if ($base->Iniciar()){

            $sqlresponse = $base->Ejecutar($consulta);

            if ( $sqlresponse != -1){
                // Como la operacion fue exitosa obtuvimos el id del estado.
                
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

    public function quitarRol($rol){
        $consulta = "DELETE FROM usuariorol WHERE idrol = {$rol}, idusuario = {$this->getIduser()} ";
        $resp = False;
        if ($base->Iniciar()){

            $sqlresponse = $base->Ejecutar($consulta);

            if ( $sqlresponse != -1){
                // Como la operacion fue exitosa obtuvimos el id del estado.
                
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

    public function obtenerListaRoles($idUsuario)
    {
        $base = new BaseDatos();
        $listado = array();
        $consulta = "SELECT roldescripcion FROM usuariorol INNER JOIN rol INNER JOIN usuario
        WHERE usuario.idusuario = usuariorol.idusuario AND usuariorol.idrol = rol.idrol AND usuario.idusuario = {$idUsuario}
        ORDER BY roldescripcion";
        if ($base->Iniciar()){

            if ($base ->Ejecutar($consulta)){
                
                while ( $row2 = $base->Registro() ){                
                    
                    //Creamos el objeto de la clase 
                    $dato = $row2['roldescripcion'];
                                  
                    $listado[] = $dato;
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
}

?>