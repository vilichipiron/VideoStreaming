<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>NerdFlix</title>
        <script>
            function muestraMensaje(mensaje) {
                if (mensaje != "") {
                    document.getElementById("mensaje").innerHTML = mensaje;
                } else {
                    return false;
                }
            }
        </script>
    </head>
    <body onload="muestraMensaje('{$mensaje}')">
        <h3 id="mensaje"></h3>
        <div id="formulario-login">
            <form action="validarUsuario.php" method="post">
                <input type="text" name="dni" id="dni" placeholder="Dni" />
                <input type="password" name="clave" id="clave" placeholder="Clave" />
                <input type="submit" name="enviar" id="enviar" value="Iniciar sesión" />
            </form>
        </div>
    </body>
</html>