<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>Title</title>
</head>
<body>

<?php

if(checkNumber($param)) analizNumber($param);

?>

<br/>
<br/>


<form method="post">


        <input name="number" placeholder="Введите номер" value="<?php echo  $_POST['number'];?>"/>


        <input type="submit" value="Отправить">


</form>

</body>
</html>