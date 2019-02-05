<?php
require_once("../../seguridad/videostreaming-s/Videosbd.class.php");
require_once("../../seguridad/videostreaming-s/Funciones.class.php");
//Comprueba si le llegan los datos
if (!isset($_POST['dni'])) {
    header("Location: index.php");
    exit;
} else if (!isset($_POST['clave'])) {
    header("Location: index.php");
    exit;
}

$dni = strip_tags(trim($_POST['dni']));
$clave = strip_tags(trim($_POST['clave']));

//Llama a la funcion estatica que se encarga de validar el usuario
$usuario = Videosbd::validarUsuario($dni, $clave);
if (!is_null($usuario)) {
    //Login correcto
    //Serializa el objeto usuario
    $usuarioSerializado = serialize($usuario);
    //Lo mete en una variable de sesion
    Funciones::inicioSesion();
    $_SESSION['usuario'] = $usuarioSerializado;
    header("Location: alfabeticamente.php");
    exit;
} else {
    //Login incorrecto
    $mensaje = "Las credenciales son incorrectas";
    header("Location: index.php?mensaje=".urlencode($mensaje));
    exit;
}
?>