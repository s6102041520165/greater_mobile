<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
?>
<div class="panel panel-default" style="margin: 10px 0px;padding:5px;">
    <?php $image = explode(",", $model->picture); ?>
    <div class="panel-body text-center">
        <img class="img-thumbnail rounded" src="<?= Yii::getAlias('@web/../../image/') . $image[0]; ?>" alt="">


        <h3><?= $model->name; ?></h3>
        <p><?= number_format($model->price) ?> บาท</p>
        <?php
        $isBuy = ($model->stock > 0) ? "btn btn-primary" : "btn btn-primary disabled";
        ?>
        <footer class="blockquote-footer">คงเหลือ : <cite title="Source Title"><?= $model->stock ?></cite></footer>
        <?= Html::a(FA::icon('shopping-cart') . ' หยิบใส่ตะกร้า', ['product/cart', 'id' => $model->id], ['data-method' => 'post', 'class' => $isBuy]) ?>

        <?= Html::a(FA::icon('eye') . ' รายละเอียด', ['product/view', 'id' => $model->id], ['class' => 'btn btn-primary',]) ?>

    </div>
</div>