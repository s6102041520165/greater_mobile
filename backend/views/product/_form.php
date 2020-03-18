<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="col-lg-12">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-12">
                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'price')->textInput() ?>
                </div>
                <?php //var_dump($imageModel) 
                ?>
                <div class="col-lg-4">
                    <?php echo $form->field($imageModel, 'imageFiles[]')->fileInput(['multiple' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'stock')->textInput() ?>
                </div>

                <?php $catg = \yii\helpers\ArrayHelper::map(\backend\models\Category::find()->all(), 'id', 'name') ?>
                <?php //print_r($catg);
                ?>
                <div class="col-lg-12">
                    <?= $form->field($model, 'category_id')->dropDownList($catg, ['prompt' => '---------- select ----------']) ?>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>