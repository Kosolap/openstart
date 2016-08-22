
<div class="container-fluid">

    <ol class="rounded">

        <?php

        for($i = 0; $i < count($data); $i++){

            $order = $data[$i];

            echo '<li> Счёт №'.$order->get('inv_id').' от '.date('d.m.Y',$order->get('start_date')).'. Дата исполнения '
                        .date('d.m.Y',$order->get('end_date')).' <a href="?printB='.$order->get('inv_id').'">Счёт</a>   <a href="?printA='.$order->get('inv_id').'">Акт</a>'
                        .'<button onclick="saveformOpen('.$order->get('inv_id').')">Сохранить</button></li>';
        }

        ?>

    </ol>


    <div id="savepopup">

        <select name="type" form="saveform">

            <option value="xls">xls</option>
            <option value="xlsx">xlsx</option>
            <option value="csv">csv</option>

        </select>

        <form name="saveform" id="saveform">
            <input type="hidden" name="idW" id="idW" value=""/>
            <input type="submit" value="Сохранить"/>
        </form>

        <button onclick="saveformClose()">Отмена</button>

    </div>

    <div id="loadpopup">

        <form name="loadform">
            <input type="file" name="fileToUpload" value="Выберете файл"/>
            <input type="hidden" name="loadinfo"/>
            <input type="submit" value="Загрузить"/>
        </form>

        <button onclick="loadformClose()">Отмена</button>

    </div>


    <a class="singllink" href="/day5">На главную страницу</a><button onclick="loadformOpen()">Загрузить</button>



</div>