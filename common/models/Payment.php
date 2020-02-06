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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'bank' => 'Bank',
            'location' => 'Location',
            'amount' => 'Amount',
            'date_pay' => 'Date Pay',
            'time_pay' => 'Time Pay',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }
}
