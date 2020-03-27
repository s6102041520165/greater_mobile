<?php

namespace frontend\models;

use Yii;

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
class Cart extends \common\models\Cart
{
    
}
