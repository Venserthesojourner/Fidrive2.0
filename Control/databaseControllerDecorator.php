<?php

abstract class databaseControllerDecorator implements interfaceDataBaseController
{
    protected $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function listarColeccion($obj, $condiciones)
    {
        return ($this->controller)->listarColeccion($obj, $condiciones);
    }
    public function buscarElemento($obj, $where)
    {
        return ($this->controller)->buscarElemento($obj, $where);
    }
    public function insertarElemento($obj)
    {
        return ($this->controller)->insertarElemento($obj);
    }
    public function actualizarElemento($obj, $parametros)
    {
        return ($this->controller)->actualizarDB($obj, $parametros);
    }
    public function eliminarElemento()
    {
        // SIN IMPLEMENTACION
    }
}
