<?php

$GLOBALS['ROOT'] = $_SERVER['DOCUMENT_ROOT'] . "/Fidrive2.0/";

//echo $GLOBALS['ROOT'];

foreach (glob($GLOBALS['ROOT'] . "Utilitarios/*.php") as $filename) {
    //echo $filename;
    include_once($filename);
}

foreach (glob($GLOBALS['ROOT'] . "Control/*.php") as $filename) {
    //echo $filename;
    include_once($filename);
}

foreach (glob($GLOBALS['ROOT'] . "Modelo/*.php") as $filename) {
    //echo $filename;
    include_once($filename);
}
