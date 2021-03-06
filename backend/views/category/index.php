<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="panel">
        <div class="panel-body">
            <p>
                <?= Html::a(FA::icon('plus').' เพิ่มประเภทสินค้า', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>