<form method="post" id="authorization_form" onsubmit="return authorization();">


    <input type="text"  id='login' name="login" placeholder="Введите логин"/>
    <br/> <label id="login_info"></label>
    <br/>

    <input type="password" id='pass' name="password" placeholder="Введите пароль"/>
    <br/> <label id="password_info"></label>
    <br/>
    <label id="memorybox">Запомнить<input type="checkbox" name="remember" id="boxx"/></label>

    <input type="button" onclick="authorization()" value="Авторизоваться"/>


</form>