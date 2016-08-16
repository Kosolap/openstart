<?php

include 'functions.php';
include '../day2/service/userservice.php';
include_once '../day2/service/db.php';

    session_start();


    if($_SESSION['user'] == '')
    {
        $_SESSION['user'] = 'Anon';

    }

    $_SESSION['message'] = 'norm';



if($_POST){

    $info = array(
        'login' => htmlspecialchars($_POST['login']),
        'password' => $_POST['password'],
    );

    if(isset($_POST['password_rep'])){
        registration($info);
        getView('authorization');
    }

    else{
        if(!authorization($info))
        $_SESSION['message'] = 'error';

        getView('authorization');
    }

}
else{

    if($_GET['action']){

        switch ($_GET['action']){

            case 'logout':
                $_SESSION['user'] = 'Anon';
                getView('authorization');
                break;

            case 'test':
                getview('test');
                break;

            case 'registration':
                getview('registration');
                break;

            default:
                getView('authorization');

        }
    }

    elseif ($_GET['login']){

        $user = getByName($_GET['login'])['login'];

        if(isset($user))
        {
            echo '0';
        }

    }

    else{
        getView('authorization');
    }



}


