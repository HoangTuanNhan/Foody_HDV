<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Restaurant;

/**
 * RestaurantSearch represents the model behind the search form about `common\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'restaurant_category_id', 'address_id', 'price_min', 'price_max', 'point', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name', 'detail', 'image', 'time_open', 'time_close'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Restaurant::find();

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
            'restaurant_category_id' => $this->restaurant_category_id,
            'address_id' => $this->address_id,
            'time_open' => $this->time_open,
            'time_close' => $this->time_close,
            'price_min' => $this->price_min,
            'price_max' => $this->price_max,
            'point' => $this->point,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
