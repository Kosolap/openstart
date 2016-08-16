<?php

//Проверка номера на соответствеие требованиям формата
function checkNumber($number){



    if(preg_match('/[-]{2}/',$number)||
       preg_match('/[^-\d\s+]{1}/',$number)){

        getResult(0,'Содержит недопустимые символы и сочетания');

        return 0;

    }

    //Международный 10+
    //Междугородний 10
    //Внутри города 4-7

    //1) Проверка длинны
    //2) Проверка формата
    //3) Проверка отдельных элементов

    $number = ltrim($number);
    $numbers = str_replace('+','',$number);
    $numbers = str_replace(' ','',$numbers);
    $numbers = str_replace('-','',$numbers);
    $size = strlen($numbers);


    if($size >= 4  && $size <= 7) $format = 'city';
    else if($size == 10) $format = 'country';
    else if($size > 10 && $size < 14) $format = 'world';
    else {
        getResult(0,'Номеров с таким количеством цифр не существует');

        return 0;
    }

    switch($format){

        case ('city'):
            $home = $number;
            break;

        case ('country'):

            if(!preg_match("/^[\d]{3,6}[-\s]{0,1}[\d]{0,3}[-\s]{0,1}[\d]{2}[-\s]{0,1}[\d]{2}/",$number)){

                getResult(0,'Неправильный формат межгородского номера!<br>'.
                            'Код города должен быть 3-6 цифр, всего номер 10 цифр!');

                return 0;
            }

            if(strpos($number,'-') && strpos($number,'-') < 8) $poz = strpos($number,'-');
            elseif(strpos($number,' ') && strpos($number,' ') < 8) $poz = strpos($number,' ');

            if(isset($poz)){
                $city = substr($number, 0 , $poz);
                $home = substr($number, $poz);
            }

            break;

        case ('world'):
            if(preg_match("/^[+]{0,1}[0-9]{1,3}[-\s]{0,1}[0-9]{3,6}[-\s]{0,1}[0-9]{0,3}".
                "[-\s]{0,1}[0-9]{2}[-\s]{0,1}[0-9]{2}$/",$number)){


                    if(strpos($number,'-') && strpos($number,'-') < 4) {$poz = strpos($number,'-');}
                    elseif(strpos($number,' ') && strpos($number,' ') < 4) {$poz = strpos($number,' ');}
                    else {$poz = strlen($number) - 10;}

                    $country = substr($number, 0 , $poz);
                    $mestny = substr($number, $poz+1);

                    $check = str_replace(' ','',$mestny);
                    $check = str_replace('-','',$check);
                    if(strlen($check) > 10){
                        echo $check;
                        getResult(0,'Слишком длинный номер внутри страны! Должен быть равен 10 цифрам.');

                        return 0;
                    }


                    if(strpos($mestny,'-') && strpos($mestny,'-') < 7){
                        $poz = strpos($mestny,'-');}
                    elseif(strpos($mestny,' ') && strpos($mestny,' ') < 7){
                        $poz = strpos($mestny,' ');}


                    if(isset($poz)){
                        $city = substr($mestny, 0 , $poz);
                        $home = substr($mestny, $poz+1);
                    }

            }

            else{
                getResult(0,'Ошибка формата');

                return 0;
            }

            break;

    }

    getResult(1);
    analizNumber($country,$city,$home);


}

//Анализ номера, получение кода страны и остальной части
function analizNumber($country='',$city='',$home=''){

    if(isset($country)) echo ' Код страны : '.$country.'<br>';
    if(isset($city)) echo ' Код города : '.$city.'<br>';
    if(isset($home)) echo ' Внутригородской номер : '.$home.'<br>';

}

//Вывод результата проверки номера
function getResult($result, $problem=''){

    if($result){
        echo '<text style="color: green"><b>Хороший</b></text><br/>';
    }

    else{
        echo '<text style="color: red"><b>Плохой</b><br/></text>'.$problem;
    }
}

//Функция для контроллера вывод отобразения
function getview($view, $param=''){

    include 'views/'.$view.'.php';

}

