<?php

use frontend\models\OrderDetail;
use frontend\models\Orders;
use frontend\models\Payment;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'รายละเอียดใบสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">
    <div class="panel panel-default">
        <div class="panel-body">
            <p>
                <?= Html::a(FA::icon('trash').' ลบ', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'คุณต้องการลบรายการนี้ใช่หรือไม่?',
                        'method' => 'post',
                    ],
                ]) ?>

                <?php if (isset($model->status) && $model->status === 9) : ?>
                    <?= Html::a(FA::icon('accept').' ยืนยัน', ['active', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => 'คุณต้องการยืนยันการสั่งซื้อรายการนี้ใช่หรือไม่?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>

                <?php if (isset($model->status) && $model->status === 10) : ?>
                    <?= Html::a(FA::icon('undo').' ยกเลิก', ['inactive', 'id' => $model->id], [
                        'class' => 'btn btn-warning',
                        'data' => [
                            'confirm' => 'คุณต้องการยกเลิกการสั่งซื้อรายการนี้ใช่หรือไม่?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>

                <?php /*echo Html::a(FA::icon('print').' พิมพ์ใบกำกับภาษี', ['receipt', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'target' => '_blank',
                ]) */?>
            </p>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>รายละเอียดใบสั่งซื้อ <?= str_pad($model->id, 6, 0, STR_PAD_LEFT); ?></h1>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'sumtotal',
                    [
                        'attribute' => 'customer_id',
                        'value' => function ($data) {
                            return $data->customer['first_name'] . " " . $data->customer['last_name'];
                        }
                    ],
                    'created_at:relativeTime',
                    'updated_at:relativeTime',
                    //'created_by',
                    //'updated_by',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($data) {
                            if ($data->status === 9) {
                                return "<span class=\"badge\" style=\"background-color: red\">ยังไม่ได้ยืนยัน</span>";
                            } else {
                                return "<span class=\"badge\" style=\"background-color: blue\">ยืนยันแล้ว</span>";
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <?php
            $dataProvider = new ActiveDataProvider([
                'query' => OrderDetail::find()->where(['orders_id' => $model->id]),
            ]);

            $total = Orders::findOne(['id' => $model->id]);
            echo "<h1>รายการสินค้าที่สั่งซื้อ</h1>";
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'showFooter' => TRUE,
                'footerRowOptions' => ['style' => 'font-weight:bold;text-align:right'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'product_id',
                        'value' => function ($data) {
                            return $data->product['name'];
                        }
                    ],
                    [
                        'attribute' => 'quantity',
                        'value' => function ($data) {
                            return $data->quantity;
                        },
                    ],
                    [
                        'attribute' => 'product.price',
                        'contentOptions' => ['style' => 'width: 10%;text-align:right'],
                        'value' => function ($data) {

                            // show the amount in money format => 50,000.00
                            return number_format($data->product['price'] * $data->quantity, 2);
                        },
                        'filter' => false, //disable the filter for this field
                        // I create the summary function in my Invoice model
                        'footer' => number_format($total->sumtotal, 2),
                    ],
                ],
                /**/

            ]);
            echo "</div></div><div class=\"panel panel-default\">
            <div class=\"panel-body\">";

            $paymentProvider = new ActiveDataProvider([
                'query' => Payment::find()->where(['order_id' => $model->id]),
            ]);

            echo "<h1>หลักฐานชำระเงิน</h1>";

            echo GridView::widget([
                'dataProvider' => $paymentProvider,
                'columns' => [

                    //'id',
                    'bank',
                    'location',
                    'amount',
                    'date_pay:date',
                    'time_pay',
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return ($data->status === 9) ? "รอดำเนินการ" : "ชำระเงินแล้ว";
                        }
                    ],
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return "<a target='_blank' href='" . Yii::getAlias('@web/../../image/') . $data->image . "'><img src='" . Yii::getAlias('@web/../../image/') . $data->image . "' style='width:250px;height:auto' class='thumbnail' /></a>";
                        }
                    ],

                ],

            ]);
            ?>
        </div>
    </div>

</div>