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

    function saveAsCSV(){

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=file.csv");
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
        header("Pragma: no-cache"); // HTTP 1.0
        header("Expires: 0"); // Proxies


        $fp = fopen("php://output", "w");


        fputcsv($fp,array('','Счет №',$this->inv_id));
        fputcsv($fp,array('', 'Дата открытия:', date('d.m.Y',$this->start_date)));
        fputcsv($fp,array('', 'Дата закрытия:', date('d.m.Y',$this->end_date)));
        fputcsv($fp,array('', 'Покупатель:', $this->client));
        fputcsv($fp,array('', '', ''));
        fputcsv($fp,array('', 'Услуги:', ''));
        fputcsv($fp,array('№', 'Наименование', 'Количество','Цена','Стоимость'));

        $services = CurBissService::getAllByInvId($this->inv_id);
        $summ = 0;

        for($i = 0; $i < count($services); $i++){

            fputcsv($fp,array($i+1,
                $services[$i]->get('name'),
                $services[$i]->get('col'),
                number_format($services[$i]->get('price')/100, 2, '.', ' '),
                number_format($services[$i]->get('col')*$services[$i]->get('price')/100, 2, '.', ' ')));

            $summ += $services[$i]->get('price')*$services[$i]->get('col');

        }
        fputcsv($fp,array('', 'Сумма:', $summ));


        fclose($fp);

    }

    function saveAsXls($type){

        $xls = new PHPExcel();
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $sheet->setTitle('Счёт №'.$this->inv_id);

        $sheet->setCellValueByColumnAndRow(1,2,'Счёт №');
        $sheet->setCellValueByColumnAndRow(2,2,$this->inv_id);

        $sheet->setCellValueByColumnAndRow(1,3,'Дата открытия:');
        $sheet->setCellValueByColumnAndRow(2,3,date('d.m.Y',$this->start_date));

        $sheet->setCellValueByColumnAndRow(1,4,'Дата закрытия:');
        $sheet->setCellValueByColumnAndRow(2,4,date('d.m.Y',$this->end_date));

        $sheet->setCellValueByColumnAndRow(1,5,'Покупатель:');
        $sheet->setCellValueByColumnAndRow(2,5,$this->client);

        $sheet->setCellValueByColumnAndRow(1,7,'Услуги:');

        $sheet->setCellValueByColumnAndRow(0,8,'№:');
        $sheet->setCellValueByColumnAndRow(1,8,'Наименование');
        $sheet->setCellValueByColumnAndRow(2,8,'Количество');
        $sheet->setCellValueByColumnAndRow(3,8,'Цена');
        $sheet->setCellValueByColumnAndRow(4,8,'Стоимость');

        $services = CurBissService::getAllByInvId($this->inv_id);
        $summ = 0;

        for($i = 0; $i < count($services); $i++){

            $row = $i+8+1;

            $sheet->setCellValueByColumnAndRow(0,$row,$i+1);
            $sheet->setCellValueByColumnAndRow(1,$row,$services[$i]->get('name'));
            $sheet->setCellValueByColumnAndRow(2,$row,$services[$i]->get('col'));
            $sheet->setCellValueByColumnAndRow(3,$row,number_format($services[$i]->get('price')/100, 2, '.', ' '));
            $sheet->setCellValueByColumnAndRow(4,$row,number_format($services[$i]->get('col')*$services[$i]->get('price')/100, 2, '.', ' '));

            $summ += $services[$i]->get('price')*$services[$i]->get('col');

        }

        $sheet->setCellValueByColumnAndRow(1,9+count($services),'Сумма:');

        // Выводим HTTP-заголовки
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=matrix.".$type);

        // Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');


    }

    function loadFromCSV($file, $company){


    }

    function loadXls($file, $company){

        // Открываем файл
        $xls = PHPExcel_IOFactory::load('xls.xls');
        // Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();

        $value = $sheet->getCellByColumnAndRow(2, 2)->getValue();
        $this->inv_id = $value;

        $sheet->setCellValueByColumnAndRow(1,3,'Дата открытия:');
        $sheet->setCellValueByColumnAndRow(2,3,date('d.m.Y',$this->start_date));

        $sheet->setCellValueByColumnAndRow(1,4,'Дата закрытия:');
        $sheet->setCellValueByColumnAndRow(2,4,date('d.m.Y',$this->end_date));

        $sheet->setCellValueByColumnAndRow(1,5,'Покупатель:');
        $sheet->setCellValueByColumnAndRow(2,5,$this->client);
    }
}