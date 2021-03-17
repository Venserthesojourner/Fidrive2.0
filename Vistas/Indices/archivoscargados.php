<?php
$title = "Carpeta Personal";
$cardtitle = "<div class='row'>
<div class='col-md-3'>Carpeta Personal</div>
<div class='col-md-4'>
<form action='#' method='get'>
<button class='btn btn-secondary' style='margin-left: auto' type='submit' formmethod='post' formaction='amarchivo.php?idarchivocargado=0'>Agregar Archivo</button>
</form>
</div>
<div class='col-md-5' style='display: flex;'>
<form action='#' method='get'>
<button class='btn btn-warning' style='margin-left: auto' type='submit' formmethod='post' formaction='archivoscargados.php'>Todos</button>
<button class='btn btn-success' style='margin-left: auto' type='submit' formmethod='post' formaction='archivoscargados.php?shared=compartido'>Compartido</button>
<button class='btn btn-danger' style='margin-left: auto' type='submit' formmethod='post' formaction='archivoscargados.php?shared=nocompartido'>No Compartido</button>
</form>
</div></div>";


include_once ('../../Vistas/Basicframe/header.php');

/*** MENU DE ADMINISTRADOR ***/
/* if ($sesion->existeSession() && controlSession::esAdmin($sesion->sesionActual())){
echo "
<div class='row','>
<div class='card-header bg-info' style='border: 1px solid'>
    Opciones de Administrador
</div>
<div class='col-md-3'></div>
<div class='col-md-6'>
<button class='btn btn-success'>Administrar Usuarios</button>
<button class='btn btn-warning'>Administrar Roles</button>
<button class='btn btn-danger'>Administrar Contenido</button></div>
<div class='col-md-3'></div>
</div>
";
} */


$condicion = "todos";
if (isset($_GET['shared'])){
    $condicion = $_GET['shared'];
}
$dbcac = new decoArchivoCargadoController(new databaseController());
$datos = $dbcac->listarColeccion(new archivocargado(),"");


function muestraArchivos($condicion, $datos)
{
    //Aca deberia encontrar la condicion piolonga usando el fechaini-fechafin
    $frame = "";
    foreach ($datos as $archivo) {
        $nombre = $archivo->getACnombre();
        $desc = (array)json_decode($archivo->getACdesc());
        $desc = $desc["descripicion"];
        $condList = $archivo->getIDarchcargado();
        $dbcace = new decoArchivoCargadoEstadoController(new databaseController());
        $estados = $dbcace->listarColeccion(new archivocargadoEstado(),["idarchivocargado"=>$condList]);
        //$shared = ;
        
        if ($condicion == "todos") {
            if (estaCompartido($estados)) {
                $mark = "btn btn-success' disabled>Compartido";
                $frame .= "<form action='#' method='post'><div class='row' style='padding:15px; border: solid 1px black'>
            <div class='col-md-3'><button class='{$mark}</button><button class='btn btn-outline-secondary' disabled>{$nombre}</button></div>
            <div class='col-md-5'><p>{$desc}</p></div>
            <div class='col-md-4' style='height:100px;'>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='amarchivo.php?op=1&id={$condList}'>Modificar</button>                
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivocompartido.php'>Dejar de compartir</a></button>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivo.php?'>Eliminar</a></button></form></div></div>";
            } else {
                $mark = "btn btn-danger' disabled>No Compartido";
                $frame .= "<form action='#' method='post'><div class='row' style='padding:15px; border: solid 1px black'>
            <div class='col-md-3'><button class='{$mark}</button><button class='btn btn-outline-secondary' disabled>{$nombre}</button>
            </div>
            <div class='col-md-5'><p>{$desc}</p></div>
            <div class='col-md-4' style='height:100px;'>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='amarchivo.php?op=1&id={$condList}'>Modificar</button>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='compartirarchivo.php'>Compartir</a></button>            
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivo.php?'>Eliminar</a></button></form></div></div>";
            }
        } else if ($condicion == "compartido"){
            
            
                

        } else {

        }
    }

    return $frame;
}

function estaCompartido($arreglo){
    $rta = false;
    foreach ($arreglo as $ar){
        if ($ar->getEstadoTipos()->getIdEstado() == 2){
            $rta = true;
        }
    }
    return $rta;
}

echo muestraArchivos($condicion, $datos);

include_once ('../../Vistas/Basicframe/footer.php');

?>

