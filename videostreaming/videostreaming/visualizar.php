<?php
require_once("clases/Video.class.php");
require_once("Pantalla.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

if (!isset($_POST['codigo'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
} 

$codigoVideo = trim(strip_tags($_POST['codigo']));

//Deserealiza los videos que puede ver el usuario
$videos = unserialize(urldecode($_SESSION['videos']));

//Recoge el objeto que tiene como clave el codigo del video
$videoElegido = $videos[$codigoVideo];

//Guarda en una variable de sesion la ruta del video que se va a ver
$_SESSION['rutaVideo'] = $videoElegido->video;

/*CONFIGURACION PANTALLA SMARTY QUE REPRODUCE EL VIDEO*/
//Crea la pantalla inicial
$pantalla = new Pantalla();

//Le pasa los parametros
$parametros = array('scriptstreaming'=>'reproductor.php');

//Muestra la pantalla inicial
$pantalla -> mostrar("visualizar.tpl", $parametros);
?>