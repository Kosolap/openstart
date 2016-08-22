<?php
include '../day8/services/viewService.php';
include '../day8/services/userservice.php';

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


if(isset($_GET['reg'])){

    getView('registration',array('page' => 'registration'));

}
elseif ($_GET['login']){


        $user = getByName($_GET['login'])['login'];

        if(isset($user))
        {
            echo '0';
        }

}
elseif (isset($_POST['login'])){

    $info = array(
        'login' => htmlspecialchars($_POST['login']),
        'password' => $_POST['password'],
    );

    if(isset($_POST['password_rep'])){
        registration($info);
    }
    else{

        $info['remember'] = $_POST['remember'];

        if(authorization($info)) echo 'good';
    }

}
elseif($_SESSION['user'] == 'Anon'){

    getView('authorization',array('page' => 'authorization'));

}
else  getView('main');