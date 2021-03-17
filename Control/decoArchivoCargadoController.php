<?php

class decoArchivoCargadoController extends databaseControllerDecorator{
    
    public function listarColeccion($obj, $condiciones){
        $condicion = " true";
        $ararch = (array) json_decode(file_get_contents($GLOBALS['ROOT']."Utilitarios/tablasDB.json"));
        $ararch2 = (array) $ararch["archivocargado"];
        if(is_array($condiciones) && !empty($condiciones)){
            foreach ($ararch2 as $key => $value){
                if (array_key_exists($key,$condiciones)){
                    $condicion .= " AND {$key} = {$condiciones[$key]}";
                }
            }
        }
        
        
        return ($this->controller)->listarColeccion($obj,$condicion);

    }

    public function buscarElemento($obj,$where){
        return ($this->controller)->buscarElemento($obj,$where);
    }

    public function insertarElemento($obj)    {                         
        $json = json_encode($obj["acdescripcion"]);
        $obj["acdescripcion"] = $json;
        $ac = archivocargado::AC_construct($obj);
        $rta = ($this->controller)->insertarElemento($ac);
                
        $obj['idarchivocargado']=$ac->getIDarchcargado();
        return $obj;
    }

}