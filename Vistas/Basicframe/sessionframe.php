<?php
include_once("../../config.php");

date_default_timezone_set ( "America/Argentina/San_Luis" );

/**
 * Cargamos arreglo de datos
 */

$control = new controlDatos();
$control->setearArregloDatos($array = data_submitted());
$datos = $control->getDatos();

/* 
if (isset($datos['usuarioLogin']) && isset($datos['passwordLogin'])) {
    
    $valid = controlLogin::verificarPass($datos['usuarioLogin'], $datos['passwordLogin']);
    if(isset($valid)){
        
        $nombreUs = $datos['usuarioLogin'];
        $datosSession = controlLogin::encuentraUsuario($nombreUs);
        verEstructura($datosSession); 
        $sesion = new session();
        $sesion->cargarDatosSession($datosSession); 
        verEstructura($_SESSION); 
    } else {
        header("location: login.php");
    }

} else {
    if(isset($_SESSION)){
        verEstructura($_SESSION); 
    }

} */



//verEstructura($_SESSION);

/* if(!isset($_SESSION)){
    echo "HOLA IF EXISTE";
    $sesion = new controlSession();
    $nombreUs = $sesion->sesionActual()->obtenerDatosSession('uslogin');
    $datosSession = controlLogin::encuentraUsuario($nombreUs);
    //verEstructura($datosSession);
    
    controlSession::cargarDatosSession($datosSession); 
    $sesion->ValidarSession();  
}else { 
    
    $sesion = new controlSession();
} */
?>


