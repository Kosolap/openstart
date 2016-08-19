<?php

class Order
{
    private $id;
    private $inv_id;
    private $start_date;
    private $end_date;
    private $client;
    private $summ;

    function __construct($data) {

        $this->id = $data['id'];
        $this->inv_id = $data['inv_id'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
        $this->client = $data['client'];
        $this->summ = $data['summ'];
    }

    function get($var){
        return $this->$var;
    }

    function init(){
        $data1 = array('inv_id'=>'100',
            'client'=>'ООО "Компания "Покупатель"',
            'summ'=>'1000');


        $data3 =  array('inv_id'=>'120',
            'client'=>'ООО "Компания "Покупатель"',
            'summ'=>'1000');

        $data4 =  array('inv_id'=>'130',
            'client'=>'ООО "Компания "Покупатель"',
            'summ'=>'1000');

        $data5 =  array('inv_id'=>'140',
            'client'=>'ООО "Компания "Покупатель"',
            'summ'=>'1000');

        OrderService::saveOrUpdate($data1);
        OrderService::saveOrUpdate($data3);
        OrderService::saveOrUpdate($data4);
        OrderService::saveOrUpdate($data5);
    }

}