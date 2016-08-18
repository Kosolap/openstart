<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отправка формы</title>
    <link rel="stylesheet" href="../day3/css/main.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../day3/css/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../day3/js/jquery.fancybox.pack.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

</head>
<body>


<script>
    document.write('<div class="b-container">' +
        '<button onclick="PopUpShow()">Отправить сообщение</button>'+
        '</div>')
</script>


<div id="popup">

    <form method="post" url="../day3/" onsubmit="return sendComment();" id="commentform">

        <input type="text" id="name" name="name" placeholder="Введите имя"/
        <?php
        if(isset($status)){if(!$status){
            echo ' value="'.htmlentities($_POST['name']).'"';
        }}
        ?>>
        <br/><label id="name_info" class="info"></label><br/>
        <input type="text" id="contacts" name="contacts" placeholder="Введите ваши контакты"/
        <?php
        if(isset($status)){if(!$status){
            echo ' value="'.htmlentities($_POST['contacts']).'" ';
        }}
        ?>>
        <br/><label id="contacts_info" class="info"></label><br/>
        <textarea name="comment" id="comment" form="commentform" placeholder="Введите текст сообщения"><?php
            if(isset($status)){if(!$status){
                echo htmlentities($_POST['comment']);
            }}
            ?></textarea>
        <br/><label id="comment_info" class="info"></label><br/>
        <input type="submit" class="formButton" value="Отправить сообщение"/>

        <script>
            document.write('<input type="button" class="formButton" onclick="PopUpHide()" value="Отмена"/>')
        </script>
    </form>

    <?php
    if(isset($status)){
        echo '<br/>';

        if($status){
            echo '<label id="goodmsg">Ваше сообщение успешно отправлено!</label>';

        }

        else{

            foreach ($messages as $message){
                echo '<label id="badmsg">'.$message.'</label>';
                echo '<br/>';
            }
        }
    }?>


</div>


</body>
</html>
<script language="javascript" src="../day3/js/main.js"></script>







