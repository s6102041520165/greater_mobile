<?php

namespace frontend\models;

use yii\behaviors\BlameableBehavior;

class Customer extends \common\models\Customer
{
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
        ];
    }
}
