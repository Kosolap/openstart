var shortLogin = 'Cлишком короткий логин!',
    shortPass = 'Слишком короткий пароль';






function authorization(){
    valid = true;

    cleanInfo();
    checkLogin();
    checkPassword();


    if(valid == true){
        $('#authorization_form').submit();
    }
}

function checkLogin(){
    login = $('#login');

    if(login.val().length < 5) notValidField($('#login_info'), shortLogin);

}

function checkPassword(){
    if($('#pass').val().length < 3) notValidField($('#pass_info'), shortPass);

}

function notValidField(field, str) {
    valid = false;
    field.text(str);
}


function cleanInfo(){
    $("label[id*='info']").text('');
}