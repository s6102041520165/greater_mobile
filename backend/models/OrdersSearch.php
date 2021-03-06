<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `backend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $customer_firstname;
    public $customer_lastname;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sumtotal'], 'number'],
            [['customer_id'], 'safe']
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
        $query = Orders::find()->joinWith(['customer']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['customer_id'] = [
            'asc' => ['customer.first_name' => 'SORT_ASC'],
            'desc' => ['customer.first_name' => 'SORT_DESC'],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sumtotal' => $this->sumtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            //'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere([
            'OR',
            ['like', 'customer.first_name', $this->customer_id],
            ['like', 'customer.last_name', $this->customer_id]
        ]);

        return $dataProvider;
    }
}
