<?php

use backend\models\Orders;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Tracking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracking-form">
    <div class="panel">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>
            <?php $dataList = ArrayHelper::map(Orders::find()->asArray()->all(), 'id', 'id') ?>
            <?= $form->field($model, 'order_id')->widget(Select2::className(), [
                'data' => $dataList,
                'options' => ['placeholder' => 'กรุณาเลือกเลขที่ใบสั่งซื้อ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'barcode')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>