<?php

namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadSlip extends Model {
    public $imageFile;
    
    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {  
        $path = 'slip/' . time() . '.' . $this->imageFile->extension;
        $this->imageFile->saveAs(Yii::getAlias('@webroot/../../image/').$path);
        return $path;
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'รูปภาพ'
        ];
    }
}





