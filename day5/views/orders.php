<?php $name = $data[0]->get('client')?>

<div class="container-fluid">

    <ol class="pills">

        <?php

        for($i = 0; $i < count($data); $i++){

            $order = $data[$i];

            echo '<li><div class="liorderinfobox"> Счёт №'.$order->get('inv_id')
                .' от '.date('d.m.Y',$order->get('start_date'))
                .'. Закрыт '.date('d.m.Y',$order->get('end_date'))
                .'   </div>'
                .'   <div class="libuttonbox">'
                .'   <a class="lilink" href="?printB='.$order->get('inv_id').'">Счёт</a>'
                .'   <a class="lilink" href="?printA='.$order->get('inv_id').'">Акт</a>'
                .'   <button class="lilink" onclick="save('.$order->get('inv_id').')">Сохранить</button>'
                .'   </div></li>';
        }

        ?>

    </ol>

    <div id="popup">

        <form method="post" url="../day5/" enctype="multipart/form-data" id="filesave">

            <input type="hidden" name="clientR" value='<?php echo $name;?>'>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            <br/>
            <br/>
            <input class="lilink" type="submit" value="Загрузить" name="submit">
            <input class="lilink" type="button" class="formButton" onclick="cancel()" value="Отмена"/>

        </form>


    </div>

    <div id="savepopup" class="popup">


        <label>Выберете формат</label>    <select name="type" form="saveform">
            <option value="xls">xls</option>
            <option value="xlsx">xlsx</option>
            <option value="csv">csv</option>
        </select>
        <br/>
        <br/>
        <br/>
        <form action="../day5/" id="saveform">
            <input type="hidden" id="id" name="idW">
            <input class="lilink" type="button" onclick="savestart()" value="Сохранить">
            <input class="lilink" type="button" class="formButton" onclick="savecancel()" value="Отмена"/>
        </form>


    </div>

    <br/>
    <?php if($message != ''){
        if($message == 'good'){ ?>
        <script language="JavaScript">
            $.fancybox('<div class="resultBox success"><div class="restext">Счёт загружен!</div></div>');
        </script>

    <?php    }
        else{ ?>
            <script language="JavaScript">
            $.fancybox('<div class="resultBox fail"><div class="restext"><?php echo $message;?></div></div>');
            </script>
    <?php    }
        $message='';
    }?>
    <br/>

    <a class="lilink" href="/day5">На главную страницу</a> <button class="lilink" onclick="load()">Загрузить</button>



</div>