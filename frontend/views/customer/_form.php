<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

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

        <div class="col-lg-6">
            <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('บันทึกข้อมูล', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>