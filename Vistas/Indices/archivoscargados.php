<?php
$title = "Carpeta Personal";
$cardtitle = "<div class='row'>
<div class='col-md-3'>Carpeta Personal</div>
<div class='col-md-4'>
<form action='#' method='post'>
<button class='btn btn-secondary' name='idarchivocargado' style='margin-left: auto' type='submit' value=0 formmethod='post' formaction='amarchivo.php'>Agregar Archivo</button>

</div>
<div class='col-md-5' style='display: flex;'>

<button class='btn btn-warning' name='shared' style='margin-left: auto' type='submit' value=0 formmethod='post' formaction='archivoscargados.php'>Todos</button>
<button class='btn btn-success' name='shared' style='margin-left: auto' type='submit' value=1 formmethod='post' formaction='archivoscargados.php'>Compartido</button>
<button class='btn btn-danger' name='shared' style='margin-left: auto' type='submit' value=2 formmethod='post' formaction='archivoscargados.php'>No Compartido</button>
</form>
</div></div>";

include_once('../../Vistas/Basicframe/header.php');

/*** MENU DE ADMINISTRADOR ***/
if ($_SESSION["listaroles"][0] == "Administrador") {
?>
    <div class='row'>
        <div class='card-header bg-info' style='border: 1px solid'>
            Opciones de Administrador
        </div>
        <div class='col-md-3'></div>

        <div class='col-md-6'>
            <form action="">
                <button class='btn btn-success' type='submit' formmethod='post' formaction="../Admin/administrarusuarios.php">Administrar Usuarios</button>
                <button class='btn btn-warning' type='submit' formmethod='post' formaction="../Admin/administrarroles.php">Administrar Roles</button>
                <button class='btn btn-danger' type='submit' formmethod='post' formaction="../Admin/administrarcontenido.php">Administrar Contenido</button>
            </form>
        </div>

        <div class='col-md-3'></div>
    </div>

<?php }
/*** MENU DE ADMINISTRADOR ***/

$where = 0;
if (!isset($datos['shared'])) $datos['shared'] = 0;
$dbcace = new decoArchivoCargadoEstadoController($conexion);
echo muestraArchivos($datos['shared'], $dbcace);


function muestraArchivos($where, $dbcace)
{

    //Aca deberia encontrar la condicion piolonga usando el fechaini-fechafin
    $frame = "";
    $listaarchivos = array();
    //$dbusu = new ();

    if ($where == 0) {
        $listaarchivos = array_merge(
            $listaarchivos,
            $new = $dbcace->listarColeccion(
                new archivocargadoestado(),
                [""]
            )
        );
    } elseif ($where == 1) {
        $listaarchivos = array_merge(
            $listaarchivos,
            $new = $dbcace->listarColeccion(
                new archivocargadoestado(),
                ["idestadotipos" => 2]
            )
        );
    } elseif ($where == 2) {
        $listaarchivos = array_merge(
            $listaarchivos,
            $new = $dbcace->listarColeccion(
                new archivocargadoestado(),
                ["idestadotipos" => 1]
            )
        );
        $listaarchivos = array_merge(
            $listaarchivos,
            $new = $dbcace->listarColeccion(
                new archivocargadoestado(),
                ["idestadotipos" => 3]
            )
        );
    }



    foreach ($listaarchivos as $archivoce) {

        $archivo = $archivoce->getArchivoCargado();

        $nombre = $archivo->getACnombre();
        $desc = (array)json_decode($archivo->getACdesc());
        $desc = $desc["descripicion"];
        $condList = $archivo->getIDarchcargado();

        $estado = $archivoce->getEstadoTipos()->getIdEstado();

        if ($estado == 1 || $estado == 3) {

            $mark = "btn btn-danger' disabled>No Compartido";
            $frame .= "<form action='#' method='post'><div class='row' style='padding:15px; border: solid 1px black'>
            <div class='col-md-3'><button class='{$mark}</button><button class='btn btn-outline-secondary' disabled>{$nombre}</button>
            </div>
            <div class='col-md-5'><p>{$desc}</p></div>
            <div class='col-md-4' style='height:100px;'>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='amarchivo.php?op=1&id={$condList}'>Modificar</button>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='compartirarchivo.php'>Compartir</a></button>            
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivo.php?'>Eliminar</a></button></form></div></div>";
        } elseif ($estado == 2) {

            $mark = "btn btn-success' disabled>Compartido";
            $frame .= "<form action='#' method='post'><div class='row' style='padding:15px; border: solid 1px black'>
            <div class='col-md-3'><button class='{$mark}</button><button class='btn btn-outline-secondary' disabled>{$nombre}</button></div>
            <div class='col-md-5'><p>{$desc}</p></div>
            <div class='col-md-4' style='height:100px;'>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='amarchivo.php?op=1&id={$condList}'>Modificar</button>                
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivocompartido.php'>Dejar de compartir</a></button>
            <button class='btn btn-outline-secondary' type='submit' style='margin-left: auto; margin-right: 0' formmethod='post' formaction='eliminararchivo.php?'>Eliminar</a></button></form></div></div>";
        }
    }

    return $frame;
}



include_once('../../Vistas/Basicframe/footer.php');
