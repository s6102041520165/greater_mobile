<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">
    <div class="panel">
        <div class="panel-body">
            <p>
                <?= Html::a(FA::icon('edit').' แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(FA::icon('trash').' ลบ', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        </div>
    </div>

</div>