<?php

//Задаём параметры для PDO, в каком виде будут выводится данные и ошибки
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

//Подключаемся к базе данных

/*
$server = "mysql:host=127.0.0.1;dbname=day2;";


$user = 'root';

$password = '123';
*/


//Подключаемся к базе данных
$server = "mysql:host=127.0.0.1;dbname=day2";

$user = 'root';

$password = '123';

$dbh = new PDO($server, $user, $password, $opt);





//Функция вызываемая сервисов, чтоб не надо было каждый раз создавать новое подключение
function getDB(){
    global $dbh;
    return $dbh;
}
