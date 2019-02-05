<?php
    require_once("Pantalla.class.php");
    //Recibe el mensaje si lo hay
    $mensaje = "";
    if (isset($_GET['mensaje'])) {
        $mensaje = trim(strip_tags($_GET['mensaje']));
    }

    /*CONFIGURACION PANTALLA SMARTY*/

    //Crea la pantalla inicial
    $pantalla = new Pantalla();
    //Le pasa los parametros
    $parametros = array('mensaje'=>$mensaje);
    //Muestra la pantalla inicial
    $pantalla -> mostrar("index.tpl", $parametros);
?>