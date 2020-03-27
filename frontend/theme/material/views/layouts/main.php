<?php

// This is Nikom Theme for Nikom Office

use app\models\Category;
use frontend\theme\material\MaterialAsset;
use yii\bootstrap4\Alert as Bootstrap4Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

MaterialAsset::register($this);
$asset_path = Yii::$app->assetManager->getPublishedUrl('@frontend/theme/material/assets');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Add Material font (Roboto) and Material icon as needed -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
        /* Sticky footer styles
-------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 60px;
            /* Margin bottom by footer height */
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* Set the fixed height of the footer here */
            line-height: 60px;
            /* Vertically center the text there */
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
        }

        .jumbotron {
            text-align: center;
            background-color: transparent;
        }

        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }

        .not-set {
            color: #c55;
            font-style: italic;
        }

        /* add sorting icons to gridview sort links */
        a.asc:after,
        a.desc:after {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: normal;
            line-height: 1;
            padding-left: 5px;
        }

        a.asc:after {
            content: "\e151";
        }

        a.desc:after {
            content: "\e152";
        }

        .sort-numerical a.asc:after {
            content: "\e153";
        }

        .sort-numerical a.desc:after {
            content: "\e154";
        }

        .sort-ordinal a.asc:after {
            content: "\e155";
        }

        .sort-ordinal a.desc:after {
            content: "\e156";
        }

        .grid-view td {
            white-space: nowrap;
        }

        .grid-view .filters input,
        .grid-view .filters select {
            min-width: 50px;
        }

        .hint-block {
            display: block;
            margin-top: 5px;
            color: #999 !important;
        }

        .error-summary {
            color: #a94442 !important;
            background: #fdf7f7;
            border-left: 3px solid #eed3d7;
            padding: 10px 20px;
            margin: 0 0 15px 0;
        }

        .help-block,
        .help-block-error {
            color: red;
        }

        /* align the logout "link" (button in form) of the navbar */
        .nav li>form>button.logout {
            padding: 15px;
            border: none;
        }

        @media(max-width:767px) {
            .nav li>form>button.logout {
                display: block;
                text-align: left;
                width: 100%;
                padding: 10px 15px;
            }
        }

        .nav>li>form>button.logout:focus,
        .nav>li>form>button.logout:hover {
            text-decoration: none;
        }

        .nav>li>form>button.logout:focus {
            outline: none;
        }
    </style>

</head>

<body class="avoid-fout page-blue">
    <?php $this->beginBody() ?>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?= Html::a(Yii::$app->name, Url::to(['/site/index']), ['class' => 'navbar-brand']) ?>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <?= Html::a('หน้าแรก', Url::to(['/site/index']), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            สินค้า
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?= Html::a('ทั้งหมด', Url::to(['/product/index']), ['class' => 'dropdown-item']) ?>
                            <?php $data = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name') ?>
                            <?php
                            foreach ($data as $key => $value) {
                                echo Html::a($value, Url::to(['/product/index', 'category' => $key]), ['class' => 'dropdown-item']);
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('ตะกร้าสินค้า', Url::to(['/cart/index']), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('ประวัติการสั่่งซื้อ', Url::to(['/site/orders']), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('ติดตามพัสดุ', Url::to(['/site/tracking']), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('แจ้งชำระเงิน', Url::to(['/payment/index']), ['class' => 'nav-link']) ?>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <?= (Yii::$app->user->isGuest) ?
                            Html::a('ลงทะเบียน', Url::to(['/site/signup']), ['class' => 'btn btn-default']) .
                            Html::a('เข้าสู่ระบบ', Url::to(['/site/login']), ['class' => 'btn btn-default'])
                            : Html::a('ออกจากระบบ', Url::to(['/site/logout']), ['class' => 'btn btn-danger', 'data-method' => 'post'])
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>


    <div class="content">
       
        <div class="container-fluid">
            <?= $content; ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <span class="text-muted">
                <span class="float-left">Powered By <?= Yii::$app->name; ?></span>
                <span class="float-right"> Version 1.0</span>
            </span>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>