<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-05 22:00:03
  from 'C:\UwAmp\pantallas\videos\templates\verInfoPelicula.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c59f953858474_25636547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b3af0ae2cf2698564aeb2b33fcf6905c329fa4a' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\verInfoPelicula.tpl',
      1 => 1549400373,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c59f953858474_25636547 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nerflix</title>
    <link rel="stylesheet" href="style/style.css" />
</head>
<body>
    <h1><?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
</h1>
    <div id="cerrar-sesion">
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </div>
    
    <div class="descripcion-video">
        <form action="visualizar.php" method="post">
            <img src="<?php echo $_smarty_tpl->tpl_vars['video']->value->cartel;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
" class="cartel-grande" />
            <p><?php echo $_smarty_tpl->tpl_vars['video']->value->sinopsis;?>
</p>
            <input type="hidden" name="codigo" value="<?php echo $_smarty_tpl->tpl_vars['video']->value->codigo;?>
" />
            <input type="submit" name="ver" value="Emitir" />
        </form>
        <?php if ($_smarty_tpl->tpl_vars['video']->value->descargable == "S") {?>
        <form action="descargar.php" method="post">
            <div id="descargar">
                <input type="hidden" name="codigo" value="<?php echo $_smarty_tpl->tpl_vars['video']->value->codigo;?>
" />
                <input type="hidden" name="titulo" value="<?php echo $_smarty_tpl->tpl_vars['video']->value->titulo;?>
" />
                <input type="submit" name="descargar" value="Descargar" />
            </div>
        </form>
        <?php }?>
    </div>
</body>
</html><?php }
}
