<?php
$title = "Login";
$cardtitle = "Login";
include_once("../../Vistas/Basicframe/header.php");
?>

<form action="#" method="post" onsubmit="generarHashPassword()">

<div class="row">
    <div class="col-md-4" style="margin:25px">
    <div class="row"> <label class="control-label" for="archivo"><strong>Usuario</strong></label></div>
    <div class="row"> <input type="text" name="usuarioLogin" id="usuarioLogin" required></div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>  
<div class="row">
    
    <div class="col-md-4" style="margin:25px">
    <div class="row">
    <label class="control-label" for="archivo"><strong>Contraseña</strong></label></div>
    <div class="row">    
    <input type="password" name="passwordLogin" id="passwordLogin" required>   </div> 
    </div>
    <div class="col-md-4"><div><span id="passstrength"></span></div></div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    
    <div class="col-md-4" style="margin:25px">
    <div class="row"> <br> </div>
    <div class="row"> <button class="btn btn-info" type="submit" formmethod='post' formaction='../Acciones/accionLogin.php'>Enviar</button></form>
    <button class="btn btn-info" name="registrarse" id="registrarse"><a class="text-decoration-none" href="registro.php">REGISTRATE</a> </button></div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>  

<script src="./Scripts/passwordstrength.js"></script>

<?php
include_once("../../Vistas/Basicframe/footer.php");
?>