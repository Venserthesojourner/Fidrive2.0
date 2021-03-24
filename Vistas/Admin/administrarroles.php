<?php

include_once('../../Vistas/Basicframe/header.php');

$listausuarios = ((new decoUsuarioController($control))->listarColeccion(new usuario, ""));

verEstructura($listausuarios);
