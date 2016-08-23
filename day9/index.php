<?php
header('Content-type: text/html; charset=utf-8');
// Обратите внимание: в слове Smarty буква 'S' должна быть заглавной
require_once('Smarty.class.php');
$smarty = new Smarty();


$smarty->assign('name', 'Kosolap');
$smarty->assign('title', 'Главная страница');
$smarty->assign('header', 'header.tpl');

//$smarty->debugging = true;

//$smarty->display('index.tpl');

$smarty->assign('content','maincontent.tpl');

$smarty->display('main.tpl');
?>



