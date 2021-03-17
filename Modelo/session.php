<?php

class session {
    
    public function __construct(){
        self::sessionActiva() ? FALSE : session_start();       
    }
    
    public static function cargarDatosSession ($sessiondata){
        if (!self::sessionActiva()) return FALSE;
        if (!empty($sessiondata)){
            foreach ($sessiondata as $tag => $data){
                $_SESSION[(string)$tag] = $data;
            }
            return TRUE;
        }
        return FALSE;
    }
    
    public function obtenerDatosSession($clave){
        if (!self::sessionActiva()) return FALSE;
        if (isset($_SESSION[(string) $clave])) return $_SESSION[ (string) $clave];
        return FALSE;
    }

    public function cerrarSession():bool{
        return self::sessionActiva() ? session_destroy() :  FALSE;
    }
   
    public static function sessionActiva():bool 
    {
        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }  
    
}