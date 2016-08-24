<?php
include '../day11/services/db.php';


function saveOrUpdate($id){

    $db = getDB();

    $row = $db->prepare('SELECT * FROM sessions WHERE ident = ?');
    $row->execute(array($id));

    $session = $row->fetchAll();

    $session = $session[0];

    $date = time();

    if($session != null){


        $row = $db->prepare('UPDATE sessions SET date =:date WHERE ident =:ident');
        $row->execute(array('date'=> $date, 'ident'=> $id));

    }

    else{

        $row = $db->prepare('INSERT INTO sessions (ident, date) VALUES  (:ident, :date)');
        $row->execute(array('date'=> $date, 'ident'=> $id));

    }

}


function getOnliene(){

    $db = getDB();

    $row = $db->prepare('SELECT * FROM sessions');
    $row->execute();

    $sessions = $row->fetchAll();

    $date = time();

    $rez = 0;

    foreach ($sessions as  $session){

        if(($date - $session['date']) < 60)$rez++;

    }

    return $rez;
}