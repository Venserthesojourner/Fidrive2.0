<?php


class controlSession{
    private $sesion;
    private $sites;
    private $default_sites;
    public function __construct()
    {
        $this-> iniciarVariableSession();
    }

    public function sesionActual (): session{
        return $this->sesion;
    }

    public static function cargarDatosSession ($parametros):void
    {
        session::cargarDatosSession ($parametros);
    }

    public function cerrarSession ()
    {
        if (!(($this->sesionActual())->cerrarSession())) return FALSE;
        $URL = constant("URL");
        header ("Location: {$URL}");
    }

    public static function esAdmin(session $unaSesion):bool
    {
        $respuesta = false;
        foreach ($unaSesion->obtenerDatosSession('listaroles') as $idrol => $descripcion){
            if ($descripcion == "administrador"){$respuesta = true;}
        }
        return $respuesta;
    }

    public function iniciarVariableSession()
    {
        $this->sesion = new session();

        $json = $this->getJSONFileconfig();

        $this->sites = $json['Sites'];
        $this->default_sites = $json['Default Site'];

        $this->ValidarSession();
        
    }

    private function getJSONFileconfig(){
        $str = file_get_contents($GLOBALS['ROOT']."Utilitarios/access.json");        

        $json = json_decode($str,true);        

        return $json;
    }

    public function ValidarSession(){
        try{$rol = $this->sesion->obtenerDatosSession('listaroles');}
            catch (Exception $e){return false;} 

        if ($this->existeSession()){            
            if ($this->esPublica()){
                $this->redirigirPagxDefecto($rol);
            } else {
                if (!$this->estaAutorizado($rol)){
                    $this->autorizarAccesso($rol);
                }
            }
        } else {
            // No existe la session;
            if (!$this->esPublica()){  
                if ($this->estaAutorizado($rol)){
                    $this->autorizarAccesso($rol);
                } else {            
                header ("Location: ../Indices/".constant('URL')."");
            } 
            } 
        }
    }

    public function existeSession(){
        if(!$this->sesion->sessionActiva()) return false;
        try { return $this->sesion->obtenerDatosSession ('usuario'); }
        catch (Exception $e){ return false; }        
    }

    function esPublica(){
        $urlactual = $this->paginaActual();
        for ($i = 0; $i < sizeof($this->sites); $i ++){
            if ($urlactual == $this->sites[$i]['site'] &&
            $this->sites[$i]['access'] == 'public') 
            return true;
        }
        return false;
    }

    public static function paginaActual(){
        $linkactual = trim ("$_SERVER[REQUEST_URI]");
        $url = explode("/",$linkactual);
        return $url[count($url)-1];
    }

    public function redirigirPagxDefecto($rol){
        $url = '';
        for ($i = 0; $i < sizeof($this->sites); $i++){
            if ($this->sites[$i]['role'] == $rol){
                $url = $GLOBALS['ROOT'].$this->sites[$i]['site'];
            break;
            }
        }
        header("Location: ".$url);        
    }

    private function estaAutorizado($rol){
        $urlactual = $this->paginaActual();
        for ($i = 0; $i < sizeof($this->sites); $i ++){
            if ($urlactual == $this->sites[$i]['site'] &&
            $this->sites[$i]['role'] == $rol) 
            return true;
        }
        return false;
    }

    public function autorizarAccesso($rol){
        //echo $rol;
        print_r($this->default_sites[$rol]);
        //verEstructura ($this->default_sites[$rol]);
        header("Location: ".$this->default_sites[$rol]."");
    }

}

