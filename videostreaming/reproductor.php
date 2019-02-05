<?php
require_once("../../seguridad/videostreaming-s/VideoStream.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");

Funciones::inicioSesion();

$ruta = $_SESSION['ruta'];

$stream = new VideoStream($ruta);
$stream->start();
?>