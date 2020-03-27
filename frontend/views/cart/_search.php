<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

        <div class="col-lg-12">
            <?= $form->field($model, 'product_id') ?>
        </div>

        <?php // echo $form->field($model, 'updated_at') 
        ?>

        <?php // echo $form->field($model, 'quantity') 
        ?>
        <div class="col-lg-12">

            <div class="form-group">
                <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('เคลียร์', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>