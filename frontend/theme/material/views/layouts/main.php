<?php

// This is Nikom Theme for Nikom Office

use frontend\theme\material\MaterialAsset;
use yii\helpers\Html;

MaterialAsset::register($this);
$asset_path = Yii::$app->assetManager->getPublishedUrl('@frontend/theme/material/assets');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1.0, width=device-width" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>



    <!-- favicon -->
    <!-- ... -->

    <!-- ie -->
    <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="avoid-fout page-blue">
    <?php $this->beginBody() ?>
    <header class="header">
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                    <h5 class="text-white h4">Collapsed content</h5>
                    <span class="text-muted">Toggleable via the navbar brand.</span>
                </div>
            </div>
            <nav class="navbar navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </header>
    <nav class="menu" id="menu">
        <div class="menu-scroll">
            <div class="menu-wrap">
                <div class="menu-top">
                    <div class="menu-top-img">
                        <img alt="#" src="<?= $asset_path; ?>/images/samples/landscape.jpg">
                    </div>
                    <div style="height: 168px;">

                    </div>
                </div>
                <div class="menu-content">
                    <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'menu-logo']); ?>
                    <ul class="nav">
                        <li><?= Html::a('<span class="icon icon-exit-to-app"></span> สถานที่ท่องเที่ยว', '#'); ?></li>
                        <li><?= Html::a('<span class="icon icon-exit-to-app"></span> วัฒนธรรม-ประเพณี', '#'); ?></li>
                    </ul>
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <hr>
                        <ul class="nav">
                            <li>
                                <a href="ui-button.html">Buttons</a>
                            </li>
                            <li>
                                <a href="#"><span class="icon icon-exit-to-app"></span> เมนู</a>
                                <span class="menu-collapse-toggle collapsed" data-target="#form-elements" data-toggle="collapse"><i class="icon icon-close menu-collapse-toggle-close"></i><i class="icon icon-add menu-collapse-toggle-default"></i></span>
                                <ul class="menu-collapse collapse" id="form-elements">
                                    <li>
                                        <a href="#"><span class="icon icon-exit-to-app"></span> ทะเบียน</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="ui-icon.html">Icons</a>
                            </li>
                            <li>
                                <a href="ui-table.html">Tables</a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <?php if (!Yii::$app->user->isGuest) { ?>
        <nav class="menu menu-right" id="profile">
            <div class="menu-scroll">
                <div class="menu-wrap">
                    <div class="menu-top">
                        <div class="menu-top-img">
                            <img alt="John Smith" src="<?= $asset_path; ?>/images/samples/landscape.jpg">
                        </div>
                        <div class="menu-top-info">
                            <a class="menu-top-user" href="javascript:void(0)"><span class="avatar pull-left"><img alt="alt text for John Smith avatar" src="<?= $asset_path; ?>/images/users/avatar-001.jpg"></span>มานพ กองอุ่น</a>
                        </div>
                        <div class="menu-top-info-sub">
                            <small>ข้อมูลเพิ่มเติมเกี่ยวกับมานพ กองอุ่น</small>
                        </div>
                    </div>
                    <div class="menu-content">
                        <ul class="nav">
                            <li>
                                <a href="javascript:void(0)"><span class="icon icon-account-box"></span>Profile Settings</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="icon icon-add-to-photos"></span>Upload Photo</a>
                            </li>
                            <li>
                                <?= Html::a('<span class="icon icon-exit-to-app"></span>ออกจากระบบ', ['/site/logout'], ['data-method' => 'post']); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    <?php } ?>
    <div class="content">
        <?= $content; ?>
    </div>
    <footer class="footer">
        <div class="container">
            <p>
                <?= Yii::$app->name; ?>
            </p>
        </div>
    </footer>
    <div class="fbtn-container">
        <div class="fbtn-inner">
            <a class="fbtn fbtn-red fbtn-lg" data-toggle="dropdown"><span class="fbtn-text">ทางลัด</span><span class="fbtn-ori icon icon-open-in-new"></span><span class="fbtn-sub icon icon-close"></span></a>
            <div class="fbtn-dropdown">

                <?= Html::a('<span class="fbtn-text">เข้าสู่ระบบ</span><span class="fa fa-link"></span>', ['/site/login'], ['class' => 'fbtn fbtn-alt']); ?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>