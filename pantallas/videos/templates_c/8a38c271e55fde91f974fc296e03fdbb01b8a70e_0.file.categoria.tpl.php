<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-05 13:27:07
  from 'C:\UwAmp\pantallas\videos\templates\categoria.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c59811ba20226_67656032',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a38c271e55fde91f974fc296e03fdbb01b8a70e' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\categoria.tpl',
      1 => 1549369624,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c59811ba20226_67656032 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Nerdflix</title>
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
    <body>
        <header>
            <h1>NerdFlix</h1>
            <h2>Bienvenido, <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</h2>
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
</html><?php }
}
