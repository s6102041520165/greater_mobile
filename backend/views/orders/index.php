<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบสั่งซื้อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">


    <p>
        <?= Html::a(FA::icon('plus') . ' เพิ่มรายการสั่งซื้อ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="panel">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'sumtotal',
                    [
                        'label' => 'ชื่อ - สกุล',
                        'attribute' => 'customer_id',
                        'value' => 'customer.first_name'
                    ],
                    'created_at:relativeTime',
                    //'updated_at:relativeTime',
                    //'created_by',
                    //'updated_by',

                    [
                        'class' => 'yii\grid\ActionColumn',
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>