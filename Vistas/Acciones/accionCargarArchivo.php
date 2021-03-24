<?php
$cardtitle = "Exito";
include_once('../../Vistas/Basicframe/header.php');

(new databaseController)->altaArchivo($datos);

subirarchivo($datos);
