<?php

include  'CurBiss.php';

class CurBissService
{

    static function getAllByInvId($id){

        $db = getDB();

        $rows = $db->prepare('SELECT * FROM current_business WHERE order_id = ?');
        $rows->execute(array($id));

        $currbis = $rows->fetchAll();

        $result = array();

        foreach ($currbis as $curr){

            array_push($result, new CurBiss($curr));

        }


        return $result;

    }


    static function saveOrUpdate($data){
        $db = getDB();

        $row = $db->prepare('INSERT INTO current_business (name,col,price,order_id) VALUES (:name,:col,:price,:order_id)');

        $row->execute(array('name'=>$data['name'],
            'col'=>$data['col'],
            'price'=>$data['price'],
            'order_id'=>$data['order_id']));

    }

    static function save($data){
        $db = getDB();

        $rows = $db->prepare('DELETE FROM current_business WHERE order_id = ?');
        $rows->execute(array($data[0]->get('order_id')));

        for($i = 0; $i < count($data); $i++){

            $row = $db->prepare('INSERT INTO current_business (name,col,price,order_id) VALUES (:name,:col,:price,:order_id)');

            $row->execute(array('name'=>$data[$i]->get('name'),
                'col'=>$data[$i]->get('col'),
                'price'=>$data[$i]->get('price'),
                'order_id'=>$data[$i]->get('order_id')));
        }

    }
}

