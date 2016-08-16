<?php

include 'functions.php';

//Ловим телефонный номер на проверку
if($_POST){

    getview('answer', $_POST['number']);

}

//Если запроса на проверку нет, показываем главную с формой запроса
else {

    getview('quest');

}


