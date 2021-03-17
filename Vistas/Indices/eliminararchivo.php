<?php
$title = "ELIMINAR ARCHIVOS";
$cardtitle = "Eliminar Archivo";
$tagname = "1234.png";
$choclodetexto = "";
include_once ('../Vistas/Basicframe/header.php');
?>

<form action="exito.php" method="post">
<div class="container" style="padding:5px">
<style>
.row{
    padding: 15px;
}
</style>
<ul class="pagination" style="border-radius: 5px;">
<li class="page-item"><button class="btn btn-secondary" disabled="disabled">Nombre del Archivo:</button></li>
<li class="page-item"><button class="btn btn-outline-secondary" disabled="disabled"><?php echo $tagname ?></button></li>
</ul>

Motivo
<div class="form-group">   
    <textarea name="reas" id="reas" cols="100" rows="10"><?php echo $choclodetexto;?></textarea>
</div>

<div class="col-md-3">
<button class="btn btn-outline-secondary" disabled="disabled">Cargado Por</button>  

<label class="control-label" for="usuario"><strong>Usuario</strong></label>
<select name="usuario" id="usuario" required>

<?php 
$listado = controlDB::obtenerlistaUsuarios();
echo userselector($listado);
?>
</select>
</div>
</div>


</div>

<input class="btn btn-lg btn-outline-secondary" type="reset" value="Borrar">
<input class="btn btn-lg btn-outline-secondary" type="submit" value="Enviar">
</form>

<?php
include_once ('../Vistas/Basicframe/footer.php');
?>