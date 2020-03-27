<?php

use backend\models\Customer;
use backend\models\OrderDetail;
use backend\models\Orders;
use frontend\models\Payment;
use yii\helpers\ArrayHelper;
use yii\web\View;

$this->title = 'ใบกำกับภาษี';
?>

<div class="orders-receipt">
    <div style="text-align: center">
        <h1 style="font-family:thsarabun">รายงานยอดขายประจำเดือน</h1>
    </div>

    <?php
    $orderList = Orders::find()->select(['SUM(sumtotal) as sumsale', 'created_at'])
        ->where(['status' => 10])
        //->andWhere(['=', "DATE_FORMAT(CURRENT_TIMESTAMP(),'%Y-%m')", "FROM_UNIXTIME(created_at,'%Y-%m')"])
        ->groupBy(["FROM_UNIXTIME(created_at,'%Y-%m-%d')"])
        ->all();
    //var_dump($orderList);

    ?>
    <table class="table">
        <thead>
            <tr>
                <th style="font-family: thsarabun; font-size:16pt">#</th>
                <th style="font-family: thsarabun; font-size:16pt">วันที่สั่งซื้อ</th>
                <th style="font-family: thsarabun; font-size:16pt; text-align:right">ยอดเงินรวมทั้งสิ้น</th>
            </tr>
        </thead>
        <tbody>
            <?php $number = 1;
            $grandTotal = 0;
            foreach ($orderList as $model) : ?>
                <tr>
                    <td scope="row" style="font-family: thsarabun; font-size:16pt"><?= $number ?></td>
                    <td style="font-family: thsarabun; font-size:16pt;"><?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></td>
                    <td style="font-family: thsarabun; font-size:16pt; text-align:right"><?= $model->sumsale ?></td>
                </tr>
            <?php $number++;
            $grandTotal += $model->sumsale;
            endforeach; ?>
            <tr>
                <th style="font-family: thsarabun; font-size:16pt;text-align:right" colspan="2">ยอดเงินที่ขายได้</th>
                <th style="font-family: thsarabun; font-size:16pt;text-align:right"><?= number_format($grandTotal) ?></th>
            </tr>
        </tbody>
    </table>

</div>