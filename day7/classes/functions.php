<?php


function getView($url, $data=null, $message=null){

    $url = '../day7/views/'.$url.'.php';

    include '../day7/views/template.php';

}