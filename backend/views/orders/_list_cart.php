<?php

use yii\bootstrap\Html;
use yii\grid\GridView;

?>
<h3 class="heading">รายการสั่งซื้อในตะกร้า</h3>
<?= GridView::widget([
    'dataProvider' => $cart,
    'columns' => [
        [
            'attribute' => 'product_id',
            'value' => function ($data) {
                return $data->product['name'];
            }
        ],
        [
            'attribute' => 'quantity',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::beginForm(['orders/update', 'id' => $data->id], 'post', ['enctype' => 'multipart/form-data']) .
                    Html::activeInput('text', $data, 'quantity', ['class' => 'form-control', 'style' => 'max-width:80px;text-align:right']) .
                    Html::error($data, 'quantity') .
                    Html::endForm();
            }
        ],
        //'created_at:relativeTime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url = ['/orders/order-delete', 'id' => $model->id]);
                }
            ]
        ],
    ],
]) ?>
<?php if (($cart->getModels()) != null) : ?>
    <div class="pull-right">
        <?= Html::a('ยืนยันการสั่งซื้อ', ['checkout'], ['data-method' => 'post', 'class' => 'btn btn-primary']) ?>
    </div>
<?php endif;  ?>