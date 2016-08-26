<?php
include '../day8/services/viewService.php';
include '../day8/services/userservice.php';

session_start();


if(!isset($_SESSION['user']))
{
    if(isset($_COOKIE['userdata'])){

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
elseif (isset($_GET['list'])){
    getView('list',getAllUsers());
}
elseif (isset($_GET['inf'])){
    echo json_encode(getUserInfo($_GET['inf']));
}
elseif (isset($_GET['info'])){
    $userInfo = getUserInfo($_GET['info']);

    if($userInfo != 0) getView('main', $userInfo);

    else{
        $userInfo = getAllUsers();
        getView('list', $userInfo);
    }
}
elseif (isset($_GET['lgout'])){
    $_SESSION['user'] = 'Anon';
    if(isset($_COOKIE['userdata'])) unset ($_COOKIE ['userdata']);

    getView('authorization',array('page' => 'authorization'));
}
elseif (isset($_GET['login'])){


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
        $data = array('login' => $_POST['login']);
        setUserInfo($data);
    }
    else{

        $info['remember'] = $_POST['remember'];

        if(authorization($info)) echo 'good';
    }

}
elseif (isset($_POST['userData'])){

    setUserInfo($_POST['userData']);

}
elseif($_SESSION['user'] == 'Anon'){

    getView('authorization',array('page' => 'authorization'));

}
else  {
    $info = getUserInfo($_SESSION['user']);

    getView('main',$info);
}