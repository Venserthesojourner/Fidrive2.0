<?php
$title = "Login";
$cardtitle = "Login";
include_once("../../Vistas/Basicframe/header.php");

$desc = json_encode($_POST);
$userID = 21549513684;
$archivoID = 12025581112;
$directorio = "../../Vistas/FILE$/";
opendir($directorio);

if (!file_exists($userID)) {
    mkdir("{$directorio}{$userID}/{$archivoID}/", 0777, true);
}

file_put_contents("{$directorio}{$userID}/{$archivoID}/{$archivoID}desc.json", $desc);

// Leemos la informacion del JSON y lo agregamos al editor de texto enriquecido para que pueda ser modificado
$str = file_get_contents("{$directorio}{$userID}/{$archivoID}/{$archivoID}desc.json");
$json = json_decode($str, true);
?>

<div style="border:solid 1 px black">
    <?php
    // Aca lo que necesito es calcular el tamaño del folder del usuario y en funcion de su rol 
    // determinar la cantidad de espacio disponible al que tiene acceso

    echo disk_free_space($GLOBALS['ROOT'] . "Vistas/FILE$/{$userID}/") / 1024 / 1024 / 1024;
    ?>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short>
<?php echo $json["editor1"]; ?>
</textarea>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
</script>


<?php
include_once("../../Vistas/Basicframe/footer.php");
?>