<?php


if($_POST){

    $messages = array();
    $status = true;

    $contacts = trim($_POST['contacts']);
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if($contacts == ''){
        $status = false;
        array_push($messages,'Поле E-mail не заполненено!');
    }elseif (!preg_match('/^[-a-z0-9!#$%&\'*+=\/?^_`{|}~]+(?:\.[-a-z0-9!#$%&\'*+\/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}'.
                  '[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|'.
                  'org|pro|ru|tel|travel|[a-z][a-z])$/',$contacts)) {
        $status = false;
        array_push($messages,'Е-mail имеет неправильный формат');
    }

    if($name == ''){
        $status = false;
        array_push($messages,'Поле Имя не заполненено!');
    }elseif (preg_match('/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9А-Яа-я()]/u',$name)){
        $status = false;
        array_push($messages,'Имя содержит недопустимые данные');
    }

    if($comment == ''){
        $status = false;
        array_push($messages,'Пустое сообщение!');
    }elseif (preg_match('/[^\.\,\-\_\'\"\@\?\!\:\$\/ a-zA-Z0-9А-Яа-я()\r\n]+/u',$comment)){
        $status = false;
        array_push($messages,'Сообщение содержит недопустимые данные');
    }

    echo $status;

    if($status){
        $message =  'Письмо от пользователя: '.$name.'\n'.
            'Контакты пользователя: '.$contacts.'\n'.
            'Сообщение пользователя: '.$comment.'\n';

        if(mail($_SERVER["SERVER_ADMIN"],'Обращение от пользователя '.$_POST['name'],$message,'Content-type: text/plain; charset=UTF-8')){
            $status = true;
        }
        else{
            $status = false;
            array_push($messages, 'Произошла ошибка отправки письма, обратитесь к администратору');
        }

    }
}

if($_GET['name']){

    $message =  'Письмо от пользователя: '.$_GET['name'].'\n'.
                'Контакты пользователя: '.$_GET['contacts'].'\n'.
                'Сообщение пользователя: '.$_GET['comment'].'\n';

    if(mail($_SERVER["SERVER_ADMIN"],'Обращение от пользователя '.$_POST['name'],$message,'Content-type: text/plain; charset=UTF-8')){
        echo 'send';
    }

}

else{

    include '../day3/views/main.php';

}


