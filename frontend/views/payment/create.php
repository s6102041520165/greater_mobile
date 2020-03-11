<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payment */

$this->title = 'แจ้งชำระเงิน';
$this->params['breadcrumbs'][] = ['label' => 'แจ้งชำระเงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
