<?php
require_once("../../seguridad/videostreaming-s/VideoStream.class.php");
require_once("../../seguridad/videostreaming-s/Cripto.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

/*Recoge la cadena que le llega con valor n y la desencripta*/
if (!isset($_GET['n'])) {
    header("index.php");
    exit;
}

$encr_link = $_GET['n'];
$cripto = new Cripto();
$link = $cripto->desencripta($encr_link);

/*Recoge el link de referencia de la variable de sesion y lo compara*/
$refLink = $_SESSION['refLink'];

if (strcmp($link, $refLink) !== 0) {
    $mensaje = "Las credenciales son incorrectas";
    header("Location: index.php?mensaje=".urlencode($mensaje));
    exit;
} 

//Recoge la ruta del video que se esta reproduciendo
$rutaVideo = $_SESSION['rutaVideo'];

$stream = new VideoStream($rutaVideo);
$stream->start();
?>