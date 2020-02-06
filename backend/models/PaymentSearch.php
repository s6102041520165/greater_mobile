<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Payment;

/**
 * PaymentSearch represents the model behind the search form of `backend\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'status'], 'integer'],
            [['bank', 'location', 'date_pay', 'time_pay', 'image'], 'safe'],
            [['amount'], 'number'],
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
        $query = Payment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'date_pay' => $this->date_pay,
            'time_pay' => $this->time_pay,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
