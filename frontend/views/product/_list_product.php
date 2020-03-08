<?php

use yii\helpers\Html;
?>
<div class="card" style="margin: 10px 0px">
    <div class="card-header">
        <h3><?= $model->name; ?></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col text-center">
                <img class="img-thumbnail rounded" style="max-width: 200px;" src="<?= Yii::getAlias('@web/../../image/') . $model->picture; ?>" alt="">
            </div>
            <div class="col-9">
                <blockquote class="blockquote mb-0">
                    <p><?= $model->description ?></p>
                    <p><?= number_format($model->price) ?> บาท</p>
                    <footer class="blockquote-footer">คงเหลือ : <cite title="Source Title"><?= $model->stock ?></cite></footer>
                <?= Html::a('หยิบใส่ตะกร้า', ['product/cart', 'id' => $model->id], ['data-method' => 'post', 'class' => 'btn btn-primary']) ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>