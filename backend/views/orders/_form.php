<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3 class="heading">เพิ่มรายการสั่งซื้อ</h3>

    <?= $form->field($model, 'barcode')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>


    <div class="form-group">
        <?= Html::submitButton(FA::icon('plus') . ' เลือกซื้อ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>