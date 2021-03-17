<?php
class controlDatos {
    private array $datos;
    public function __construct(){
        $this->datos = array();
    }

    public function getDatos(){
        return $this->datos;
    }
    
    public function setearArregloDatos($arregloDatos){
        foreach($arregloDatos as $clave => $dato){
            $this->añadirTupla($clave,$dato);
        }
    }

    public function añadirTupla($clave,$dato){
        $arregloDatos = $this->datos;
        $arregloDatos[$clave] = $dato;
        $this->datos = $arregloDatos;
    }

    public function removerTupla($clave){
        $arregloDatos = $this->datos;
        if ($arregloDatos->existeClave($clave)){
            $arregloDatos = array_diff($arregloDatos, $arregloDatos[$clave]);
        }
        $this->datos = $arregloDatos;
    }
    
    public function actualizarDato($clave, $dato){
        $arregloDatos = $this->datos;
        if ($arregloDatos->existeClave($clave)){
            $arregloDatos[$clave] = $dato;
        }
        $this->datos = $arregloDatos;
    }

    public function existeClave($clave){
        return isset(($this->datos)[$clave]);
    }
 }
 ?>