<?php

include 'functions.php';

if(!isset($_SESSION['user'])){

    session_start();

    $_SESSION['user'] = 'Anon';
}


if($_POST){

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

    else{
        getView('authorization');
    }



}


