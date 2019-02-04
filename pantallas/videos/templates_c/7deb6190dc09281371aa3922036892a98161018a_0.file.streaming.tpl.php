<?php
/* Smarty version 3.1.34-dev-7, created on 2019-02-04 19:58:50
  from 'C:\UwAmp\pantallas\videos\templates\streaming.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c588b6a521f01_94965519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7deb6190dc09281371aa3922036892a98161018a' => 
    array (
      0 => 'C:\\UwAmp\\pantallas\\videos\\templates\\streaming.tpl',
      1 => 1549306727,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c588b6a521f01_94965519 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Streaming</title>
</head>
<body>
    <div id="video-streaming">
        <video width="800" height="600" controls="controls" preload="auto">
            <source src="<?php echo $_smarty_tpl->tpl_vars['scriptstreaming']->value;?>
" />
            Error al reproducir.
        </video>
    </div>
</body>
</html><?php }
}
