<?php

interface interfaceDataBaseController
{
    public function listarColeccion($obj, $condiciones);
    public function buscarElemento($obj, $where);
    public function insertarElemento($obj);
    public function actualizarElemento($obj, $parametros);
    public function eliminarElemento(); //No se usa, por que se aplica borrado logico.
}
