<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Category;
use frontend\models\Customer;
use frontend\models\Product;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
?>
<?php //var_dump(Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id));die(); 
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?php $productList = Category::find()->all() ?>
    <?php
    $menuCategories = [
        '<li class="divider"></li>',
        ['label' => 'สินค้าทั้งหมด', 'url' => ['/product/index']],
        '<li class="dropdown-header">ประเภทสินค้า</li>',
    ];
    foreach ($productList as $model) {
        //if(!isset($menuCategories)) {
        array_push($menuCategories, ['label' => $model->name, 'url' => ['/product/index', 'category' => $model->id]]);
        //}
    }
    /* echo "<pre>";
    print_r($menuCategories);
    echo "</pre>";
    die(); */


    ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
                'style' => 'background-color:#9c27b0; color: #ffffff'
            ],
        ]);
        $menuItems = [
            ['label' => 'หน้าแรก', 'url' => ['/site/index']],
            [
                'label' => 'สินค้า', 'items' => $menuCategories
            ],
            ['label' => 'ติดต่อเรา', 'url' => ['/site/contact']],

        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'ลงทะเบียน', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/site/login']];
        } else {
            $customer = Customer::findOne(['user_id' => Yii::$app->user->id]);
            $isUserProfile = (empty($customer->user_id) || is_null($customer->user_id));
            $nameProfiles = ($isUserProfile) ? "ไม่มีข้อมูลส่วนตัว" : $customer->first_name . " " . $customer->last_name;
            $menuItems[] =
                [
                    'label' => 'ข้อมูลส่วนตัวของฉัน',
                    'items' => [
                        '<li class="divider"></li>',
                        "<li class=\"dropdown-header\">การสั่งซื้อของฉัน</li>",
                        ['label' => 'ตะกร้าสินค้า', 'url' => ['/cart/index'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'ประวัติการสั่งซื้อ', 'url' => ['/orders/index'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'แจ้งชำระเงิน', 'url' => ['/payment/index'], 'visible' => !Yii::$app->user->isGuest],
                        '<li class="divider"></li>',
                        "<li class=\"dropdown-header\">$nameProfiles</li>",
                        ['label' => 'เพิ่มข้อมูลส่วนตัว', 'url' => ['/customer/create'], 'visible' => $isUserProfile],
                        ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/customer/update', 'id' => (!$isUserProfile) ? $customer->id : ""], 'visible' => !$isUserProfile],
                        [
                            'label' => 'ไปที่หลังร้าน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index']), 'visible' => (!empty(Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id))
                                && ((Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id))->roleName === "admin" || (Yii::$app->authManager->getAssignment('employee', Yii::$app->user->id))->roleName === "employee"))
                        ],
                        ['label' => 'ออกจากระบบ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'],],
                    ],
                ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?php //echo Alert::widget() 
                    ?>
                    <?php $this->render('alert.php') ?>
                    <?= $content ?>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= "Version 1.0" ?></p>
        </div>
    </footer>
    <?php
    $url = Url::toRoute(['/site/check-order']);
    $js = '
    //Body function checkExpireOrder
    function checkExpireOrder(){
        $.ajax({
            method: "GET",
            url: "'.$url.'",
        })
        .done(function( msg ) {
            console.log(msg)
        });
    }
    setInterval(checkExpireOrder, 5000)

    ';

    $this->registerJs(
        $js,
        View::POS_READY,
        'my-button-handler'
    );
    ?>
    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>