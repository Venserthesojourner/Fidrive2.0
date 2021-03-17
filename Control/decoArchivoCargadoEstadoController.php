<?php

class decoArchivoCargadoEstadoController extends databaseControllerDecorator{

    public function listarColeccion($obj, $condiciones){
        $condicion = " true";
        $ararch = (array) json_decode(file_get_contents($GLOBALS['ROOT']."Utilitarios/tablasDB.json"));
        $ararch2 = (array) $ararch["archivocargadoestado"];
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

        if (array_key_exists("idarchivocargado",$obj)){
            
            $ace = archivocargadoestado::ace_construct($obj);
            $rta = ($this->controller)->insertarElemento($ace);
            $obj['idarchivocargadoestado']=$ace->getArchivoCargadoestado(); 
            $obj['acefechaingreso']=$ace->getAcefechaingreso(); 
        }

        return $obj;
        
    }

}