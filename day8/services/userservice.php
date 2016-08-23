<?php
include 'db.php';

function registration($info){

    $db = getDB();

    $login = ($info['login']);
    $password = $info['password'];
    $salt = mt_rand(100, 999);
    $password = md5(md5($password).$salt);


    $row = $db->prepare('INSERT INTO users (login,password,salt) VALUES (:login,:password,:salt)');
    $row->execute(array('login'=>$login,
        'password'=>$password,
        'salt'=>$salt));

}

function authorization($info){

    $author = getByName($info['login']);
    if($author['login'] === $info['login']){
        $password = md5(md5($info['password']).$author['salt']);
        if($password == $author['password']){

            $_SESSION['user'] = htmlspecialchars_decode($author['login']);
            if($info['remember']=='on'){
                setcookie('userdata',json_encode(array(
                    'login' => $info['login'],
                    'password' => $info['password']
                )), time()+10000);
            }

            return true;
        }
        else return false;
    }
    else return false;

}


function getByName($name){
    $db = getDB();

    $row = $db->prepare('SELECT * FROM users WHERE login = ?');
    $row->execute(array($name));

    $author = $row->fetchAll();

    $author = $author[0];

    return $author;
}

function getAllUsers(){
    $db = getDB();

    $row = $db->prepare('SELECT * FROM users');
    $row->execute();

    $authors = $row->fetchAll();

    return $authors;
}

function getUserInfo($name){

    $db = getDB();

    $row = $db->prepare('SELECT * FROM user_info WHERE login = ?');
    $row->execute(array($name));

    $info = $row->fetchAll();

    $info = $info[0];

    return $info;
}

function setUserInfo($data){

    $db = getDB();

    if(getUserInfo($data['login']) != 0){

        $name = $data['name'];
        $reg_date = $data['reg_date'];
        $birth_date = $data['birth_date'];
        $last_activ= time();
        $login = $data['login'];

        $row = $db->prepare('UPDATE user_info SET name=:name,birth_date=:birth_date,'.
            'last_activ=:last_activ WHERE login=:login');

        $row->execute(array('name'=>$name,
            'birth_date'=>$birth_date,
            'last_activ'=>$last_activ,
            'login'=>$login));

    }
    else{
        $name = '';
        $reg_date = time();
        $birth_date = 0;
        $last_activ= time();
        $login = $data['login'];

        $row = $db->prepare('INSERT INTO user_info (name,birth_date,reg_date,last_activ,login)'.
            ' VALUES (:name,:birth_date,:reg_date,:last_activ,:login)');

        $row->execute(array('name'=>$name,
            'reg_date'=>$reg_date,
            'birth_date'=>$birth_date,
            'last_activ'=>$last_activ,
            'login'=>$login));

    }

}