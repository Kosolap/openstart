/**
 * Created by ln1 on 17.08.16.
 */

$(document).ready(function(){
    //Скрыть PopUp при загрузке страницы
    PopUpHide();

});
//Функция отображения PopUp
function PopUpShow(){
    $("#popup1").show();
}
//Функция скрытия PopUp
function PopUpHide(){
    $('#name').val('');
    $('#contacts').val('');
    $('#comment').val('');

    $('#name_info').text('');
    $('#contacts_info').text('');
    $('#comment_info').text('');

    $("#popup1").hide();
}

function sendComment(){

    $('#name_info').text('');
    $('#contacts_info').text('');
    $('#comment_info').text('');

    var name = $('#name').val().trim();
    var contacts = $('#contacts').val().trim();
    var comment = $('#comment').val().trim();

    var result;

    if(valid(name,contacts,comment)){

        $.ajax({
            url: '../day3/',
            data: {'name':name, 'contacts':contacts, 'comment':comment},
            success: function(data){

                if(data == 'send') {
                    result = true;

                    $('#name').val('');
                    $('#contacts').val('');
                    $('#comment').val('');
                }
                else result = false;


            },
            async: false
        });

        PopUpHide();


        if(result) {
            $.fancybox('<div class="resultBox success"><div class="restext">Письмо отправленно</div></div>');
        }
        else $.fancybox('<div class="resultBox fail"><div class="restext">Письмо не отправленно</div></div>');
    }


    return false;
}

function valid(name, contacts, comment) {

    var check = true;

    var NameReg = new RegExp("^[а-яА-Яa-zA-Z0-9]+$");



    if(name == ''){


        $('#name_info').text('Поле Имя должно быть заполнено!');
        check = false;

    }else if(!NameReg.test(name)){


        $('#name_info').text('Имя содержит недопустимые данные');
        check = false;
    }

    var CommentReg = new RegExp("^[\.,-_@?!:$ a-zA-Z0-9А-Яа-я()\\n]+$");

    if(comment == ''){


        $('#comment_info').text('Пустое сообщение!');
        check = false;

    }else if(!CommentReg.test(comment)){


        $('#comment_info').text('Сообщение содержит недопустимые данные');
        check = false;
    }

    if(contacts == ''){
        $('#contacts_info').text('Поле Е-mail должно быть заполнено!');
        check = false;
    }else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(contacts))
    {


        $('#contacts_info').text('Е-mail имеет неправильный формат');
        check = false;
    }

    return check;

}


function ValidateEmail(mail)
{

    alert("You have entered an invalid email address!")
    return (false)
}