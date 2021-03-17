<?php
$title = "Crear Carpeta";
$cardtitle = "Crear Carpeta";
$tagname = $_POST['name'];
include_once ('../Vistas/Basicframe/header.php');
$obj = new operacionesControl();

if (isset($_POST['foldername'])){
  $obj->crearDirectorio();
}
?>
<form action="crearcarpeta.php" method="post">
  <input type="hidden" name="name" value="<?php echo $tagname;?>">
  <div class="row">
    <div class="col-md-9"><input type="text" name="foldername" id="foldername" placeholder="Nombre de la carpeta"><input type="submit" value="Crear"></div>
  </div>
</form>
<?php
include_once ('../Vistas/Basicframe/footer.php');
?>