<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property float $sumtotal
 * @property int $customer_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sumtotal', 'customer_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['sumtotal'], 'number'],
            [['customer_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'sumtotal' => 'ราคารวม',
            'customer_id' => 'ลูกค้า',
            'created_at' => 'สั่งซื้อเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สั่งซื้อโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['customer_id' => 'id']);
    }
}