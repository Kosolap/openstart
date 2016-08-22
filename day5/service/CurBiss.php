<?php

class CurBiss
{

    private $id;
    private $name;
    private $col;
    private $price;
    private $order_id;

    function __construct($data) {

        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->col = $data['col'];
        $this->price = $data['price'];
        $this->order_id = $data['order_id'];

    }

    function get($var){
        return $this->$var;
    }

    static function init(){
        $data1 = array('name'=>'Услуга1',
            'col'=>'5',
            'price'=>'20',
            'order_id'=>'100');


        $data2 = array('name'=>'Услуга2',
            'col'=>'2',
            'price'=>'350',
            'order_id'=>'100');

        $data3 = array('name'=>'Услуга3',
            'col'=>'1',
            'price'=>'200',
            'order_id'=>'100');

        $data4 = array('name'=>'Услуга1',
            'col'=>'10',
            'price'=>'20',
            'order_id'=>'120');

        $data5 = array('name'=>'Услуга2',
            'col'=>'10',
            'price'=>'50',
            'order_id'=>'120');

        $data6 = array('name'=>'Услуга3',
            'col'=>'1',
            'price'=>'300',
            'order_id'=>'120');

        $data7 = array('name'=>'Услуга1',
            'col'=>'2',
            'price'=>'500',
            'order_id'=>'130');

        $data8 = array('name'=>'Услуга1',
            'col'=>'2',
            'price'=>'250',
            'order_id'=>'140');

        $data9 = array('name'=>'Услуга2',
            'col'=>'2',
            'price'=>'250',
            'order_id'=>'140');

        CurBissService::saveOrUpdate($data1);
        CurBissService::saveOrUpdate($data2);
        CurBissService::saveOrUpdate($data3);
        CurBissService::saveOrUpdate($data4);
        CurBissService::saveOrUpdate($data5);
        CurBissService::saveOrUpdate($data6);
        CurBissService::saveOrUpdate($data7);
        CurBissService::saveOrUpdate($data8);
        CurBissService::saveOrUpdate($data9);
    }

}