var shortLogin = 'Cлишком короткий логин!',
    shortPass = 'Слишком короткий пароль',
    notEqualPass = 'Пароли не совпадают!',
    notUniqueLogin = 'Пользователь с таким именем уже зарегестрирован!';
    wrongChars = 'Допустимы только буквы и цифры';


var Reg = new RegExp("^[a-zA-Z0-9]+$");


$(document).ready(function(){

    document.onkeyup = function (e) {

        e = e || window.event;

        if (e.keyCode === 13) {

            registration();

        }


        return false;

    }


});



function registration(){
    valid = true;

    checkLogin();
    checkPassword();


    if(valid == true){
        $('#registration').submit();
    }
}

function checkLogin(){
    login = $('#login');


    if(!Reg.test(login.val())){

        notValidField($('#login_info'), wrongChars);
    }



    if(login.val().length < 5) {

        notValidField($('#login_info'), shortLogin);

    } else {
        $.ajax({
            url: '../day2/',
            data: {'login':login.val()},
            success: function(data){

                if(data == '0'){
                    notValidField($('#login_info'), notUniqueLogin);
                }},
            async: false
        });
    }
}

function checkPassword(){

    if(!Reg.test($('#pass').val())){

        notValidField($('#pass_info'), wrongChars);
    }


    if($('#pass').val().length < 3) notValidField($('#pass_info'), shortPass);
    else if($('#pass').val() != $('#pass_rep').val()) notValidField($('#password_rep_info'), notEqualPass);

}

function notValidField(field, str) {
    valid = false;
    field.text(str);
}


function cleanInfo(){
    $("label[id*='info']").text('');
}