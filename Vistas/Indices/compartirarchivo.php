<?php
$title = "COMPARTIR ARCHIVOS";
$cardtitle = "Compartir Archivo";
$tagname = isset($datos['url'])?$datos['url']:"";
$tagurl = isset($datos['msg'])?$datos['msg']:"";
$taghash = "HASH PLACEHOLDER";
include_once ('../../Vistas/Basicframe/header.php');
?>

<form action="exito.php" method="post" class="needs-validation" data-toggle="validator">
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
<div class="row">
<div class="col col-md-2 ">
        
</div>
<div class="col col-md-3 ">
    <button class="btn btn-outline-secondary" disabled="disabled">Dias Compartibles</button>    
</div>
<div class="col col-md-6 ">
<input type="number" name="expiration" id="expiration" value="0"><br>
<small><i>
(Si queda vació quiere decir que no expira)
</i></small>
</div>
</div>


<div class="row">
<div class="col col-md-2 ">
        
</div>
<div class="col col-md-3 ">
    <button class="btn btn-outline-secondary" disabled="disabled">Descargas Disponibles</button>    
</div>
<div class="col col-md-6 ">
<input type="number" name="numerito" id="numerito" value="0"><br>
<small><i>(Si queda vació quiere decir que no hay limites)</i> </small>
</div>
</div>

<div class="row">
<div class="col col-md-2 ">
        
</div>
<div class="col col-md-3 ">
    <button class="btn btn-outline-secondary" disabled="disabled">Cargado Por</button>    
</div>
<div class="col col-md-6 ">
<div class="form-group" style="border-radius:5px; margin:5px">    
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

<div class="row">
<div class="col col-md-2 ">
        
</div>
<div class="col col-md-3 ">
    <button class="btn btn-outline-secondary" disabled="disabled">Protegido</button>    
</div>
<div class="col col-md-6 ">
<input type="checkbox" name="protege" id="protege">
<small><i>(Marcar si el archivo debe ser protegido con contraseña)</i></small>
</div>
</div>

<div class="row">
<div class="col col-md-2 ">
        
</div>
<div class="col col-md-3 ">
    <button class="btn btn-outline-secondary" disabled="disabled">Contraseña</button>    
</div>
<div class="col col-md-6 ">
<input type="password" name="password" id="password">
<div><span id="passstrength"></span></div>

</div>
</div>
<div class="row">
<div class="col col-md-9">
<ul class="pagination" style="border-radius: 5px;">
<li class="page-item"><button class="btn btn-secondary" disabled="disabled">URL:</button></li>
<li class="page-item"><button class="btn btn-outline-secondary" id="URL" value="<?php echo $tagurl ?>"><?php echo $tagurl ?></button></li>

</div></div>



<div class="col col-md-3 ">
    <input class="btn btn-lg btn-outline-secondary" type="reset" value="Borrar">
    <input class="btn btn-lg btn-outline-secondary" type="submit" value="Enviar">
</div>
</div>

</div>
</form>

</ul>
<ul class="pagination" style="border-radius: 5px;">
<li class="page-item"><button class="btn btn-secondary" onclick="generarHash()">Generar Hash</button></li>
<li class="page-item"><button class="btn btn-outline-secondary" id="link" value="<?php echo $tagurl ?>"><?php echo $taghash ?></button></li>
</ul>



<?php
include_once ('../../Vistas/Basicframe/footer.php');
?>