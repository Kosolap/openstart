$(document).ready(function(){

    $('html').keydown(function(eventObject){ //отлавливаем нажатие клавиш
        if (event.keyCode == 13) { //если нажали Enter, то true
            checkClient();
            return false;
        }
    });


});


function checkClient() {

    var val = false;

    var client = $('#client').val();

    var OrderIdReg = new RegExp("^[\+a-zA-Zа-яА-Я0-9 \"\']+$");


    if (OrderIdReg.test(client)) {

        $.ajax({
            url: '../day5/',
            data: {'client': client},
            success: function (data) {


                if (data == 'ok') {
                    $('#client_info').text('Организации с таким наименованием нет!');
                    val = false;
                }

                else
                {
                    val = true;
                }

            },
            async: false
        });


    }
    else {
        $('#client_info').text('Неправильный формат имени!');
        val = false;

    }



    if(val){
        $('#client_form').submit();
    }
}
