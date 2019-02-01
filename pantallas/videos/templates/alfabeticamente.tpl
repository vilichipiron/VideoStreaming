<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Nerdflix</title>
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <body>
        <header>
            <h3>Catalogo de videos</h3>
            <div id="filtrar">
                <h5>Ordenar</h5>
                <a href="alfabeticamente.php">Alfabeticamente</a>
                <a href="categoria.php">Por categoria</a>
            </div>
            <div id="cerrar-sesion">
                <a href="cerrarSesion.php">Cerrar sesión</a>
            </div>
        </header>
        <main>
            <div id="peliculas">
                {foreach from=$videos item=video}
                <div class="pelicula">
                    <!--Datos de pelicula-->
                    <h3 class="titulo" id="{$video->codigo}">{$video->titulo}</h3>
                    <img class="cartel" src="{$video->cartel}" alt="{$video->titulo}" />
                    <p class="sinopsis">{$video->sinopsis}</p>
                    {if $video->descargable eq "S"}
                    <button class="descargar" name="descargar" id="{$video->codigo}">Descargar</button>
                    {/if}
                </div>
                {/foreach}
            </div>
        </main>
        <footer>
            
        </footer>
    </body>
</html>