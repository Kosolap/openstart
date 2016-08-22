<?php

ini_set('display_errors', 1);

// Подключаем класс для работы с excel
include_once dirname(__FILE__) . '/Classes/PHPExcel.php';

// Подключаем класс для вывода данных в формате excel
include_once dirname(__FILE__) . '/Classes/PHPExcel/Writer/Excel2007.php';

include_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

require_once __DIR__ . '/vendor/autoload.php';
include '../day5/service/db.php';
include '../day5/service/OrderService.php';
include '../day5/service/CurBissService.php';
include '../day5/functions.php';

if(isset($_POST['client'])){

    $orders = OrderService::getAllByCompany($_POST['client']);

    getView('orders',$orders);

}
elseif(isset($_GET['client'])){
    $orders = OrderService::getAllByCompany($_GET['client']);


    if(count($orders) == 0)
    {
        echo 'ok';
    }
}
elseif (isset($_GET['printB'])){



    $order = OrderService::getOrderByInvId($_GET['printB']);
    $currbis = CurBissService::getAllByInvId($_GET['printB']);

    $data = array('order'=>$order, 'cb'=>$currbis);


    getPdf('bill',$data);

}
elseif (isset($_GET['printA'])){

    $order = OrderService::getOrderByInvId($_GET['printA']);
    $currbis = CurBissService::getAllByInvId($_GET['printA']);

    $data = array('order'=>$order, 'cb'=>$currbis);


    getPdf('act',$data);

}
elseif (isset($_GET['idW'])){


    $order = OrderService::getOrderByInvId($_GET['idW']);

    if($_GET['type']=='csv'){

        $order->saveAsCSV();

    }
    else{

        $order->saveAsXls($_GET['type']);
    }

}
elseif (isset($_FILES['fileToUpload'])){

    $message = '';

    $name = trim($_FILES['fileToUpload']['name']);

    if(preg_match('/\.[csv]{1}/',$name)){
        $target_dir = "../day5/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $order = new Order();
        $res = $order->loadFromCSV($target_file, $_POST['clientR']);
        $message = $res;
    }
    elseif(!preg_match('/\.[xls|xlsx]{1}/',$name)){
        if($name == '') $message = 'Не выбран файл!';
        else $message = 'Неправильный формат файла!';
    }
    else {
        $target_dir = "../day5/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $order = new Order();
        $res = $order->loadFromXls($target_file, $_POST['clientR']);

        $message = $res;
    }


    $orders = OrderService::getAllByCompany($_POST['clientR']);

    getView('orders',$orders, $message);
}
else{
    getView('main');
}