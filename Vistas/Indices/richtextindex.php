<?php
$title = "Login";
$cardtitle = "Login";
include_once("../../Vistas/Basicframe/header.php");
?>
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<form action="../Acciones/richtextaccion.php" method="post">
    <textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short>
&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. 
You are using &lt;a href=&quot;https://ckeditor.com/&quot;&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
</textarea>
    <input type="submit" value="Enviar">
</form>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
</script>

<?php
include_once("../../Vistas/Basicframe/footer.php");
?>