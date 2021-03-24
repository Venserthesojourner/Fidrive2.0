<?php
include_once("../../config.php");

date_default_timezone_set("America/Argentina/San_Luis");

/**
 * Cargamos arreglo de datos
 */

$conexion = new databaseController();
$control = new controlDatos();

$control->setearArregloDatos($array = data_submitted());
$datos = $control->getDatos();

$session = new controlSession();

if ($session->esPublica()) {

    $session->inicializarSession();
    $session->cerrarSession();
} else {


    if (!session::sessionActiva()) {

        if (array_key_exists("passwordLogin", $datos) && array_key_exists("usuarioLogin", $datos)) {
            $user = new controlLogin();
            $datosusuario = $user->encuentraUsuario($datos["usuarioLogin"]);

            if ($user->verificarPass($datos["usuarioLogin"], $datos["passwordLogin"])) {
                $session->inicializarSession();
                $session->cargarDatosSession($datosusuario);
            } else {
                header("Location: ../Acciones/accionLogin.php");
            }
        } else {

            $session->inicializarSession();

            if ($session->sesionActual()->obtenerDatosSession("uslogin")) {
            } else {
                header("Location: ../Indices/" . constant('URL') . "");
            }
        }
    }

    $listaroles = $session->sesionActual()->obtenerDatosSession("listaroles");

    if (!($session->estaAutorizado($listaroles)) && ($session->paginaActual() != "archivoscargados.php")) header("Location: ../Indices/archivoscargados.php");
}
