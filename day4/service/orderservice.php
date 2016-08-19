<?php

include '../day4/service/db.php';

function getOrder($id){

    $db = getDB();

    $row = $db->prepare('SELECT * FROM orders2 WHERE id = :id');
    $row->execute(array('id'=>$id));

    $price = $row->fetchAll();

    return $price[0]['price'];

}

