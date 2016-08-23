/**
 * Created by ln1 on 22.08.16.
 */
var userData;

$(document).ready(function(){

    $('#savebuttbox').hide();

    $.ajax({
        url: '../day8/',
        data: {'inf':userData},
        success: function(data){

            userData = $.parseJSON(data);

            if(userData['name'] != '') $('#name').text(userData['name']);
            else $('#name').text('Неизвестно');

            if(userData['birth_date'] != 0)  {
                birth_date = userData['birth_date'];

                res = ((new Date().getTime()/1000) - birth_date)/(60 * 60 * 24 * 365);

                $('#birth_date').text(Math.floor(res));
            }
            else $('#birth_date').text('Неизвестно');


            reg_date = new Date(userData['reg_date']*1000);
            $('#reg_date').text(reg_date.toString("dd.MM.yyyy"));

            if($("#last_activ").length>0) {
                last_activ = new Date(userData['last_activ']*1000);
                $('#last_activ').text(last_activ.toString("dd.MM.yyyy"));
            }
        },
        async: false
    });


    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
            'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
            'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $('#calendar').datepicker({
        showOn: 'both',
        buttonImageOnly: true,
        buttonImage: '../day8/img/edit.ico',
        changeMonth: true,
        changeYear: true,
        yearRange: '1950:2010',
        onSelect: function () {

            old = $('#birth_date').text();
            if(old.indexOf('(') != -1 && old.indexOf(')') != -1){
                old = old.substring(old.indexOf('(')+1);
                old = old.substring(0,old.indexOf(')'));
            }


            data = $('#calendar').val().split('.');

            birth = (Date.parse(data[1]+'/'+data[0]+'/'+data[2])/1000);

            userData['birth_date'] = birth;

            res = ((new Date().getTime()/1000) - birth)/(60 * 60 * 24 * 365);


            $('#birth_date').text(Math.floor(res) + ' (' + old + ')');

            $('#savebuttbox').show();
        }
    });

    if(userData['birth_date'] != 0){
        $('#calendar').datepicker( "setDate" , new Date(userData['birth_date']*1000).toString('dd.MM.yyyy') );
    }
    else $('#calendar').datepicker( "setDate" , '01.01.2001' );

    $("#dialog-form").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Ok": function() {
                    okClose();
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });


});

$('.chimg').on('click', function(e) {
    console.log('1');

    changeInfo(e.currentTarget.name);


});


function changeInfo(info){

    switch (info){
        case 'name':
            $('#popupinf').text('Имя');
            break;
        case 'age':
            $('#popupinf').text('Дата рождения');
            break;
    }

    $('#txt2').attr("placeholder", $('#'+info).text());
    $('#hd').val(info);

    $('#txt2').val('');

    $("#dialog-form").dialog("open");


}
function okClose() {
    info = $('#hd').val();

    old = $('#'+info).text();
    if(old.indexOf('(') != -1 && old.indexOf(')') != -1){
        old = old.substring(old.indexOf('(')+1);
        old = old.substring(0,old.indexOf(')'));
    }

    $('#'+info).text($('#txt2').val() + ' (' + old + ')');
    $("#dialog-form").dialog("close");

    $('#savebuttbox').show();

    userData['name'] = $('#txt2').val();

    return false;
}

function saveInfo(){

    $.ajax({
        type: "POST",
        url: '../day8/',
        data: {'userData':userData},
        success: function(data){

            window.location.replace('../day8/');

            },
        async: false
    });

}

function setUser(login) {
    console.log(login);
    userData = login;
}