<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tracking */

$this->title = 'เพิ่มพัสดุ';
$this->params['breadcrumbs'][] = ['label' => 'พัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracking-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
