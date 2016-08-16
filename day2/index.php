<?php

include 'functions.php';
include '../day2/service/userservice.php';

if(!isset($_SESSION['user'])){

    session_start();

    $_SESSION['user'] = 'Anon';
}


if($_POST){

    $info = array(
        'login' => $_POST['login'],
        'password' => $_POST['password'],
    );

    if(isset($_POST['password_rep'])){
        registration($info);
    }

    else{
        authorization($info);
    }

    header('Location: /');

}
else{

    if($_GET['action']){

        switch ($_GET['action']){


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


