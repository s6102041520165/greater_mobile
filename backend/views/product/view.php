<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
            'description',
            'price',
            [
                'attribute' => 'picture',
                'format' => ['image',['width'=>'500px']], 
                'value ' => function($data){
                    return('@web/'.$data->picture);
                }
            ],
            'stock',
            [
                'attribute' => 'created_by',
                'value' => function($data){
                    return $data->creator['username'];
                }
            ],
            'created_at:relativeTime',
            [
                'attribute' => 'updated_by',
                'value' => function($data){
                    return $data->creator['username'];
                }
            ],
            'updated_at:relativeTime',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    return $data->categories['name'];
                }
            ]
        ],
    ]) ?>

</div>
