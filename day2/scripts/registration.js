var emptyField = 'Заполните поле!',
    shortLogin = 'Cлишком короткий логин!',
    shortPass = 'Слишком короткий пароль',
    notEqualPass = 'Пароли не совпадают!',
    notUniqueLogin = 'Пользователь с таким именем уже зарегестрирован!';





function registration(){
    valid = true;

    cleanInfo();
    checkLogin();
    checkPassword()


    if(valid == true){
        $('#registration').submit();
    }
}

function checkLogin(){
    login = $('#login');

    if(login.val().length < 5) {

        notValidField($('#login_info'), shortLogin);

    } else {
        $.ajax({
            url: '../day2/',
            data: {'login':login.val()},
            success: function(data){

                if(data == '0'){
                    notValidField($('#login_info'), notUniqueLogin);
                    console.log(valid);
                }},
            async: false
        });
    }
}

function checkPassword(){
    if($('#pass').val().length < 3) notValidField($('#passinfo'), shortPass);
    else if($('#pass').val() != $('#re_pass').val()) notValidField($('#passconfirminfo'), notEqualPass);

}

function notValidField(field, str) {
    valid = false;
    field.text(str);
}


function cleanInfo(){
    $("label[id*='info']").text('');
}