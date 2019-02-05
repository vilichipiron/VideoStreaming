<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Nerdflix</title>
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <script>
        window.addEventListener("load", function() {
            var formulario = "";
            
            var enviar = document.getElementsByClassName("empezar-stream");
            
            for (let i = 0; i < enviar.length; i++) {
                enviar[i].addEventListener("click", function() {
                    //Envia el formulario correspondiente que llama a EmpezarStream.php cuando se hace click en el cartel
                    formulario = enviar[i].parentElement();
                    formulario.submit();
                });
            }
            
            var descargar = document.getElementsByClassName("descargar-video");
            
            for (let i = 0; i < descargar.length; i++) {
                descargar[i].addEventListener("click", function() {
                    //Envia el formulario correspondiente que llama a descargar.php cuando se pulsa un boton descargar
                    formulario = descargar[i].parentElement();
                    formulario.submit();
                });
            }
            
        });
    </script>
    <body>
        <header>
            <h1>NerdFlix</h1>
            <h2>Bienvenido, {$nombre}</h2>
            <div id="filtrar">
                <h2>Ordenado por categoria</h2>
                <a href="alfabeticamente.php">Alfabeticamente</a>
                <a href="categoria.php">Por categoria</a>
            </div>
            <div id="cerrar-sesion">
                <a href="cerrarSesion.php">Cerrar sesión</a>
            </div>
        </header>
        <main>
          
        </main>
        <footer>
            
        </footer>
    </body>
</html>