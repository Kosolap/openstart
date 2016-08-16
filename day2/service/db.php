<?php

//Задаём параметры для PDO, в каком виде будут выводится данные и ошибки
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

//Подключаемся к базе данных
$database = new PDO('mysql:host=localhost:3306;dbname=day2','root','12345',$opt);

//Функция вызываемая сервисов, чтоб не надо было каждый раз создавать новое подключение
function getDB(){
    global $database;
    return $database;
}