<?php
$cardtitle = "Exito";
include_once ('../../Vistas/Basicframe/header.php');

//verEstructura($datos);

controlDB::cargarObjeto($datos,1);

subirarchivo($datos);

?>
