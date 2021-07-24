<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contiene;

/**
 * ContieneSearch represents the model behind the search form of `app\models\Contiene`.
 */
class ContieneSearch extends Contiene
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_COMPRA', 'ID_INGREDIENTE', 'SUB_UNIDAD'], 'integer'],
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
        $query = Contiene::find();

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
            'ID_COMPRA' => $this->ID_COMPRA,
            'ID_INGREDIENTE' => $this->ID_INGREDIENTE,
            'SUB_UNIDAD' => $this->SUB_UNIDAD,
        ]);

        return $dataProvider;
    }
}
