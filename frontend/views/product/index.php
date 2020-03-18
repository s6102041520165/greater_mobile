<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

$this->title = 'สินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <div class="container">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row'],
            'itemOptions' => ['class' => 'col-lg-3 col-md-4 col-xl-3 col-sm-6 col-xs-12'],
            'itemView' => '_list_product',
        ]); ?>
    </div>
</p>