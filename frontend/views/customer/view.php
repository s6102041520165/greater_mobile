<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = "ข้อมูลส่วนตัว : ".$model->first_name." ".$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลส่วนตัว', 'url' => ['update', 'id' => $model->id]];
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'district',
            'amphoe',
            'province',
            'zipcode',
            'telephone',
            'picture',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user['username'];
                }
            ],
        ],
    ]) ?>

</div>