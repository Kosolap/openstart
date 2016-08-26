<?php
/* Smarty version 3.1.30, created on 2016-08-24 16:11:05
  from "/var/www/openstart/day9/templates/portfolio.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57bd9ce9bf30c5_95975659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0d4153e70eaef6053cdac55d1f6161c580f8332' => 
    array (
      0 => '/var/www/openstart/day9/templates/portfolio.tpl',
      1 => 1472044264,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd9ce9bf30c5_95975659 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="content">
    <div id="leftcont">&nbsp</div>
    <div id="centcont">

        <div class="space">&nbsp</div>

        <div id="pult">
            <h3 id="name"></h3><br>
            <img src="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
img/left.png" onclick="previos()" width="20" height="15"/>

            <p id="info"></p>

            <img src="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
img/right.png" onclick="previos()" width="20" height="15"/>
        </div>

        <div id="display">
                <img id='dispimg' src=""/>
        </div>

        <div class="space">&nbsp</div>

    </div>
    <div id="rightcont"></div>
</div>



<?php }
}
