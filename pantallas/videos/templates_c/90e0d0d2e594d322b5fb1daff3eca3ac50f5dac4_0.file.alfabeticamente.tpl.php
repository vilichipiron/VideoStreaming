<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-01 17:18:49
  from 'C:\UwAmp\pantallas\videos\templates\alfabeticamente.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c547169e52992_69350089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90e0d0d2e594d322b5fb1daff3eca3ac50f5dac4' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\alfabeticamente.tpl',
      1 => 1549037928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c547169e52992_69350089 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
                <h2>Ordenar</h2>
                <a href="alfabeticamente.php">Alfabeticamente</a>
                <a href="categoria.php">Por categoria</a>
            </div>
            <div id="cerrar-sesion">
                <a href="cerrarSesion.php">Cerrar sesión</a>
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
                    <!--Datos de pelicula-->
                    <h3 class="titulo" id="<?php echo $_smarty_tpl->tpl_vars['video']->value->codigo;?>
"><?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
</h3>
                    <img class="cartel" src="<?php echo $_smarty_tpl->tpl_vars['video']->value->cartel;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
" />
                    <p class="sinopsis"><?php echo $_smarty_tpl->tpl_vars['video']->value->sinopsis;?>
</p>
                    <?php if ($_smarty_tpl->tpl_vars['video']->value->descargable == "S") {?>
                    <button class="descargar" name="descargar" id="<?php echo $_smarty_tpl->tpl_vars['video']->value->codigo;?>
">Descargar</button>
                    <?php }?>
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
