<?php

class decoEstadoTiposController extends databaseControllerDecorator{
    
    public function listarColeccion($obj, $condiciones){
        $condicion = " true";
        $ararch = (array) json_decode(file_get_contents("tablasDB.json"));
        $ararch2 = (array) $ararch["estadotipos"];
        if(is_array($condiciones) && !empty($condiciones)){
            foreach ($ararch2 as $key => $value){
                if (array_key_exists($key,$condiciones)){
                    $condicion .= " AND {$key} = {$condiciones[$key]}";
                }
            }
        }
        
        
        return ($this->controller)->listarColeccion($obj,$condicion);

    }

    public function insertarElemento($obj)
    {
        $ac = estadotipos::AC_construct($obj);
        $this->controller->insertarElemento($ac);
    }

}