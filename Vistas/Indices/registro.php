<?php
$title = "Login";
$cardtitle = "Login";
include_once("../../Vistas/Basicframe/header.php");
?>

<form action="../Acciones/accionregistro.php" method="post">
Nombre
<input type="text" name="usnombre" id="usnombre">
Apellido
<input type="text" name="usapellido" id="usapellido">
Usuario
<input type="text" name="uslogin" id="uslogin">
Contraseña
<input type="text" name="usclave" id="usclave">
<button>Completar registro</button>
</form>


<?php
include_once("../../Vistas/Basicframe/footer.php");
?>
