<?php
    require_once("../../seguridad/videostreaming-s/Funciones.class.php");
    Funciones::inicioSesion();
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
    exit;
?>