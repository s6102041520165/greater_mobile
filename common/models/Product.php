<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property string|null $picture
 * @property int $stock
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 * @property int $category_id
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'price', 'stock', 'created_by', 'created_at', 'updated_by', 'updated_at', 'category_id'], 'required'],
            [['price'], 'number'],
            [['stock', 'created_by', 'created_at', 'updated_by', 'updated_at', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description', 'picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'picture' => 'Picture',
            'stock' => 'Stock',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
        ];
    }

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

}
