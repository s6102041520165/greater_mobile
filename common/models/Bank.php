<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $name
 * @property string $bank
 * @property string $bank_number
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bank', 'bank_number'], 'required'],
            [['name', 'bank', 'bank_number'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'bank' => 'Bank',
            'bank_number' => 'Bank Number',
        ];
    }
}
