<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-07 08:38:48
  from 'C:\UwAmp\pantallas\videos\templates\visualizar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c5be088b1d108_17013142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ba7f7183ff279a426e1fb97a7e64a431c425137' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\visualizar.tpl',
      1 => 1549487902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c5be088b1d108_17013142 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nerdflix</title>
</head>
<body>
    <div id="cerrar-sesion">
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </div>
    <div class="video-streaming">
        <iframe src="<?php echo $_smarty_tpl->tpl_vars['scriptstreaming']->value;?>
" width="600" height="400"></iframe>
    </div>
</body>
</html><?php }
}
