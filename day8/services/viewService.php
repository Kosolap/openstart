<?php

function getView($url, $data=null, $message=null){

    $title = $url;

    $url = '../day8/views/'.$url.'.php';

    include '../day8/views/template.php';

}