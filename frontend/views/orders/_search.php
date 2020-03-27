<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'sumtotal') ?>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('ยกเลิก', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>



    <?php //echo $form->field($model, 'sumtotal') 
    ?>

    <?php // echo $form->field($model, 'created_by') 
    ?>

    <?php // echo $form->field($model, 'updated_by') 
    ?>

    <?php // echo $form->field($model, 'status') 
    ?>

    <?php ActiveForm::end(); ?>

</div>