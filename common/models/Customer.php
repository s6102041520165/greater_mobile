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
 *
 * @property User $user
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสอ้างอิง',
            'first_name' => 'ชื่อ',
            'last_name' => 'นามสกุล',
            'district' => 'ตำบล',
            'amphoe' => 'อำเภอ',
            'province' => 'จังหวัด',
            'zipcode' => 'รหัสไปรษณีย์',
            'telephone' => 'เบอร์โทร',
            'picture' => 'รูปโปรไฟล์',
            'user_id' => 'ผู้ใช้',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
