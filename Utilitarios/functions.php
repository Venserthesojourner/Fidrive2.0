<?php

/* function data_submitted()
{
	$_AAux = array();
	if (!empty($_POST))
	$_AAux = $_POST;
	else {
		if (!empty($_GET)) {
			$_AAux = $_GET;
		} else {
			if (!empty($_FILES)) {
				$_AAux = $_FILES;
			}
		}
	}
	if (count($_AAux)) {
		foreach ($_AAux as $indice => $valor) {
			if ($valor != "")
				$_AAux[$indice] = $valor;
		}
	}
	return $_AAux;
} */

function data_submitted()
{
	$_AAux = array();
	$_AAux2 = array();
	if (!empty($_POST))
	array_push($_AAux,$_POST);
	if (!empty($_GET))
	array_push($_AAux,$_GET);
	if (!empty($_FILES))
	array_push($_AAux,$_FILES);
	if (count($_AAux)) {
		foreach ($_AAux as $indice => $valor) {
			foreach ($valor as $indiceb => $valorb){
				if ($valor != "")
				$_AAux2[$indiceb] = $valorb;
			}
		}
	}
	return $_AAux2;
}


spl_autoload_register(function ($clase) {
	//echo "Cargamos la clase  " . $clase . "<br>";
	$directorys = array(
		$GLOBALS['ROOT'] . 'Modelo/',
		$GLOBALS['ROOT'] . 'Control/',
		$GLOBALS['ROOT'] . 'Utilitarios/',
		$GLOBALS['ROOT'] . 'Vistas/',
	);
	//print_r($directorys);
	foreach ($directorys as $directory) {
		if (file_exists($directory . $clase . '.php')) {
			// echo "se incluyo".$directory.$class_name . '.php';
			require_once($directory . $clase . '.php');
			return;
		}
	}
});

function hiddenData($action)
{
	if (isset($_POST["IDarchivo"])) {
		$action = $_POST["IDarchivo"];
		return $action;
	} else {
		$action = 0;
		return $action;
	}
}

function verEstructura($e)
{
	echo "<pre>";
	print_r($e);
	echo "</pre>";
}

function userselector($listado)
{
	$block = "";
	foreach ($listado as $user) {
		$valor = $user->getIduser();
		$tag = $user->getUname();
		$block .= "<option value='{$valor}'>{$tag}</option>";
	}
	return $block;
}

function obtenerArchivos($folder)
{
	$directorio = "{$folder}";

	$archivos = [];
	$archivos = array_diff(scandir($directorio, SCANDIR_SORT_NONE), array('..', '.'));
	$files = [];
	$folders = [];
	foreach ($archivos as $archivo) {

		if (strpos($archivo, ".") === false) {
			array_push($folders, $archivo);
		} else {
			array_push($files, $archivo);
		}
	}
	$archivos = array_merge($folders, $files);

	return $archivos;
}

function crearDirectorio()
{
	$base = $datos['name'];
	$folder = $datos['foldername'];
	mkdir("{$base}/{$folder}", 0777, true);
	//header('Location: main.php');
}

function subirArchivo($datos)
{
	
	//Seleccionamos la carpeta

	$carpeta = "";
	$opcion = $datos['icono'];

	//echo $opcion."<br>";

	switch($opcion){
		case "pdf":
			$carpeta = "documentos.pdf";
			break;
		case "zip":
			$carpeta = "documentos.zip";
			break;
		case ("doc" || "docx"):
			$carpeta = "documentos.doc";
			break;
		case ("xls" || "xlsx"):
			$carpeta = "documentos.xls";
			break;
		default:
			$carpeta = "documentos.img";
			break;
	}
	// Generamos el target_dir y el $target_file

	//echo $carpeta."<br>";

	$target_dir = $GLOBALS["ROOT"]."Vistas/FILE$/".$carpeta;
	
	$target_file = $target_dir . '/' . $datos['name'].".".$opcion;
	//echo $target_file;

	move_uploaded_file($datos['archive']['tmp_name'],$target_file);
}
