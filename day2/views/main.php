<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title;?></title>
        <link href="../day2/css/main.css" rel="stylesheet"/>
        <script src="../day2/scripts/<?php echo $title;?>.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    </head>
    <body>


                <table>
                    <tr>
                        <td></td>
                        <td>
                            <h1>Здравствуй
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
                                    <a href="../day2?action=registration">Регистрация</a>
                            <?php }}?>


                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>

                            <?php
                            include $page;
                            ?>

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

