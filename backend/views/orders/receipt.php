<?php

use backend\models\Customer;
use backend\models\OrderDetail;
use yii\helpers\ArrayHelper;
use yii\web\View;

$this->title = 'ใบกำกับภาษี';
?>

<div class="orders-receipt">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div>
                        <h2 class="name" style="font-family:thsarabun;">

                            <?= Yii::$app->name ?>

                        </h2>
                        <div style="font-family:thsarabun; font-size:14pt; ">ที่อยู่</div>
                        <div style="font-family:thsarabun; font-size:14pt; ">เบอร์โทร</div>
                        <div style="font-family:thsarabun; font-size:14pt; ">อีเมล</div>
                    </div>
                </div>
            </header>
            <main>
                <?php
                $customer = Customer::findOne(['id' => $model->customer_id]);
                ?>
                <div class="row contacts" style="text-align: right">
                    <div class="col invoice-to">
                        <div class="text-gray-light" style="font-family:thsarabun; font-size:16pt">ออกใบกำกับภาษีให้กับ:</div>
                        <h2 class="to" style="font-family:thsarabun; "><?= $model->customer['first_name'] . " " . $model->customer['last_name'] ?></h2>
                        <div class="address" style="font-family:thsarabun; font-size:14pt; ">ตำบล <?= $model->customer['district'] ?> อำเภอ <?= $model->customer['amphoe'] ?> จังหวัด <?= $model->customer['province'] ?> รหัสไปรษณีย์ <?= $model->customer['zipcode'] ?></div>
                        <div class="email" style="font-family:thsarabun; font-size:14pt; "><a href="mailto:john@example.com"><?= $customer->user['email'] ?></a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id" style="font-family:thsarabun; ">เลขที่ใบกับกำภาษี : <?= str_pad($model->id, 6, 0, STR_PAD_LEFT) ?></h1>
                        <div style="font-family:thsarabun; font-size:14pt; ">วันที่ออกใบเสร็จ : <?= Yii::$app->formatter->asDatetime($model->created_at) ?></div>
                    </div>
                </div>
                <?php
                $orderDetail = OrderDetail::find()->where(['orders_id' => $model->id])->all();
                ?>
                <table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
                    <thead>
                        <tr style="background-color:steelblue; color:whitesmoke">
                            <th style="font-family:thsarabun; font-size:16pt; border:0.5px solid black; color: white">#</th>
                            <th style="font-family:thsarabun; font-size:16pt; border:0.5px solid black; color: white" class="text-left">รายการสินค้า</th>
                            <th style="font-family:thsarabun; font-size:16pt; border:0.5px solid black; color: white" class="text-right">จำนวนที่สั่งซื้อ</th>
                            <th style="font-family:thsarabun; font-size:16pt; border:0.5px solid black; color: white" class="text-right">ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                        $grandTotal = 0;
                        $sumTotal = 0;
                        foreach ($orderDetail as $data) :
                            $sumTotal = $data->product['price'] * $data->quantity;
                        ?>
                            <tr>
                                <td class="no" style="font-family:thsarabun; font-size:14pt; border:0.5px solid black"><?= $num; ?></td>
                                <td class="text-left" style="font-family:thsarabun; font-size:14pt; border:0.5px solid black">
                                    <?= $data->product['name']; ?>
                                </td>
                                <td style="font-family:thsarabun; font-size:14pt; border:0.5px solid black"><?= $data->quantity; ?></td>
                                <td style="font-family:thsarabun; font-size:14pt;text-align:right; border:0.5px solid black"><?= number_format($sumTotal, 2); ?> บาท</td>
                            </tr>
                        <?php
                            $num++;
                            $grandTotal += $sumTotal;
                        endforeach; ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="font-family:thsarabun; font-size:16pt; text-align:right; border:0.5px solid black">ราคาสุทธิ</th>
                            <td style="font-family:thsarabun; font-size:16pt;text-align:right; border:0.5px solid black"><?= $grandTotal; ?></td>
                        </tr>

                    </tfoot>
                </table>

            </main>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
    <?php

    $jsScript = <<< JS
        $('#printInvoice').click(function() {
            Popup($('.invoice')[0].outerHTML);
            
            function Popup(data) {
                window.print();
                return true;
            }
        })
    JS;
    $this->registerJs(
        $jsScript,
        View::POS_READY,
        'my-button-handler'
    );
    ?>
    <script>

    </script>
</div>