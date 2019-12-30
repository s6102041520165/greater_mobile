<?php

namespace backend\models;
use Yii;
use yii\web\UploadedFile;

class Product extends \common\models\Product {
    public $imageFile;
    
    public function rules() {
        return [
            [['name', 'price', 'stock', 'created_by', 'created_at', 'updated_by', 'updated_at', 'category_id'], 'required'],
            [['price'], 'number'],
            [['stock', 'created_by', 'created_at', 'updated_by', 'updated_at', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description', 'picture'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => FALSE, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {  
        $path = 'products/' . $this->imageFile->baseName. '.' . $this->imageFile->extension;
        $this->imageFile->saveAs(Yii::getAlias('@webroot').'/'.$path);
        var_dump($this->imageFile);
        $this->picture = $path;
        return true;
        
    }
}





