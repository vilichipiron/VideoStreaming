<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nerflix</title>
    <link rel="stylesheet" href="style/style.css" />
</head>
<body>
    <h1>{$video->titulo}</h1>
    <div id="cerrar-sesion">
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </div>
    
    <div class="descripcion-video">
        <form action="visualizar.php" method="post">
            <img src="{$video->cartel}" alt="{$video->titulo}" class="cartel-grande" />
            <p>{$video->sinopsis}</p>
            <input type="hidden" name="codigo" value="{$video->codigo}" />
            <input type="submit" name="ver" value="Emitir" />
        </form>
        {if $video->descargable eq "S"}
        <form action="descargar.php" method="post">
            <div id="descargar">
                <input type="hidden" name="codigo" value="{$video->codigo}" />
                <input type="hidden" name="titulo" value="{$video->titulo}" />
                <input type="submit" name="descargar" value="Descargar" />
            </div>
        </form>
        {/if}
    </div>
</body>
</html>