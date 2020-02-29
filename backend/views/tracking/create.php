<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tracking */

$this->title = 'เพิ่มพัสดุ';
$this->params['breadcrumbs'][] = ['label' => 'พัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
