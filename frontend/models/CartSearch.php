<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cart;
use Yii;

/**
 * CartSearch represents the model behind the search form of `frontend\models\Cart`.
 */
class CartSearch extends Cart
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'quantity'], 'integer'],
            [['product_id'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cart::find()->joinWith(['product'])->where(['cart.created_by' => Yii::$app->user->id]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['product_id'] = [
            'asc' => ['product.name' => 'SORT_ASC'],
            'desc' => ['product.name' => 'SORT_DESC'],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere([
            'OR',
            ['like', 'product.name', $this->product_id],
            ['like', 'product.description', $this->product_id]
        ]);

        return $dataProvider;
    }
}
