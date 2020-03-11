<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Customer;

AppAsset::register($this);
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
            ['label' => 'สินค้า', 'url' => ['/product/index']],
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
                        ['label' => 'ประวัติการสั่งซื้อ', 'url' => ['/site/order'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'แจ้งชำระเงิน', 'url' => ['/payment/index'], 'visible' => !Yii::$app->user->isGuest],
                        '<li class="divider"></li>',
                        "<li class=\"dropdown-header\">$nameProfiles</li>",
                        ['label' => 'เพิ่มข้อมูลส่วนตัว', 'url' => ['/customer/create'], 'visible' => $isUserProfile],
                        ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/customer/update', 'id' => $customer->id], 'visible' => !$isUserProfile],
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

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>