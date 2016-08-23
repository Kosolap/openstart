<?php
/* Smarty version 3.1.30, created on 2016-08-24 01:35:09
  from "/var/www/openstart/day9/templates/maincontent.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57bccf9d212c51_10041846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61a0a91523be3e9f5ceb43c9c893854208376873' => 
    array (
      0 => '/var/www/openstart/day9/templates/maincontent.tpl',
      1 => 1471991680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bccf9d212c51_10041846 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="content">
    Привет, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
! Добро пожаловать в Smarty!

    <p>
        /*
        Создать сайт визитку с использованием шаблонизатора Smarty
        Сайт должен быть посвящен одной какой-либо услуге компании OpenStart.
        Содержать ряд статических страниц:
        Главная
        Об услуги
        Примеры работ
        Контакты

        Все стили должны быть описаны в less, который автоматически должен компилироваться через phpStorm
        *Если останется время подключить слайдер листающий HTML слайды.
        */
    </p>
</div><?php }
}
