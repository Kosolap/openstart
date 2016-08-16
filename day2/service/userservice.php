<?php

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