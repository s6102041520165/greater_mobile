<?php

use backend\models\Customer;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        //app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="hold-transition skin-blue-light sidebar-mini">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <?php
            if (!Yii::$app->user->isGuest) {
                $customer = Customer::findOne(['user_id' => Yii::$app->user->id]);
                $isUserProfile = (empty($customer->user_id) || is_null($customer->user_id)); //Return true when null of customer
                $nameProfiles = ($isUserProfile) ? "ไม่มีข้อมูลส่วนตัว" : $customer->first_name . " " . $customer->last_name;
                $imageProfile = ($isUserProfile) ?
                    Yii::getAlias('@web/../../image/customer/user.png')
                    : Yii::getAlias('@web/../../image/') . $customer->picture;
            }
            ?>

            <?= $this->render(
                'header.php',
                [
                    'directoryAsset' => $directoryAsset,
                    'imageProfile' => $imageProfile,
                    'nameProfile' => $nameProfiles,
                ]
            ) ?>

            <?= $this->render(
                'left.php',
                [
                    'directoryAsset' => $directoryAsset,
                    'imageProfile' => $imageProfile,
                    'nameProfile' => $nameProfiles,
                ]
            )
            ?>

            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>

        </div>

        <?php $this->endBody() ?>
    </body>

    </html>
    <?php $this->endPage() ?>
<?php } ?>