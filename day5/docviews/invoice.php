<!doctype html>
<html>
<head>
    <title>Бланк "Счет на оплату"</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body { width: 210mm; margin-left: auto; margin-right: auto; border: 1px #efefef solid; font-size: 11pt;}

        table.invoice {border-spacing: 0; border-collapse: collapse;}
        table.invoice td{ border: 1px solid; margin: 0; padding: 0;}

        table.invoice_items { border: 1px solid; border-collapse: collapse;}
        table.invoice_items td, table.invoice_items th { border: 1px solid;}

        tr{
            display: none;
        }

    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td>&nbsp;</td>
        <td style="width: 155mm;">
            <div style="width:155mm; ">Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате  обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div style="text-align:center;  font-weight:bold;">
                Образец заполнения платежного поручения                                                                                                                                            </div>
        </td>
    </tr>
</table>


<table width="500" cellpadding="2" cellspacing="2" class="invoice">
    <tr>
        <td colspan="2" rowspan="2">
            Северо-Западный Банк ПАО Сбербанк г.Санкт-Петербург<br/>
            Банк получателя

        </td>
        <td style="min-height:7mm;height:auto; width: 25mm;">
            <div>БИK</div>
        </td>
        <td rowspan="2" style="vertical-align: top; width: 60mm;">
            <div style=" height: 7mm; line-height: 7mm; vertical-align: middle;">044030653</div>
            <div>30101810500000000653</div>
        </td>
    </tr>
    <tr>
        <td style="width: 25mm;">
            <div>Сч. №</div>
        </td>
    </tr>
    <tr>
        <td style="min-height:6mm; height:auto; width: 50mm;">
            <div>ИНН 7816317679</div>
        </td>
        <td style="min-height:6mm; height:auto; width: 55mm;">
            <div>КПП 781601001</div>
        </td>
        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 25mm;">
            <div>Сч. №</div>
        </td>
        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 60mm;">
            <div>40702810755160006505</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="min-height:13mm; height:auto;">
            ООО "Компания "Продавец"<br/>
            Получатель
        </td>
    </tr>
</table>
<br/>

<div style="font-weight: bold; font-size: 16pt; padding-left:5px;">
    Счет № <?php echo $data['order']->get('inv_id')?> от <?php echo date('d.m.Y',$data['order']->get('start_date'))?></div>
<br/>

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


<table class="invoice_items" width="700" cellpadding="2" cellspacing="2">
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

<div>Руководитель     Иванов И.И. <img src="../day5/img/Podp.png" width="150"/> </div>
<br/>

<div>Главный бухгалтер Петров П.П. <img src="../day5/img/Podp.png" width="150"/></div>
<br/>

<div style="width: 85mm;text-align:center;"><img src="../day5/img/Pech.png" width="180"/> М.П.</div>
<br/>


<div style="width:800px;text-align:left;font-size:10pt;">Счет действителен к оплате в течении трех дней.</div>

</body>
</html>