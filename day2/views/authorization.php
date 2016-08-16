<?php

if($_SESSION['user'] == 'Anon'){ ?>


<form method="post" id="authorization_form">


    <input type="text"  id='login' name="login" placeholder="Введите логин"/>
    <br/> <label id="login_info"></label>
    <br/>

    <input type="password" id='pass' name="password" placeholder="Введите пароль"/>
    <br/> <label id="password_info"></label>
    <br/>
    <label id="memorybox">Запомнить<input type="checkbox" name="remember" /></label>

    <input type="button" onclick="authorization()" value="Авторизоваться"/>


</form>

<?php }?>


