<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการสั่งซื้อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
    <h1><?= $this->title; ?></h1>

    <?php Pjax::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel]);
            ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => function ($data) {
                    return str_pad($data->id, 6, 0, STR_PAD_LEFT);
                }
            ],
            [
                'attribute' => 'sumtotal',
                'format' => 'raw',
                'value' => function ($data) {
                    return "<div class='text-right'>" . number_format($data->sumtotal) . " บาท</div>";
                }
            ],
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer['first_name'] . " " . $data->customer['last_name'];
                }
            ],
            'created_at:relativeTime',
            //'updated_at:relativeTime',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data->status === 10) {
                        return "อนุมัติแล้ว";
                    } elseif ($data->status === 9) {
                        return "ยังไม่อนุมัติ";
                    }
                }
            ],
            //'created_by',
            //'updated_by',
            //'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>