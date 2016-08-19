
<div class="container-fluid">

    <ol class="rounded">

        <?php

        for($i = 0; $i < count($data); $i++){

            $order = $data[$i];

            echo '<li> Счёт №'.$order->get('inv_id').' от '.date('d.m.Y',$order->get('start_date')).'. Дата исполнения '
                        .date('d.m.Y',$order->get('end_date')).' <a href="?printB='.$order->get('inv_id').'">Счёт</a>   <a href="?printA='.$order->get('inv_id').'">Акт</a> </li>';
        }

        ?>

    </ol>


    <a class="singllink" href="/day5">На главную страницу</a>



</div>