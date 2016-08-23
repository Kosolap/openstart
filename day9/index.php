<?php
header('Content-type: text/html; charset=utf-8');
// Обратите внимание: в слове Smarty буква 'S' должна быть заглавной
require_once('Smarty.class.php');
$smarty = new Smarty();


$smarty->assign('name', 'Kosolap');

$smarty->debugging = true;

$smarty->display('index.tpl');
?>



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