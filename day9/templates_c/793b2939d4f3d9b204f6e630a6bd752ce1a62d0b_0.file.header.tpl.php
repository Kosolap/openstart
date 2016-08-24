<?php
/* Smarty version 3.1.30, created on 2016-08-24 13:57:00
  from "/var/www/openstart/day9/templates/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57bd7d7ca2baf3_84401027',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '793b2939d4f3d9b204f6e630a6bd752ce1a62d0b' => 
    array (
      0 => '/var/www/openstart/day9/templates/header.tpl',
      1 => 1472036216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd7d7ca2baf3_84401027 (Smarty_Internal_Template $_smarty_tpl) {
?>
    <div id="left"></div>
    <div id="cent">
        <table>
            <tr>
                <td rowspan="2" id="logohd"><img src="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
img/logo.png"/> </td>
                <td id="telhd"><img src="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
img/telef.png"/></td>
                <td id="mailhd"><a id="mail" href="mailto:support@openstart.ru">support@openstart.ru</a></td>
            </tr>
            <tr>
                <td id="menuhd">
                    <ul id="menu">
                        <li><a class="lilink" href="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
">ГЛАВНЯ</a></li>
                        <li><a class="lilink" href="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
info">ОПИСАНИЕ</a></li>
                        <li><a class="lilink" href="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
port">ПОРТФОЛИО</a></li>
                        <li><a class="lilink" href="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
cont">КОНТАКТЫ</a></li>
                    </ul>
                </td>
                <td></td>
            </tr>

        </table>
    </div>
    <div id="right"></div><?php }
}
