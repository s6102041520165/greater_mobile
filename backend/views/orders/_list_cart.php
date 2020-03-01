<?php

use yii\grid\GridView;

?>
<h3 class="heading">รายการสั่งซื้อในตะกร้า</h3>
<?= GridView::widget([
    'dataProvider' => $cart,
    'columns' => [
        [
            'attribute' => 'product_id',
            'value' => function ($data) {
                return $data->product['name'] . " หน่วย";
            }
        ],
        'quantity',
        //'created_at:relativeTime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}'
        ],
    ],
]) ?>