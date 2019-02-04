<?php
    define ("CAMINO","../../tmp/");
    if (!isset($_POST['ruta']) || !isset($_POST['titulo'])) {
        session_destroy();
        unset($_SESSION);
        header("Location: index.php");
        exit;
    }   
    $ruta = trim(strip_tags($_POST['ruta']));
    $titulo = $_POST['titulo'];
        
    //-----Aqui desencriptaria la ruta-----
        
    //----------Descarga el archivo----------
    $fichero = CAMINO.$titulo;   
    $zip = new ZipArchive();
    $zip->open($fichero, ZIPARCHIVE::CREATE);
        
    $zip->addFile($ruta);
        
    $zip->close();
    header("Content-disposition: attachment; filename=Pelicula.zip");
    header("Content-type: application/zip, application/octet-stream");
    readfile($fichero);
?>