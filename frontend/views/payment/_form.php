<?php

use frontend\models\Orders;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $dataList = ArrayHelper::map(Orders::find()->where(['status' => 9])->all(), 'id', function ($data) {
        return str_pad($data->id, 6, 0, STR_PAD_LEFT) . " - " . $data->customer['first_name'] . " " . $data->customer['last_name'];
    }); ?>
    <?= $form->field($model, 'order_id')->widget(Select2::className(), [
        'data' => $dataList,
        'options' => ['placeholder' => 'กรุณาเลือกเลขที่ใบสั่งซื้อ'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>
    <?= $form->field($model, 'date_pay')->widget(DatePicker::classname(), [
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'เลือกวันที่ชำระเงิน'],
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'time_pay')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]) ?>

    <?= $form->field($imageFile, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึกข้อมูล', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>