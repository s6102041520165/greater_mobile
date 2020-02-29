<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tracking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracking-form">
    <div class="panel">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'order_id')->textInput() ?>

            <?= $form->field($model, 'barcode')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>