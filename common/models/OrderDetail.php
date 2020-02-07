<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $product_id
 * @property int $quantity
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orders_id', 'product_id', 'quantity'], 'required'],
            [['orders_id', 'product_id', 'quantity'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'orders_id' => 'ใบสั่งซื้อ',
            'product_id' => 'สินค้า',
            'quantity' => 'จำนวนที่สั่งซื้อ',
        ];
    }
}
