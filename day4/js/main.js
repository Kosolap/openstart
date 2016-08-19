$(document).ready(function(){
    //Скрыть PopUp при загрузке страницы
    $('#robokassa').hide();
    $('#payment').hide();



    document.onkeyup = function (e) {

        e = e || window.event;

        if (e.keyCode === 13) {




        }


        return false;

    }



});

var orderId;
var orderSumm;


function giveOrder(test){

    console.log($('#orderId').val());

    str = $('#price').attr('class');

    orderId = $('#orderId').val();

    orderId = orderId.trim();

    var OrderIdReg = new RegExp("^[0-9]+$");

    if(OrderIdReg.test(orderId)){

        $.ajax({
            url: '../day4/',
            data: {'id':orderId},
            success: function(data){

                if(data == ''){

                    $('#robokassa').hide();
                    $('#payment').hide();
                    $('#payment_info').hide();
                    $('#price').text('Заказа с таким номером не существует!');

                    if(str.indexOf('error') == -1) $('#price').toggleClass('error');
                    if(str.indexOf('success') != -1) $('#price').toggleClass('success');
                }
                else{
                    $('#orderId').val('');
                    $('#payment').show();
                    $('#payment_info').hide();
                    $('#price').text('Заказ №'+orderId+' cтоимость заказа: '+data+'р.');


                    if(str.indexOf('success') == -1) $('#price').toggleClass('success');
                    if(str.indexOf('error') != -1) $('#price').toggleClass('error');

                    orderSumm = data;
                }

            },
            async: false
        });




    }
    else {

        $('#price').text('Неправильный формат номера заказа');

        $('#robokassa').hide();
        $('#payment').hide();
        $('#payment_info').hide();

        if(str.indexOf('error') == -1) $('#price').toggleClass('error');
        if(str.indexOf('success') != -1) $('#price').toggleClass('success');
    }

    return false;
}


function payment(type) {
    $('#payment_info').show();

    str = $('#payment_info').attr('class');

    if(type != 'robokassa'){

        $('#robokassa').hide();

        $('#payment_info').text('Данный способ оплаты временно недоступен, пожалуйста выберете другой!')

        if(str.indexOf('error') == -1) $('#payment_info').toggleClass('error');
        if(str.indexOf('success') != -1) $('#payment_info').toggleClass('success');

    }
    else {
        fillForm();

        if(str.indexOf('success') == -1) $('#payment_info').toggleClass('success');
        if(str.indexOf('error') != -1) $('#payment_info').toggleClass('error');

        $('#payment_info').text('Нажмите кнопку оплатить, для проведения оплаты!');
        $('#robokassa').show();
    }

}

function fillForm() {

    $('#robId').val(orderId);

    $('#robSumm').val(orderSumm);


    $.ajax({
        url: '../day4/',
        data: {'sign':1, 'summ':orderSumm, 'order_id':orderId},
        success: function(data){

            $('#robSign').val(data);


        },
        async: false
    });

}