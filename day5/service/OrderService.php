<?php
include 'Order.php';


class OrderService
{
    static function getAllByCompany($client){

        $db = getDB();

        $rows = $db->prepare('SELECT * FROM orders WHERE client = ?');
        $rows->execute(array($client));

        $orders = $rows->fetchAll();

        $result = array();

        foreach ($orders as $order){

            array_push($result, new Order($order));

        }


        return $result;

    }





    static function getOrderByInvId($inv_id){

        $db = getDB();

        $rows = $db->prepare('SELECT * FROM orders WHERE inv_id = ?');
        $rows->execute(array($inv_id));

        $orders = $rows->fetchAll();

        $result = new Order($orders[0]);


        return $result;

    }

    static function saveOrUpdate($data){
            $db = getDB();

            $time = time();

            $row = $db->prepare('INSERT INTO orders (inv_id,start_date,end_date,client,summ) VALUES (:inv_id,:start_date,:end_date,:client,:summ)');

            $row->execute(array('inv_id'=>$data['inv_id'],
                                'start_date'=>$time,
                                'end_date'=>$time,
                                'client'=>$data['client'],
                                'summ'=>$data['summ']));

            $id = $db->lastInsertId();

            $order= OrderService::getOrderByInvId($data['inv_id']);


            return $order;
    }

    static function save($data){
        $db = getDB();

        $rows = $db->prepare('SELECT * FROM orders WHERE client = :client AND inv_id = :inv_id');
        $rows->execute(array('client'=>$data->get('client'),
                             'inv_id'=>$data->get('inv_id')));

        $orders = $rows->fetchAll();
        if(count($orders)!=0){
            $row = $db->prepare('UPDATE orders SET end_date = :end_date WHERE id = :id');

            $row->execute(array('end_date'=>$data->get('end_date'),
                                'id'=>$orders[0]['id']));
        }
        else{
            $row = $db->prepare('INSERT INTO orders (inv_id,start_date,end_date,client,summ) VALUES (:inv_id,:start_date,:end_date,:client,:summ)');

            $row->execute(array('inv_id'=>$data->get('inv_id'),
                'start_date'=>$data->get('start_date'),
                'end_date'=>$data->get('end_date'),
                'client'=>$data->get('client'),
                'summ'=>$data->get('summ')));
        }

    }

}