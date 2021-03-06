<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadSingleForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => FALSE, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        $path = 'products/' . time() . '.' . $this->imageFile->extension;
        $this->imageFile->saveAs(Yii::getAlias('@webroot/../../image/') . $path);
        return $path;
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'รูปภาพ'
        ];
    }
}
