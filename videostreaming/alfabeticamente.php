<?php
//Es la clase que se encarga de presentar los videos de cada usuario
include("../../seguridad/videostreaming-s/inicioPagina.php");
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("Pantalla.class.php");

//Obtiene el objeto usuario
$usuario = unserialize($_SESSION['usuario']);

//Obtiene un array de los videos que tiene el usuario
$videos = Videosbd::getVideosAlfabeticamente($usuario->codigosPerfiles);

//Crea y muestra la pantalla con los parametros
$pantalla = new Pantalla();

$parametros = array("videos"=>$videos);

$videosCategoria = Videosbd::getVideosTematica($usuario->codigosPerfiles);
var_dump($videosCategoria);

$pantalla->mostrar("alfabeticamente.tpl", $parametros);

?>