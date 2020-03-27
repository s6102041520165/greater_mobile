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
                        'value' => function ($data) {
                            return ($data->customer != null) ? $data->customer['first_name'] . " " . $data->customer['last_name'] : "ไม่ได้ตั้ง";
                        }
                    ],
                    'created_at:relativeTime',
                    //'updated_at:relativeTime',
                    //'created_by',
                    //'updated_by',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>