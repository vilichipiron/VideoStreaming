<?php
require_once("clases/Video.class.php");
require_once("clases/Usuario.class.php");
require_once("Pantalla.class.php");
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

/*-----GESTION DE VIDEO------*/

if (!isset($_POST['codigo'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
} 

$codigoVideo = trim(strip_tags($_POST['codigo']));

/*-----RECOGE DE LA SESIÓN EL VIDEO QUE SE QUIERE VER-----*/
$videos = unserialize($_SESSION['videos']);

$videoElegido = $videos[$codigoVideo];

    
/*-----GESTION DE USUARIO------*/
$usuario = unserialize($_SESSION['usuario']);

/*-----SI EL USUARIO NO PUEDE VER LA PELICULA, SE SALE------*/
if (!Videosbd::puedeVer($usuario->dni, $codigoVideo)) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
}

/*-----MARCA LA PELICULA VISTA POR EL USUARIO EN LA BBDD Y EN EL ARRAY-----*/
Videosbd::insertVisionada($usuario->dni, $codigoVideo);

$videoElegido->setVistaSi();
$videos[$codigoVideo] = $videoElegido;

$_SESSION['videos'] = serialize($videos);


/*-----GENERA UN LINK ALEATORIO------*/
$link = Funciones::crearLink($codigoVideo);
$link = "streaming.php?n=".urlencode($link);


/*------CONFIGURACION PANTALLA SMARTY QUE REPRODUCE EL VIDEO-----*/

//Crea la pantalla inicial
$pantalla = new Pantalla();

//Le pasa los parametros
$parametros = array('scriptstreaming'=>$link);

//Muestra la pantalla inicial
$pantalla -> mostrar("visualizar.tpl", $parametros);
?>