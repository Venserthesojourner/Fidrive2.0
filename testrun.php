<?php
$GLOBALS['ROOT'] =$_SERVER['DOCUMENT_ROOT'] ."/Fidrive2.0/";

spl_autoload_register(function ($clase) {
	//echo "Cargamos la clase  " . $clase . "<br>";
	$directorys = array(
		$GLOBALS['ROOT'] . 'Modelo/',
		$GLOBALS['ROOT'] . 'Control/',
/* 		$GLOBALS['ROOT'] . 'Utilitarios/',
		$GLOBALS['ROOT'] . 'Vistas/', */
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

$dbc = new databaseController();
/* $dbcus = new decoUsuarioController($dbc);

 $datosus = ["usnombre"=> "Ujas",
	"usapellido"=> "HOLE",
	"uslogin"=> "GenerineW",
	"usclave"=> "Ujiks"];

$objus = $dbcus->insertarElemento($datosus);

print_r($objus);

$objusac = $dbcus->actualizarElemento($objus,["usapellido"=> "Otro",
"uslogin"=> "NewGeneric2",]);

print_r($objusac); */

$dbdmc = new decoDinamicMenuContent($dbc);

?>


