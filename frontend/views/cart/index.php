<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตะกร้าสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function($data){
                    return $data->product['name']." <img src ='".Yii::getAlias('@web/../../image/').$data->product['picture']."' style='width:120px;height:auto' />";
                }
            ],
            //'created_by',
            'created_at:relativeTime',
            //'updated_by',
            //'updated_at',
            //'quantity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    <?=Html::a('ขั้นตอนถัดไป >>', ['cart/confirm'], ['class'=>'btn btn-primary float-right btn-lg'])?>

</div>