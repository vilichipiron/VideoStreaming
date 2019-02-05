<?php
require_once("Pantalla.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");

if (!isset($_POST['ruta'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
} 

$ruta = trim(strip_tags($_POST['ruta']));


Funciones::inicioSesion();

$_SESSION['ruta'] = $ruta;
//-----Aqui desencriptaria la ruta-----

//Guarda la ruta del video en una variable de sesion

//Crea la pantalla inicial
$pantalla = new Pantalla();

//Le pasa los parametros
$parametros = array('scriptstreaming'=>'reproductor.php');

//Muestra la pantalla inicial
$pantalla -> mostrar("visualizar.tpl", $parametros);
?>