<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отправка формы</title>
    <link rel="stylesheet" href="css/main.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>
<body>




<div class="b-popup" id="popup1">
    <div class="b-popup-content">

        <label id="title">Форма оплаты заказа</label>

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>


        <form name="order" method="get"onsubmit="return giveOrder();">

            <label>Введите номер вашего заказа: </label><input class='form-text' type="text" id="orderId">

            <br/>
            <br/>
            <br/>
            <br/>

            <input class="button" type="button" value="Продолжить" onclick="giveOrder()">

        </form>


        <br/>
        <br/>

        <label id="price" class=""></label>


        <br/>
        <br/>
        <br/>
        <br/>


        <table id="payment">

            <tr>
                <td><img src="Payments/Alexnet.png" onclick="payment('alexnet')"/></td>
                <td><img src="Payments/Qiwi.png" onclick="payment('qiwi')"/></td>
                <td><img src="Payments/Sber.png" onclick="payment('sber')"/></td>
            </tr>

            <tr>
                <td><img src="Payments/Visa.png" onclick="payment('visa')"/></td>
                <td><img src="Payments/WebMoney.png" onclick="payment('webmoney')"/></td>
                <td><img src="Payments/Yandex.png" onclick="payment('yandex')"/></td>
            </tr>

            <tr>
                <td><img src="Payments/Robokassa.png" onclick="payment('robokassa')"/></td>
            </tr>

        </table>

        <br/>
        <br/>

        <label id="payment_info" class=""></label>


        <br/>
        <br/>
        <br/>
        <br/>

        <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST id="robokassa">

            <input type=hidden name=isTest value=1>

            <input type=hidden name=MrchLogin value="<?php echo $mrh_login;?>">

            <input type=hidden name=OutSum value="<?php echo $order_summ;?>" id="robSumm">

            <input type=hidden name=InvId value="<?php echo $inv_id;?>" id="robId">

            <input type=hidden name=SignatureValue value="0" id="robSign">

            <input class="button" type=submit value='Оплатить'>

        </form>


    </div>
</div>



</body>
</html>
<script language="javascript" src="js/main.js"></script>