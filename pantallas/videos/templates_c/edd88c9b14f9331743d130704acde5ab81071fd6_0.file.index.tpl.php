<?php
/* Smarty version 3.1.34-dev-7, created on 2019-01-30 08:29:36
  from 'C:\UwAmp\pantallas\videos\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c51526043ee67_98769396',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'edd88c9b14f9331743d130704acde5ab81071fd6' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\index.tpl',
      1 => 1548833371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c51526043ee67_98769396 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>DAW TWO FLIX</title>
        <?php echo '<script'; ?>
>
            function muestraMensaje(mensaje) {
                if (mensaje != "") {
                    document.getElementById("mensaje").innerHTML = mensaje;
                } else {
                    return false;
                }
            }
        <?php echo '</script'; ?>
>
    </head>
    <body onload="muestraMensaje('<?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
')">
        <h3 id="mensaje"></h3>
        <div id="formulario-login">
            <form action="validarUsuario.php" method="post">
                <input type="text" name="dni" id="dni" placeholder="Dni" />
                <input type="password" name="clave" id="clave" placeholder="Clave" />
                <input type="submit" name="enviar" id="enviar" value="Iniciar sesión" />
            </form>
        </div>
    </body>
</html><?php }
}
