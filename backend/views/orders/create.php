<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = 'เพิ่มรายการสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">


    <?php /* echo $this->render('_form', [
        'model' => $model,
    ]) */ ?>

    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $this->render('_list_cart', [
                        'cart' => $cart,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>