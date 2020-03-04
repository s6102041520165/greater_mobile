<?php
namespace frontend\theme\material;

use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle{
    public $sourcePath = '@frontend/theme/material/assets';
    
    public $css = [
        'css/material.min.css',
    ];
    public $js = [
        'js/material.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}