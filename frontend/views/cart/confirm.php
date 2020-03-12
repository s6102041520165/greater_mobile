<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
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



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->product['name'] . " <img src ='" . Yii::getAlias('@web/../../image/') . $data->product['picture'] . "' style='width:120px;height:auto' />";
                }
            ],
            //'created_by',
            'created_at:relativeTime',
            //'updated_by',
            //'updated_at',
            [
                'attribute' => 'quantity',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->quantity;
                }
            ],

            /*[
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],*/
        ],
    ]); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            ข้อมูลลูกค้า
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-lg-6">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'amphoe')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-lg-12">
                    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="text-center">
                            <?= Html::submitButton(FA::icon('shopping-cart').' ยืนยันการสั่งซื้อ', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>