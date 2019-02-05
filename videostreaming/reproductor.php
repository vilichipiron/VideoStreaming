<?php
require_once("../../seguridad/videostreaming-s/VideoStream.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

//Recoge la ruta del video que se esta reproduciendo
$rutaVideo = $_SESSION['rutaVideo'];

$stream = new VideoStream($rutaVideo);
$stream->start();
?>