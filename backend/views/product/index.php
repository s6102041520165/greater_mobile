<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <p>
        <?= Html::a(FA::icon('plus') . ' เพิ่มสินค้า', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel">
        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    [
                        'attribute' => 'price',
                        'value' => function ($data) {
                            return Yii::$app->formatter->asCurrency($data->price, 'THB');
                        }
                    ],
                    //'barcode',
                    [
                        'attribute' => 'picture',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $image = explode(",",$data->picture);
                            return '<img src="' . Yii::getAlias('@web/../../image/') . $image[0] . '" width="250" /> ';
                        }
                    ],
                    //'stock',
                    [
                        'attribute' => 'created_by',
                        'value' => function($data){
                            return $data->creator['username'];
                        }
                    ],
                    //'created_at',
                    //'updated_by',
                    //'updated_at',
                    //'category_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>