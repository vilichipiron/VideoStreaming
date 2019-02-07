<?php
require_once("../../seguridad/videostreaming-s/VideoStream.class.php");
require_once("../../seguridad/videostreaming-s/Cripto.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
require_once("clases/Video.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

/*Recoge la cadena que le llega con valor n y la desencripta*/
if (!isset($_GET['n'])) {
    header("index.php");
    exit;
}

$encr_link = strip_tags(trim($_GET['n']));
$cripto = new Cripto();
$datos = json_decode($cripto->desencripta($encr_link));

/*Recoge el link de referencia de la variable de sesion y 
lo que le ha llegado por get y lo compara*/
$claveRandom = $datos->claveRandom;
$refLink = $_SESSION['refLink'];

if (strcmp($claveRandom, $refLink) !== 0) {
    session_destroy();
    unset($_SESSION);
    $mensaje = "--";
    header("Location: index.php?mensaje=".urlencode($mensaje));
    exit;
} 

/*------RECOGE LA RUTA DEL VIDEO QUE SE QUIERE VER------*/
$videos = unserialize($_SESSION['videos']);
$rutaVideo = $videos[$datos->codigoVideo]->video;


$stream = new VideoStream($rutaVideo);
$stream->start();
?>