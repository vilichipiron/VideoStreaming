<?php
require_once("clases/Video.class.php");
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
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

//Comprueba si el usuario puede ver dicho video
$usuario = unserialize($_SESSION['usuario']);

if (!Videosbd::puedeVer($usuario->dni, $codigoVideo)) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
}

//Recoge los videos que puede ver el usuario
$videos = Videosbd::getVideosAlfabeticamente($usuario->codigosPerfiles, $usuario->dni);

//Recoge el objeto que tiene como clave el codigo del video
$videoElegido = $videos[$codigoVideo];

/*CONFIGURACION PANTALLA SMARTY*/
//Crea la pantalla inicial
$pantalla = new Pantalla();
//Le pasa los parametros
$parametros = array('video'=>$videoElegido);
//Muestra la pantalla inicial
$pantalla -> mostrar("verInfoPelicula.tpl", $parametros);

?>