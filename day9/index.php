<?php
header('Content-type: text/html; charset=utf-8');




// Обратите внимание: в слове Smarty буква 'S' должна быть заглавной
require_once('Smarty.class.php');
$smarty = new Smarty();


$smarty->assign('name', 'Kosolap');
$smarty->assign('header', 'header.tpl');
$smarty->assign('footer', 'footer.tpl');
$smarty->assign('server', '../day9/');

//$smarty->debugging = true;

//$smarty->display('index.tpl');

$request = explode('/', $_SERVER[REQUEST_URI]);

switch ($request[2]){
    case 'cont':
        $smarty->assign('content','contacts.tpl');
        $smarty->assign('title', 'Контакты');

        break;

    case 'info':
        $smarty->assign('content','info.tpl');
        $smarty->assign('title', 'Информация');
        break;

    case 'port':
        $smarty->assign('content','portfolio.tpl');
        $smarty->assign('title', 'Портфолио');
        break;

    default:
        $smarty->assign('content','maincontent.tpl');
        $smarty->assign('title', 'Главная страница');
}

$smarty->display('main.tpl');
?>



