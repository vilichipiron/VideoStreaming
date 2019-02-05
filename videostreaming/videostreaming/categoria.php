<?php
//Es la clase que se encarga de presentar los videos de cada usuario ordenados por tematica
include("../../seguridad/videostreaming-s/inicioPagina.php");
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("Pantalla.class.php");

//Obtiene el objeto usuario
$usuario = unserialize($_SESSION['usuario']);

//Obtiene un array de los videos que tiene el usuario
$videosCategoria = Videosbd::getVideosTematica($usuario->codigosPerfiles);

/*CONFIGURACION PANTALLA SMARTY*/
$pantalla = new Pantalla();

$parametros = array("nombre"=>$usuario->nombre, "videos"=>$videosCategoria);

$pantalla->mostrar("categoria.tpl", $parametros);

var_dump($videosCategoria);

?>