<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tracking".
 *
 * @property int $id
 * @property int $order_id
 * @property int $barcode
 */
class Tracking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tracking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'barcode'], 'required'],
            [['order_id', 'barcode'], 'integer'],
            [['barcode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'order_id' => 'รหัสใบสั่งซื้อ',
            'barcode' => 'บาร์โค๊ด',
        ];
    }
}
