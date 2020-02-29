<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tracking */

$this->title = 'Update Tracking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'พัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tracking-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
