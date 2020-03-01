<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int $quantity
 *
 * @property Product $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity'], 'required'],
            [['product_id', 'created_by', 'created_at', 'quantity'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'สินค้า',
            'created_by' => 'สั่งซื้อโดย',
            'created_at' => 'สั่งซื้อเมื่อ',
            'quantity' => 'จำนวนที่สั่งซื้อ',
        ];
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
