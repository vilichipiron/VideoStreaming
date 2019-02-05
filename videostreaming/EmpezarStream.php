<?php
require_once("Pantalla.class.php");
require_once("../../seguridad/videostreaming-s/VideoStream.class.php");

if (!isset($_POST['ruta'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
} 

$ruta = trim(strip_tags($_POST['ruta']));

//-----Aqui desencriptaria la ruta-----

$stream = new VideoStream($ruta);

$stream->start();

//Crea la pantalla inicial
$pantalla = new Pantalla();

//Le pasa los parametros
$parametros = array('scriptstreaming'=>'EmpezarStream.php');

//Muestra la pantalla inicial
$pantalla -> mostrar("streaming.tpl", $parametros);
?>