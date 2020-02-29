<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tracking".
 *
 * @property int $id
 * @property int $order_id
 * @property int $barcode
 *
 * @property Orders $order
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
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสอ้างอิง',
            'order_id' => 'ใบสั่งซื้อ',
            'barcode' => 'บาร์โค๊ด',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
