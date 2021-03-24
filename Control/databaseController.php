<?php
class databaseController implements interfaceDataBaseController
{
    /**
     * @param: $obj (objeto de la capa del modelo)
     * @param: $condiciones (arreglo asociativo: clave => valor)
     * @return: array;
     */
    public function listarColeccion($obj, $condiciones)
    {
        return $obj->listarDB($condiciones);
    }
    /**
     * @param: $obj de la capa de modelo
     * @param: $where arreglo asociativo con los datos requeridos por la funcion buscarDB
     * @return: objeto de la capa de modelo
     */
    public function buscarElemento($obj, $where)
    {
        return $obj->buscarDB($where);
    }
    /**
     * @param: objeto de la capa del modelo a ser insertado
     * @return: booleano - exito o fracaso de la insercion
     */
    public function insertarElemento($obj)
    {
        return $obj->insertDB();
    }
    /**
     * @param: objeto de la capa de modelo
     * @param: arreglo de campos a ser actulizados
     * @return: numero de filas afectadas
     */
    public function actualizarElemento($obj, $parametros)
    {
        return $obj->actualizarDB($parametros);
        // actualizarDB retorna la cantidad de finlas afectas osea un int
    }
    public function eliminarElemento()
    {
        // No se utiliza
    }

    public function altaArchivo($ararch)
    {

        $dbcac = new decoArchivoCargadoController($this);

        $dbcace = new decoArchivoCargadoEstadoController($this);

        $ararch = $dbcac->insertarElemento($ararch);

        $ararch = $dbcace->insertarElemento($ararch);

        return archivocargado::AC_construct($ararch);
    }

    public function altausuario($datos)
    {
        $dbcus = new decoUsuarioController($this);
        $objus = $dbcus->insertarElemento($datos);
    }

    public function actualizarEstado($ararch)
    {

        $arreglo = archivocargadoestado::listarDB("idarchivocargado = {$ararch['idarchivocargado']}");

        foreach ($arreglo as $ar) {
            if ($ar->getAcefechafin() == null && $ararch["idestadotipos"] != $ar->getEstadoTipos()->getIdEstado()) {
                $parametro = ["acefechafin" => "CURRENT_TIMESTAMP"];
                $ar->actualizardDB($parametro);

                $dbcace = new decoArchivoCargadoEstadoController($this);
                $ararch['idusuario'] = $ar->getUsuario()->getIduser();
                $ararch = $dbcace->insertarElemento($ararch);
            }
        }
    }
}
