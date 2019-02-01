<?php
    require_once("Funciones.class.php");
    Funciones::inicioSesion();
	if (!Funciones::validado()) {
        session_destroy();
        unset($_SESSION);
        header("Location: index.php");
        exit;
    }
?>