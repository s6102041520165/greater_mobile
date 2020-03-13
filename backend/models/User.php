<?php

namespace backend\models;

class User extends \common\models\User
{
    public $role;
    public function rules()
    {
        return [
            [['role'], 'string']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสอ้างอิง',
            'username' => 'ชื่อผู้ใช้',
            'status' => 'สถานะ',
            'email' => 'อีเมล',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'role' => 'ระดับสิทธิ์'
        ];
    }
}
