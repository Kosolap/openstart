<?php

function checkNumber($number){

    echo $number.'<br>';

    if(preg_match("/^[+]{0,1}[0-9]{1,3}[-]{0,1}[0-9]{3,6}[-]{0,1}[0-9]{0,3}".
        "[-]{0,1}[0-9]{2}[-]{0,1}[0-9]{2}$/",$number)){

        $valid = str_replace('+','',$number);


        if(strpos($valid,'-')){

            $mest = substr($valid,strpos($valid,'-'));

            $mest = str_replace('-','',$mest);


            if(strlen($mest)>10){
                getResult(0,'Много цифр во внутреннем номере');

                return 0;
            }

            else{
                getResult(1);
                return 1;
            }


        }

        else{
            $valid = str_replace('-','',$valid);

            if(strlen($valid)>13){
                getResult(0,'Слишком много цифр во всём номере');
                return 0;
            }


            else{
                getResult(1);
                return 1;
            }
        }
    }


    else{
        getResult(0,'Формат номера');
        return 0;
    }



}

function analizNumber($number){

    $number = str_replace('+','',$number);

    if(strpos($number,'-')){


        $pos =     strpos($number,'-');

        $country = substr($number, 0, $pos);

        $mest = substr($number,$pos);

        $mest = str_replace('-','',$mest);


    }

    else{

        $mest = substr($number, -10);
        $country = substr($number, 0, strpos($number,$mest));

    }


    echo '<br> Код страны : '.$country.'<br> Внутризоновой номер : '.$mest;


}

function getResult($result, $problem){

    if($result){
        echo '<text style="color: green"><b>Хороший</b></text>';
    }

    else{
        echo '<text style="color: red"><b>Плохой</b><br/></text>'.$problem;
    }
}

function getview($view, $param=''){

    include 'views/'.$view.'.php';

}

