<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отправка формы</title>
    <link rel="stylesheet" href="css/main.css"/>
    <script src="../day8/js/main.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../day8/css/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../day7/js/jquery.fancybox.pack.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>


</head>
<body>


<table>
    <tr>
        <td>
            <noscript>
                У вас отключены скрипты!<br/>
                Без них вы не сможете зарегистрироваться или авторизоваться!
            </noscript>
        </td>
        <td>
            <h1>
                Здравствуй
                <?php if($_SESSION['user'] == 'Anon'){?>
                    Аноним
                <?php }
                else{ echo $_SESSION['user']; }?>

            </h1>
        </td>
        <td>
            <?php if($title == 'registration'){?>
                <a href="../day2">Главная</a>
            <?php }
            else{
                if($_SESSION['user'] != 'Anon'){?>
                    <a href="../day2?action=logout">Разлогиниться</a>
                <?php }else{ ?>
                    <a href="?reg">Регистрация</a>
                <?php }}?>


        </td>
    </tr>

    <tr>
        <td></td>
        <td>

            <div class="container">
                <div id="container-content">

                    <?php include $url; ?>

                </div>
            </div>

        </td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>

</table>


</body>
</html>
<script src="../day8/js/<?php if(isset($data['page'])) echo $data['page']; else echo 'main';?>.js"></script>