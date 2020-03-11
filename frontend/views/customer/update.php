<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = 'แก้ไขข้อมูลส่วนตัว: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => "ดูข้อมูลส่วนตัว", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูลส่วนตัว';
?>
<div class="customer-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
