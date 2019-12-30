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
            'id' => 'รหัส',
            'name' => 'ชื่อสินค้า',
            'description' => 'รายละเอียด',
            'price' => 'ราคา',
            'picture' => 'รูปภาพ',
            'stock' => 'คงเหลือ',
            'created_by' => 'เพิ่มโดย',
            'created_at' => 'เพิ่มเมื่อ',
            'updated_by' => 'แก้ไขโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'category_id' => 'ประเภทสินค้า',
        ];
    }

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    public function getCreator()
    {
        return $this->hasOne(\common\models\User::className(),['id' => 'created_by']);
    }

    public function getCategories()
    {
        return $this->hasOne(\common\models\Category::className(),['id' => 'category_id']);
    }

}
