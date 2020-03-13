<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadSingleForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if (isset($this->imageFile->extension)) {
            $path = 'customer/' . time() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(Yii::getAlias('@webroot/../../image/') . $path);
            return $path;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'รูปภาพ'
        ];
    }
}
