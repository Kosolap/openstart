<?php

if($_SESSION['user'] == 'Anon'){ ?>


<form method="post" id="authorization_form">


    <input type="text"  id='login' name="login" placeholder="Введите логин"/>
    <br/> <label id="login_info"></label>
    <br/>

    <input type="password" id='pass' name="password" placeholder="Введите пароль"/>
    <br/> <label id="password_info"></label>
    <br/>

    <input type="button" onclick="authorization()" value="Авторизоваться"/>


</form>

<?php }?>

<?php

if($_SESSION['message'] == 'error'){ ?>

<h1> Были введены неправельные данные! </h1>

<?php }?>
