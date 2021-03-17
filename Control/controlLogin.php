<?php

class controlLogin
{
    public static function encuentraUsuario($username)
    {
        $where = ["campo"=>"uslogin","parametro" =>"'$username'"];
        $dbcus = new decoUsuarioController (new databaseController());
        $usuario = $dbcus->buscarElemento(new usuario(),$where);
        if ($usuario != null) {
            $datos = ["uslogin" => $usuario->getUlogin(),"usuario" => $usuario->getUname(), "listaroles" => $usuario->getRoles()];
            return $datos;
        } else {
            return false;
        }
    }

    public static function verificarPass($username, $password)
    {
        $where = ["campo"=>"uslogin","parametro" =>"'$username'"];
        $dbcus = new decoUsuarioController (new databaseController());
        $usuario = $dbcus->buscarElemento(new usuario(),$where);
        if ($usuario != null && $usuario->getUpassword() == $password) {
            return true;
        } else {
            return false;
        }
    }
}