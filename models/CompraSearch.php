<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Compra;

/**
 * CompraSearch represents the model behind the search form of `app\models\Compra`.
 */
class CompraSearch extends Compra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_COMPRA', 'ID_PRODUCTO', 'ID_VENTA', 'CANTIDAD_REQUIERE', 'MONTOEXTRA_COMPRA', 'TOTAL_COMPRA'], 'integer'],
            [['OBSERBACION_COMPRA','BASE_COMPRA', 'AGREGADOA_COMPRA', 'AGREGADOB_COMPRA','SALSAS_COMPRA'], 'safe'],
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
        $query = Compra::find();

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
            'ID_PRODUCTO' => $this->ID_PRODUCTO,
            'ID_VENTA' => $this->ID_VENTA,
            'CANTIDAD_REQUIERE' => $this->CANTIDAD_REQUIERE,
            'MONTOEXTRA_COMPRA' => $this->MONTOEXTRA_COMPRA,
            'TOTAL_COMPRA' => $this->TOTAL_COMPRA,
        ]);

        $query->andFilterWhere(['like', 'OBSERBACION_COMPRA', $this->OBSERBACION_COMPRA]);

        return $dataProvider;
    }
}
