<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $order_id
 * @property string $bank
 * @property string $location
 * @property float $amount
 * @property string $date_pay
 * @property string $time_pay
 * @property int $status
 * @property string|null $image
 *
 * @property Orders $order
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'bank', 'location', 'amount', 'date_pay', 'time_pay'], 'required'],
            [['order_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['date_pay', 'time_pay'], 'safe'],
            [['bank', 'location', 'image'], 'string', 'max' => 255],
            [['order_id'], 'unique'],
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
            'order_id' => 'เลขที่ใบสั่งซื้อ',
            'bank' => 'ธนาคาร',
            'location' => 'สถานที่โอน',
            'amount' => 'จำนวนเงินที่โอน',
            'date_pay' => 'วันที่ชำระเงิน',
            'time_pay' => 'เวลาที่ชำระเงิน',
            'status' => 'สถานะการชำระเงิน',
            'image' => 'สลิป',
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
