<?php
/* Smarty version 3.1.30, created on 2016-08-24 01:53:47
  from "/var/www/openstart/day9/templates/main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57bcd3fbb98786_77396252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bde1247ed62ce251cdb8d5b54e36d142f506bd81' => 
    array (
      0 => '/var/www/openstart/day9/templates/main.tpl',
      1 => 1471992826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bcd3fbb98786_77396252 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <link rel="stylesheet" href="css/main.css"/>


</head>
<body>

<div id="wrapper">

    <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


    <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


    <div id="footer"></div>

</div>

</body>
</html><?php }
}
