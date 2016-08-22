<?php

class Order
{
    private $id;
    private $inv_id;
    private $start_date;
    private $end_date;
    private $client;
    private $summ;

    function __construct($data=array()) {

        if(count($data)!=0){
            $this->id = $data['id'];
            $this->inv_id = $data['inv_id'];
            $this->start_date = $data['start_date'];
            $this->end_date = $data['end_date'];
            $this->client = $data['client'];
            $this->summ = $data['summ'];
        }

    }

    function get($var){
        return $this->$var;
    }

    static function init(){
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

    function saveAsXls($type){

        $xls = new PHPExcel();

        $xls->setActiveSheetIndex(0);

        $sheet = $xls->getActiveSheet();


        //Настройка ширины полей
        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(11);
        $sheet->getColumnDimension('D')->setWidth(9);
        $sheet->getColumnDimension('E')->setWidth(11);

        //Настраиваем высоту строк
        $sheet->getRowDimension(1)->setRowHeight(20);
        $sheet->getRowDimension(2)->setRowHeight(20);
        $sheet->getRowDimension(3)->setRowHeight(20);
        $sheet->getRowDimension(4)->setRowHeight(20);
        $sheet->getRowDimension(6)->setRowHeight(20);
        $sheet->getRowDimension(7)->setRowHeight(20);

        //Настройки границ
        $styleArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK
                )
            )
        );


        $styleArraySer = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );


        $sheet->setTitle('Счёт №'.$this->inv_id);

        $sheet->getStyleByColumnAndRow(1,1)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,1,'Номер счета:');

        $sheet->getStyleByColumnAndRow(2, 1)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(2,1,$this->inv_id);

        $sheet->getStyleByColumnAndRow(1,2)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,2,'Дата открытия:');

        $sheet->getStyleByColumnAndRow(2, 2)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(2,2,date('d.m.Y',$this->start_date));

        $sheet->getStyleByColumnAndRow(1,3)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,3,'Дата исполнения:');

        $sheet->getStyleByColumnAndRow(2, 3)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(2,3,date('d.m.Y',$this->end_date));

        $sheet->getStyleByColumnAndRow(1,4)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,4,'Заказчик:');

        $sheet->getStyleByColumnAndRow(2, 4)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(2,4,$this->client);

        $sheet->getStyleByColumnAndRow(1,6)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,6,'Услуги:');

        $sheet->getStyleByColumnAndRow(0, 7)->applyFromArray($styleArray);
        $sheet->setCellValueByColumnAndRow(0,7,'№');



        $sheet->getStyleByColumnAndRow(1, 7)->applyFromArray($styleArray);
        $sheet->setCellValueByColumnAndRow(1,7,'Наименование');

        $sheet->getStyleByColumnAndRow(2, 7)->applyFromArray($styleArray);
        $sheet->setCellValueByColumnAndRow(2,7,'Количество');

        $sheet->getStyleByColumnAndRow(3, 7)->applyFromArray($styleArray);
        $sheet->setCellValueByColumnAndRow(3,7,'Цена');

        $sheet->getStyleByColumnAndRow(4, 7)->applyFromArray($styleArray);
        $sheet->setCellValueByColumnAndRow(4,7,'Стоимость');

        $services = CurBissService::getAllByInvId($this->inv_id);
        $summ = 0;

        for($i = 0; $i < count($services);$i++){

            $z = $i+1;

            //Устанавливаем высоту строки
            $sheet->getRowDimension(7+$z)->setRowHeight(20);

            //Выравниваем текст
            $sheet->getStyleByColumnAndRow(0,7+$z)->applyFromArray($styleArraySer);
            $sheet->setCellValueByColumnAndRow(0,7+$z,$z);

            $sheet->getStyleByColumnAndRow(1,7+$z)->applyFromArray($styleArraySer);
            $sheet->setCellValueByColumnAndRow(1,7+$z,$services[$i]->get('name'));

            $sheet->getStyleByColumnAndRow(2,7+$z)->applyFromArray($styleArraySer);
            $sheet->setCellValueByColumnAndRow(2,7+$z,$services[$i]->get('col'));

            $sheet->getStyleByColumnAndRow(3,7+$z)->applyFromArray($styleArraySer);
            $sheet->setCellValueByColumnAndRow(3,7+$z,number_format($services[$i]->get('price')/100, 2, '.', ' '));

            $sheet->getStyleByColumnAndRow(4,7+$z)->applyFromArray($styleArraySer);
            $sheet->setCellValueByColumnAndRow(4,7+$z,number_format($services[$i]->get('price')*$services[$i]->get('col') /100, 2, '.', ' '));

            $summ += $services[$i]->get('price')*$services[$i]->get('col')/100;

        }

        //Устанавливаем высоту строки
        $sheet->getRowDimension(7+count($services)+1)->setRowHeight(20);

        $sheet->getStyleByColumnAndRow(1,7+count($services)+1)->getFont()->setBold(true);
        $sheet->setCellValueByColumnAndRow(1,7+count($services)+1,'Общая сумма:');

        $sheet->getStyleByColumnAndRow(2, 7+count($services)+1)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(2,7+count($services)+1,$summ);


        // Выводим HTTP-заголовки
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=bill.".$type);

        // Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel2007($xls);
        $objWriter->save('php://output');
    }
    function saveAsCSV(){

        $file = "php://output";
        $list = array (
            array('','Номер счета:',$this->inv_id),
            array('', 'Дата открытия:', date('d.m.Y',$this->start_date)),
            array('', 'Дата закрытия:', date('d.m.Y',$this->end_date)),
            array('', 'Заказчик:', $this->client),
            array('', '',''),
            array('', 'Услуги:',''),
            array('№', 'Наименование','Количество','Цена','Стоимость')
        );

        $services = CurBissService::getAllByInvId($this->inv_id);
        $summ = 0;

        for($i = 0; $i < count($services);$i++){

            array_push($list,array($i+1,
                $services[$i]->get('name'),
                $services[$i]->get('col'),
                number_format($services[$i]->get('price')/100, 2, '.', ' '),
                number_format($services[$i]->get('price')*$services[$i]->get('col') /100, 2, '.', ' ')));

            $summ += $services[$i]->get('price')*$services[$i]->get('col')/100;

        }

        array_push($list,array('','Общая сумма:',$summ));


        $fp = fopen($file, 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        header ("Content-Type: application/octet-stream");
        header ("Accept-Ranges: bytes");
        header ("Content-Disposition: attachment; filename= order.csv");
    }

    function loadFromCSV($file,$company){

        $handle = fopen($file, "r");
        $val = fgetcsv($handle, 1000, ",")[2];
        if(!preg_match('/^[0-9]+$/',$val)){
            if($val == '') return 'Не заполнен номер счёта (С:1)';
            else return 'Неправильный формат номера счёта (C:1)';
        }
        $this->inv_id = $val;


        $val = fgetcsv($handle, 1000, ",")[2];
        if(!preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/',$val)){
            if($val == '') return 'Не заполнена дата открытия счёта (С:2)';
            else return 'Неправильный формат даты(Правильный: дд.мм.гггг) (C:2)';
        }
        $date_elements  = explode(".",$val);
        $this->start_date = mktime(0,0,0,$date_elements[1],$date_elements[0],$date_elements[2]);

        $val = fgetcsv($handle, 1000, ",")[2];
        if($val == ''){

        }
        elseif (!preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/',$val)){
            return 'Неправильный формат даты(Правильный: дд.мм.гггг) (C:3)';
        }
        $date_elements  = explode(".",$val);
        $this->end_date = mktime(0,0,0,$date_elements[1],$date_elements[0],$date_elements[2])+76356;

        $val = fgetcsv($handle, 1000, ",")[2];
        if($val == ''){
            return 'Не заполнено наименование заказчика (С:4)';
        }
        elseif ($val != $company){
            return 'Не верное наименование заказчика (С:4)';
        }
        $this->client = $val;

        $row = fgetcsv($handle, 1000, ",");
        $row = fgetcsv($handle, 1000, ",");
        $row = fgetcsv($handle, 1000, ",");

        //Считываем услуги
        $services = array();
        $check = true;
        $row = fgetcsv($handle, 1000, ",");

        while ($check){
            $data = array();


            if($row[1] == ''){
                return 'Не заполнено наименование услуги';
            }
            $data['name'] = $row[1];

            if(!preg_match('/^[0-9]+$/',$row[2])){
                if($row[2] == '') return 'Не заполнено количество услуг';
                else return 'Неправильный формат количество услуг';
            }
            $data['col'] = $row[2];

            if(!preg_match('/^[0-9]+[\.]{0,1}[0-9]{0,2}$/',$row[3])){
                if($row[3] == '') return 'Не заполнено количество услуг';
                else return 'Неправильный формат цены услуги';
            }
            $data['price'] = $row[3]*100;

            $data['order_id'] = $this->inv_id;

            array_push($services, new CurBiss($data));

            $row = fgetcsv($handle, 1000, ",");
            if($row[1]=='Общая сумма:') $check = false;
        }

        fclose($handle);

        OrderService::save($this);
        CurBissService::save($services);

        return 'good';
    }
    function loadFromXls($file, $company){

        $objPHPExcel = PHPExcel_IOFactory::load($file);

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

            //Считываем номер счёта
            $cell = $worksheet->getCellByColumnAndRow(2, 1);
            if(!preg_match('/^[0-9]+$/',$cell->getValue())){
                if($cell->getValue() == '') return 'Не заполнен номер счёта (С:1)';
                else return 'Неправильный формат номера счёта (C:1)';
            }
            $this->inv_id = $cell->getValue();

            //Считываем дату открытия
            $cell = $worksheet->getCellByColumnAndRow(2, 2);
            if(!preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/',$cell->getValue())){
                if($cell->getValue() == '') return 'Не заполнена дата открытия счёта (С:2)';
                else return 'Неправильный формат даты(Правильный: дд.мм.гггг) (C:2)';
            }
            $val = $cell->getValue();
            $date_elements  = explode(".",$val);
            $this->start_date = mktime(0,0,0,$date_elements[1],$date_elements[0],$date_elements[2]);

            //Считываем дату закрытия
            $cell = $worksheet->getCellByColumnAndRow(2, 3);
            if($cell->getValue() == ''){

            }
            elseif (!preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/',$cell->getValue())){
                return 'Неправильный формат даты(Правильный: дд.мм.гггг) (C:3)';
            }
            $val = $cell->getValue();
            $date_elements  = explode(".",$val);
            $this->end_date = mktime(0,0,0,$date_elements[1],$date_elements[0],$date_elements[2])+76356;

            //Считываем наименование заказчика
            $cell = $worksheet->getCellByColumnAndRow(2, 4);
            if($cell->getValue() == ''){
                return 'Не заполнено наименование заказчика (С:4)';
            }
            elseif ($cell->getValue() != $company){
                return 'Не верное наименование заказчика (С:4)';
            }

            $this->client = $cell->getValue();


            //Считываем услуги
            $services = array();
            $service_row = 8;
            $check = true;

            while ($check){
                $data = array();

                //Заносим наименование
                $cell = $worksheet->getCellByColumnAndRow(1, $service_row);
                if($cell->getValue() == ''){
                    return 'Не заполнено наименование услуги (B:'.$service_row.')';
                }
                $data['name'] = $cell->getValue();

                //Заносим количество
                $cell = $worksheet->getCellByColumnAndRow(2, $service_row);
                if(!preg_match('/^[0-9]+$/',$cell->getValue())){
                    if($cell->getValue() == '') return 'Не заполнено количество услуг (С:'.$service_row.')';
                    else return 'Неправильный формат количество услуг (C:'.$service_row.')';
                }
                $data['col'] = $cell->getValue();

                //Заносим цену
                $cell = $worksheet->getCellByColumnAndRow(3, $service_row);
                if(!preg_match('/^[0-9]+[\.]{0,1}[0-9]{0,2}$/',$cell->getValue())){
                    if($cell->getValue() == '') return 'Не заполнено количество услуг (D:'.$service_row.')';
                    else return 'Неправильный формат цены услуги (D:'.$service_row.')';
                }
                $data['price'] = $cell->getValue()*100;

                //Заносим номер счёта
                $cell = $worksheet->getCellByColumnAndRow(2, 1);
                $data['order_id'] = $cell->getValue();

                array_push($services, new CurBiss($data));

                $cell = $worksheet->getCellByColumnAndRow(1, $service_row+1);
                $val = $cell->getValue();
                if($val == 'Общая сумма:') $check = false;
                else $service_row++;
            }

            OrderService::save($this);
            CurBissService::save($services);

        }

        return 'good';
    }
    function toString(){
        echo $this->inv_id.' '.$this->client.' '.date('d.m.Y',$this->start_date).' '.date('d.m.Y',$this->end_date);
    }
}
