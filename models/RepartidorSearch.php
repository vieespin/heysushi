<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Repartidor;

/**
 * RepartidorSearch represents the model behind the search form of `app\models\Repartidor`.
 */
class RepartidorSearch extends Repartidor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RUT_REPARTIDOR', 'NOMBRE_REPARTIDOR', 'TELEFONO_REPARTIDOR'], 'safe'],
            [['VIGENTE_REPARTIDOR'], 'integer'],
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
        $query = Repartidor::find();

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
            'VIGENTE_REPARTIDOR' => $this->VIGENTE_REPARTIDOR,
        ]);

        $query->andFilterWhere(['like', 'RUT_REPARTIDOR', $this->RUT_REPARTIDOR])
            ->andFilterWhere(['like', 'NOMBRE_REPARTIDOR', $this->NOMBRE_REPARTIDOR])
            ->andFilterWhere(['like', 'TELEFONO_REPARTIDOR', $this->TELEFONO_REPARTIDOR]);

        return $dataProvider;
    }
}
