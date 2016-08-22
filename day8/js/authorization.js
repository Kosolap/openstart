var shortLogin = 'Cлишком короткий логин!',
    shortPass = 'Слишком короткий пароль',
    wrongData = 'Неправильные логин или пароль!';



$(document).ready(function(){

    document.onkeyup = function (e) {

        e = e || window.event;

        if (e.keyCode === 13) {

            authorization();

        }
        // Отменяем действие браузера

        return false;

    }


});


function authorization(){
    valid = true;

    checkLogin();
    checkPassword();

    if(valid == true){
        $.ajax({
            type: "POST",
            url: '../day8/',
            data: "login="+$('#login').val()+"&password="+$('#pass').val()+"&remember="+$('#boxx').is(':checked'),
            success: function(data){

                if(data == 'good') window.location.replace('../day8/');
                else notValidField($('#password_info'), wrongData);

            },
            async: false
        });
    }

    return false;
}

function checkLogin(){
    login = $('#login');

    if(login.val().length < 5) notValidField($('#login_info'), shortLogin);

}

function checkPassword(){
    if($('#pass').val().length < 3) notValidField($('#password_info'), shortPass);

}

function notValidField(field, str) {
    valid = false;
    field.text(str);
}


function cleanInfo(){
    $("label[id*='info']").text('');
}
