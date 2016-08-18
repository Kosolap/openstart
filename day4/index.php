<?php

include '../day4/service/orderservice.php';

//Данные для отправки запроса на оплату через робокассу

$mrh_login = "TestMagaz001";
$mrh_pass1 = "kos12345";

$inv_id = 0;
$order_summ = 0;
$inv_desc = "ROBOKASSA Advanced User Guide";
$shp_item = 1;
$in_curr = "";
$culture = "ru";
$encoding = "utf-8";




if($_GET['id']){

    $inv_id = $_GET['id'];

    $order_summ = getOrder($_GET['id']);

    echo $order_summ;
}
elseif ($_GET['sign']){

    $sign =md5($mrh_login . ":" . $_GET['summ'] . ":" . $_GET['order_id'] . ":kos12345");

    echo $sign;
}
else {

    include 'form.php';

}