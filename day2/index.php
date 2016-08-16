<?php

include 'functions.php';
include '../day2/service/userservice.php';
include_once '../day2/service/db.php';

    session_start();


    if($_SESSION['user'] == '')
    {
        if($_COOKIE['userdata']){

            $userdata = json_decode($_COOKIE['userdata']);

            authorization($userdata);
        }
        else{
            $_SESSION['user'] = 'Anon';
        }

    }



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
        $info['remember'] = $_POST['remember'];

        authorization($info);

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


        if($_GET['password']){


            $info = array(
                'login' => htmlspecialchars($_GET['login']),
                'password' => $_GET['password'],
            );

            $zed = authorization($info);

            if(!authorization($info)) echo '0';


        }
        else{

            $user = getByName($_GET['login'])['login'];

            if(isset($user))
            {
                echo '0';
            }
        }

    }

    else{
        getView('authorization');
    }



}


