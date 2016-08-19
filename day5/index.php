<?php
require_once __DIR__ . '/vendor/autoload.php';
include '../day5/service/db.php';
include '../day5/service/OrderService.php';
include '../day5/service/CurBissService.php';
include '../day5/functions.php';



if($_POST['client']){

    $orders = OrderService::getAllByCompany($_POST['client']);

    getView('orders',$orders);

}
elseif($_GET['client']){
    $orders = OrderService::getAllByCompany($_GET['client']);


    if(count($orders) == 0)
    {
        echo ok;
    }
}
elseif ($_GET['printB']){



    $order = OrderService::getOrderByInvId($_GET['printB']);
    $currbis = CurBissService::getAllByInvId($_GET['printB']);

    $data = array('order'=>$order, 'cb'=>$currbis);


    getPdf('bill',$data);

}
elseif ($_GET['printA']){

    $order = OrderService::getOrderByInvId($_GET['printA']);
    $currbis = CurBissService::getAllByInvId($_GET['printA']);

    $data = array('order'=>$order, 'cb'=>$currbis);


    getPdf('act',$data);

}
else{
    include '../day5/docviews/test.html';
    //getView('main');
}

