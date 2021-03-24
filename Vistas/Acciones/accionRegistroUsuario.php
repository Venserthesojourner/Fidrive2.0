<?php
$title = "Login";
$cardtitle = "Login";
include_once("../../Vistas/Basicframe/header.php");


$username = $datos["uslogin"];
if (!(new controlLogin)->encuentraUsuario($username)) {
    $conexion->altaUsuario($datos);
}



include_once("../../Vistas/Basicframe/footer.php");
