<?php

// This is Nikom Theme for Nikom Office

use app\models\Category;
use frontend\theme\material\MaterialAsset;
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
                        <?= Html::a('ประวัติการสั่่งซื้อ', Url::to(['/site/index']), ['class' => 'nav-link']) ?>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <?= (Yii::$app->user->isGuest) ?
                            Html::a('ลงทะเบียน', Url::to(['/site/signup']), ['class' => 'btn btn-default']) .
                            Html::a('เข้าสู่ระบบ', Url::to(['/site/login']), ['class' => 'btn btn-default'])
                            : Html::a('ออกจากระบบ', Url::to(['/site/signout']), ['class' => 'btn btn-danger', 'data-mothod' => 'post'])
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
        <div class="container">
            <p>
                <?= Yii::$app->name; ?>
            </p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>