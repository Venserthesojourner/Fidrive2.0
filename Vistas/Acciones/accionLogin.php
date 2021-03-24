<?php
$title = "Error Autenticacion";
$cardtitle = "Error Autenticacion";
include_once('../Basicframe/header.php');

if (session::sessionActiva()) Header("Location: ../Indices/archivoscargados.php");

?>

<form action="../Indices/login.php" method="post">
    <button> Volver</button>
</form>