<?php
$check = false;
if($_SESSION['user'] == $data['login']) $check = true;
?>

<label class="prof" >Имя</label>

<?php if($check) echo '<div class="imgdiv">'.
                        '<img src="../day8/img/edit.ico" name="name" width="20px" height="20px" class="chimg"/></div>'?>

<label class="proftext"  id="name"></label>

<br/><br/>

<label class="prof">Возраст</label>
<?php if($check) echo '<div class="imgdiv"><input type="hidden" id="calendar"></div>'; ?>

<label class="proftext"  name="birth_date" id="birth_date"></label>

<br/><br/>

<label class="prof">Дата регистрации</label>
<label class="proftext"  name="reg_date" id="reg_date"></label>

<br/><br/>


<?php
if(!$check)
{
    echo '<label class="prof">Последняя активность</label>';
    echo '<label class="proftext"  name="last_activ" id="last_activ">';


    echo '<br/><br/>';

}
?>
<br/>
<br/>

<div id="dialog-form" style="display:none;">
    <form onsubmit="return okClose();">
        <label id="popupinf" id="dialque">Name</label><br/>
        <input type="hidden" id="hd" />
        <input type="text" name="name" id="txt2" class="text ui-widget-content ui-corner-all" />
    </form>
</div>

<?php if($check) echo '<div id="savebuttbox"><button onclick="saveInfo()">Сохранить</button></div>';?>

<script src="../day8/js/date.js"></script>