<form method="post" id="registration" onsubmit="return registration();">


    <input type="text" id='login' name="login" placeholder="Введите логин"/>
    <br/> <label id="login_info"></label>
    <br/>

    <input type="password" id='pass' name="password" placeholder="Введите пароль"/>
    <br/> <label id="password_info"></label>
    <br/>

    <input type="password" id='pass_rep' name="password_rep" placeholder="Повторите пароль"/>
    <br/> <label id="password_rep_info"></label>
    <br/>

    <input type="button" onclick="registration()" value="Зарегистрироваться"/>


</form>