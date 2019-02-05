<?php
    include("../../seguridad/videostreaming-s/inicioPagina.php");
    require_once("clases/Video.class.php");
    define ("CAMINO","../../tmp/");

    //Obtiene el codigo del video
    if (!isset($_POST['codigo']) || !isset($_POST['titulo'])) {
        session_destroy();
        unset($_SESSION);
        header("Location: index.php");
        exit;
    }  

    $codigoVideo = trim(strip_tags($_POST['codigo']));
    $titulo = trim(strip_tags($_POST['titulo']));
    
    //Deserealiza los videos que puede ver el usuario
    $videos = unserialize(urldecode($_SESSION['videos']));

    //Recoge el objeto que tiene como clave el codigo del video
    $videoElegido = $videos[$codigoVideo];

    //Obtiene la ruta del video
    $rutaVideo = $videoElegido->video;

        
    //----------Descarga el archivo----------
    $fichero = $titulo;   
    $zip = new ZipArchive();
    $zip->open($fichero, ZIPARCHIVE::CREATE);
        
    $zip->addFile($rutaVideo);
        
    $zip->close();
    header("Content-disposition: attachment; filename=Pelicula.zip");
    header("Content-type: application/zip, application/octet-stream");
    readfile($fichero);
?>