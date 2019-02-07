<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-07 08:38:45
  from 'C:\UwAmp\pantallas\videos\templates\alfabeticamente.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c5be086009942_37957517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90e0d0d2e594d322b5fb1daff3eca3ac50f5dac4' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\alfabeticamente.tpl',
      1 => 1549487902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c5be086009942_37957517 (Smarty_Internal_Template $_smarty_tpl) {
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
            <div id="cerrar-sesion">
                <a href="cerrarSesion.php">Cerrar sesión</a>
            </div>
            <h1>NerdFlix</h1>
            <h2>Bienvenido, <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</h2>
            <div id="filtrar">
                <h2>Ordenado alfabeticamente</h2>
                <a href="alfabeticamente.php">Alfabeticamente</a>
                <a href="categoria.php">Por categoria</a>
            </div>
        </header>
        <main>
            <div id="peliculas">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['videos']->value, 'video');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['video']->value) {
?>
                <div class="pelicula">
                    <form action="verInfoPelicula.php" method="post">
                        <!--Datos de pelicula-->
                        <h3 class="titulo"><?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
</h3>
                        <input type="image" class="cartel empezar-stream" src="<?php echo $_smarty_tpl->tpl_vars['video']->value->cartel;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
" />
                        <?php if ($_smarty_tpl->tpl_vars['video']->value->vista == "S") {?>
                            <p>Vistoooo</p>
                        <?php }?>
                        
                        <input type="hidden" name="codigo" value="<?php echo $_smarty_tpl->tpl_vars['video']->value->codigo;?>
" />
                    </form>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </main>
        <footer>
            
        </footer>
    </body>
</html><?php }
}
