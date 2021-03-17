<?php
$title = "Registro Exitoso";
$cardtitle = "Registro Exitoso";
include_once("../../Vistas/Basicframe/header.php");

$dbc = new databaseController();


echo "Se realizo el registro con exito";
?>


<form action="../Indices/login.php" method="post">
<button> Volver</button>
</form>