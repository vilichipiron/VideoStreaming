<?php
//Es la clase que se encarga de presentar los videos de cada usuario ordenados alfabeticamente
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
require_once("Pantalla.class.php");
include("../../seguridad/videostreaming-s/inicioPagina.php");

//Obtiene el objeto usuario
$usuario = unserialize($_SESSION['usuario']);

//Obtiene un array de los videos que tiene el usuario
$videosAlfabeticamente = Videosbd::getVideosAlfabeticamente($usuario->codigosPerfiles);

//Lo serializa y guarda en una variable de sesion para futuras operaciones
$_SESSION['videos'] = serialize($videosAlfabeticamente);

/*CONFIGURACION PANTALLA SMARTY*/
$pantalla = new Pantalla();

$parametros = array("nombre"=>$usuario->nombre, "videos"=>$videosAlfabeticamente);

$pantalla->mostrar("alfabeticamente.tpl", $parametros);

?>