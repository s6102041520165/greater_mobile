<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $district
 * @property string $amphoe
 * @property string $province
 * @property string $zipcode
 * @property string $telephone
 * @property string|null $picture
 * @property int $user_id
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'district', 'amphoe', 'province', 'zipcode', 'telephone', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['district', 'amphoe', 'province', 'zipcode', 'telephone', 'picture'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'first_name' => 'ชื่อ',
            'last_name' => 'นามสกุล',
            'district' => 'ตำบล',
            'amphoe' => 'อำเภอ',
            'province' => 'จังหวัด',
            'zipcode' => 'รหัสไปรษณีย์',
            'telephone' => 'เบอร์โทร',
            'picture' => 'รูปภาพ',
            'user_id' => 'รหัสผู้ใช้'
        ];
    }
}
