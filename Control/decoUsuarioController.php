<?php

class decoUsuarioController extends databaseControllerDecorator{

    public function listarColeccion($obj, $condiciones){
        $condicion = " true";
        $ararch = (array) json_decode(file_get_contents($GLOBALS['ROOT']."Utilitarios/tablasDB.json"));
        $ararch2 = (array) $ararch["usuario"];
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

    public function actualizarElemento($obj,$parametros){
        $condicion = "";
        $ararch = (array) json_decode(file_get_contents($GLOBALS['ROOT']."Utilitarios/tablasDB.json"));
        $ararch2 = (array) $ararch["usuario"];
        if(is_array($parametros) && !empty($parametros)){
            foreach ($ararch2 as $key => $value){
                if (array_key_exists($key,$parametros)){
                    $condicion .= " {$key} = '{$parametros[$key]}' ,";
                }
            }
        }  

        $obj = usuario::U_construct($obj);            
        return ($this->controller)->actualizarElemento($obj,substr($condicion, 0, -1));
    }

    public function insertarElemento($obj)    {                         
        $ac = usuario::U_construct($obj);
        $rta = ($this->controller)->insertarElemento($ac);                
        $obj['idusuario']=$ac->getIduser();
        return $obj;
    }
}