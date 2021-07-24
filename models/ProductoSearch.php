<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PRODUCTO', 'ID_TPRODUCTO', 'NUMSUB_PRODUCTO', 'NUMPROT_PRODUCTO', 'NUMVEG_PRODUCTO', 'NUMSALSAS_PRODUCTO', 'PRECIO_PRODUCTO'], 'integer'],
        [['NOMBRE_PRODUCTO', 'DESCRIPCION_PRODUCTO'], 'safe'],
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
        $query = Producto::find();

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
            'ID_PRODUCTO' => $this->ID_PRODUCTO,
            'ID_TPRODUCTO' => $this->ID_TPRODUCTO,
            'NUMSUB_PRODUCTO' => $this->NUMSUB_PRODUCTO,
            'NUMPROT_PRODUCTO' => $this->NUMPROT_PRODUCTO,
            'NUMVEG_PRODUCTO' => $this->NUMVEG_PRODUCTO,
            'NUMSALSAS_PRODUCTO' => $this->NUMSALSAS_PRODUCTO,
            'PRECIO_PRODUCTO' => $this->PRECIO_PRODUCTO,

        ]);

        $query->andFilterWhere(['like', 'NOMBRE_PRODUCTO', $this->NOMBRE_PRODUCTO])
            ->andFilterWhere(['like', 'DESCRIPCION_PRODUCTO', $this->DESCRIPCION_PRODUCTO]);

        return $dataProvider;
    }
}
