$(document).ready(function() {

    /* HABILITAR O DESHABILITAR CLAVE */
    // Le doy a la variable el valor del checkbox
    var determine = document.getElementById("protege");
    // Según el valor del checkbox me va a habilitar o deshabilitar el input para poner la clave
    var disableCheckboxConditioned = function() {
            if (determine.checked) {
                document.getElementById("pass").disabled = false;
            } else {
                document.getElementById("pass").disabled = true;
            }
        }
        // Activar la funcion con un click
    determine.onclick = disableCheckboxConditioned;
    disableCheckboxConditioned();



}); // Ready

/* NOMBRE Y TIPO DE ARCHIVO */
function laFunction() {
    var x = document.getElementById("archive");
    //Colocamos el nombre del archivo
    document.getElementById("name").value = x.files[0].name;

    //Seleccionamos el tipo de archivo
    var nombreArchivo = x.files[0].name;
    //alert(nombreArchivo);
    var extension = getFileExtension(nombreArchivo);
    //alert(extension);
    checkTipoArchivo(extension);
}

/* OBTENEMOS TIPO ARCHIVO */
function getFileExtension(filename) {
    var ext = filename.split('.').pop();
    return ext;
}

/* ACTIVAMOS EL TIPO DE ARCHIVO */
function checkTipoArchivo(extension) {
    if (extension == "jpg" || extension == "png" || extension == "gif" || extension == "tiff" || extension == "jpeg" || extension == "bmp" || extension == "webp") {
        $("#img").prop("checked", true);
        $("#zip").prop("checked", false);
        $("#pdf").prop("checked", false);
        $("#doc").prop("checked", false);
        $("#xls").prop("checked", false);
    } else if (extension == "zip" || extension == "rar" || extension == "bin" || extension == "gz" || extension == "tar") {
        $("#img").prop("checked", false);
        $("#zip").prop("checked", true);
        $("#pdf").prop("checked", false);
        $("#doc").prop("checked", false);
        $("#xls").prop("checked", false);
    } else if (extension == "docx" || extension == "doc" || extension == "odt" || extension == "txt" || extension == "rtf" || extension == "dot" || extension == "dotm") {
        $("#img").prop("checked", false);
        $("#zip").prop("checked", false);
        $("#pdf").prop("checked", false);
        $("#doc").prop("checked", true);
        $("#xls").prop("checked", false);
    } else if (extension == "pdf") {
        $("#img").prop("checked", false);
        $("#zip").prop("checked", false);
        $("#pdf").prop("checked", true);
        $("#doc").prop("checked", false);
        $("#xls").prop("checked", false);
    } else if (extension == "xls" || extension == "xlsx" || extension == "xlsm" || extension == "xltx" || extension == "xlt" || extension == "ods") {
        $("#img").prop("checked", false);
        $("#zip").prop("checked", false);
        $("#pdf").prop("checked", false);
        $("#doc").prop("checked", false);
        $("#xls").prop("checked", true);
    }
}

/* GENERAR HASH */
function generarHash() {
    var hash;
    var cadena = "";
    var nombre = document.getElementById("URL").value;
    var dias = document.getElementById("expiration").value;
    var descargas = document.getElementById("numerito").value;

    if (dias == 0 && descargas == 0) {
        hash = "9007199254740991";
    } else {
        cadena = dias + descargas + nombre;
        hash = CryptoJS.MD5(cadena);
    }

    document.getElementById("link").value = hash;
    document.getElementById("link").innerHTML = hash;
}

// Desconvertir Hash

function generarHashINV() {
    var reversehash, cadena;
    cadena = document.getElementById("link").value;
    reversehash = CryptoJS.enc.Hex.parse(cadena);
    document.getElementById("link2").value = reversehash;
    document.getElementById("link2").innerHTML = reversehash;
}

function generarHashPassword() {
    cadena = document.getElementById("passwordLogin").value;
    hash = CryptoJS.MD5(cadena);
    document.getElementById("passwordLogin").value = hash;
}