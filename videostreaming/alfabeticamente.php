<?php
//Es la clase que se encarga de presentar los videos de cada usuario ordenados alfabeticamente
include("../../seguridad/videostreaming-s/inicioPagina.php");
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("Pantalla.class.php");

//Obtiene el objeto usuario
$usuario = unserialize($_SESSION['usuario']);

//Obtiene un array de los videos que tiene el usuario
$videosAlfabeticamente = Videosbd::getVideosAlfabeticamente($usuario->codigosPerfiles);

//Crea y muestra la pantalla con los parametros
$pantalla = new Pantalla();

$parametros = array("nombre"=>$usuario->nombre, "videos"=>$videosAlfabeticamente);

$pantalla->mostrar("alfabeticamente.tpl", $parametros);

?>