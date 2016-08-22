<!doctype html>
<html>
<head>
    <title>Счет № <?php echo $data['order']->get('inv_id')?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body { width: 210mm; margin-left: auto; margin-right: auto; border: 1px #efefef solid; font-size: 11pt;}

        table.invoice_items { border: 1px solid; border-collapse: collapse;}
        table.invoice_items td, table.invoice_items th { border: 1px solid;}

        .left{
            display: inline-block;
            float: left;
        }

        .right{
            display: inline-block;
            float: right;
            padding-right: 50px;
        }
    </style>
</head>
<body>


<div style="font-weight: bold; font-size: 16pt; padding-left:5px;">
    Акт от <?php echo date('d.m.Y',$data['order']->get('end_date'))?></div>
<br/>

<p>
    Мы, нижеподписавшиеся, представитель Исполнителя, с одной стороны и Заказчика с другой стороны, составили настоящий
    акт свидетельствующий о том, что Исполнитель выполнил, а Заказчик принял следующие работы:
</p>

<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>

<table width="100%">
    <tr>
        <td style="width: 30mm;">
            <div style=" padding-left:2px;">Поставщик:    </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;">
                ООО "Компания "Продавец"            </div>
        </td>
    </tr>
    <tr>
        <td style="width: 30mm;">
            <div style=" padding-left:2px;">Покупатель:    </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;">
                <?php echo $data['order']->get('client')?>            </div>
        </td>
    </tr>
</table>


<table class="invoice_items" width="100%" cellpadding="2" cellspacing="2">
    <thead>
    <tr>
        <th style="width:13mm;">№</th>
        <th>Товар</th>
        <th style="width:20mm;">Кол-во</th>
        <th style="width:17mm;">Ед.</th>
        <th style="width:27mm;">Цена</th>
        <th style="width:27mm;">Сумма</th>
    </tr>
    </thead>
    <tbody >
    <?php for ($i = 0; $i < count($data['cb']); $i++){
        $cb = $data['cb'][$i]; ?>
        <tr>
            <td align="center"><?php echo $i+1; ?></td>
            <td align="left"><?php echo $cb->get('name'); ?></td>
            <td align="right"><?php echo $cb->get('col'); ?></td>
            <td align="left">шт</td>
            <td align="right"><?php echo number_format($cb->get('price')/100, 2, '.', ' ');?></td>
            <td align="right"><?php $summ = $cb->get('price')*$cb->get('col');
                echo number_format($summ /100, 2, '.', ' ');?></td>
        </tr>
    <?php }?>
    </tbody>
</table>

<table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
        <td></td>
        <td style="width:27mm; font-weight:bold;  text-align:right;">Итого:</td>
        <td style="width:27mm; font-weight:bold;  text-align:right;">
            <?php $summ = 0;
            for ($i = 0; $i < count($data['cb']); $i++) {
                $cb = $data['cb'][$i];
                $summ += $cb->get('price') * $cb->get('col');
            }
            $summ = $summ/100;
            echo number_format($summ, 2, '.', ' ');?>
        </td>
    </tr>
    <td colspan="2" style="font-weight:bold;  text-align:right;">В том числе НДС:</td>
    <td style="width:27mm; font-weight:bold;  text-align:right;"><?php echo number_format($summ*0.18, 2, '.', ' ');?></td>
</table>

<br />
<div>
    Всего наименований <?php echo count($data['cb']);?> на сумму <?php echo number_format($summ + $summ*0.18, 2, '.', ' ');?> рублей.<br />
    <?php echo num2str($summ + $summ*0.18)?></div>
<br /><br />
<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>
<br/>
<p> Вышеперечисленные работы выполнены в полном объеме, с надлежащим качеством и в установленный срок.</p>
<br/>


<div class="left">>Исполнитель: <img src="../day5/img/Podp.png" width="150"/> Иванов И.И.</div>
<div class="right">Заказчик:</div>
<br/>

<div style="width: 85mm;text-align:center;"><img src="../day5/img/Pech.png" width="180"/> М.П.</div>
<br/>


</body>
</html>