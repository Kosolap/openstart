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

    $_SESSION['username'] = $info['login'];
}

function authorization($info){

    $author = getByName($info['login']);
    if($author->get('name') === $info['login']){
        $password = md5(md5($info['password']).$author->get('salt'));
        if($password == $author->get('password')){
            $_SESSION['username'] = $author->get('name');

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

    return new Author($author[0]);
}