<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\daterange\DateRangeBehavior;
use app\models\Venta;

/**
 * VentaSearch represents the model behind the search form of `app\models\Venta`.
 */
class VentaSearch extends Venta
{
    /**
     * {@inheritdoc}
     */
    public $FECHA_INI;
    public $FECHA_FIN;
    // public $FECHA_RANGO;

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'FECHA_VENTA',
                'dateStartAttribute' => 'FECHA_INI',
                'dateEndAttribute' => 'FECHA_FIN',
                'dateStartFormat' => 'Y-m-d H:i',
                'dateEndFormat' => 'Y-m-d H:i',
            ]
        ];
    }

    public function rules()
    {
        return [
            [['ID_VENTA', 'TOTAL_VENTA'], 'integer'],
            [['FECHA_VENTA'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['RUT_REPARTIDOR', 'FECHA_VENTA', 'DIRECCION_VENTA', 'TELEFONO_VENTA', 'VENDEDOR_VENTA', 'OBSERVACION_VENTA', 'MEDIOPAGO_VENTA', 'ESTADO_VENTA', 'FECHA_INI', 'FECHA_FIN', 'HESTIM_VENTA', 'COMPRADOR_VENTA', 'TIPO_VENTA'], 'safe'],
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
        $query = Venta::find()->where(['not', ['FECHA_VENTA' => null]]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID_VENTA' => $this->ID_VENTA,
            // 'FECHA_VENTA' => $this->FECHA_VENTA,
            'TOTAL_VENTA' => $this->TOTAL_VENTA,
        ]);

        $query->andFilterWhere(['like', 'RUT_REPARTIDOR', $this->RUT_REPARTIDOR])
            ->andFilterWhere(['like', 'DIRECCION_VENTA', $this->DIRECCION_VENTA])
            ->andFilterWhere(['like', 'TELEFONO_VENTA', $this->TELEFONO_VENTA])
            ->andFilterWhere(['like', 'VENDEDOR_VENTA', $this->VENDEDOR_VENTA])
            ->andFilterWhere(['like', 'COMPRADOR_VENTA', $this->COMPRADOR_VENTA])
            ->andFilterWhere(['like', 'OBSERVACION_VENTA', $this->OBSERVACION_VENTA])
            ->andFilterWhere(['like', 'MEDIOPAGO_VENTA', $this->MEDIOPAGO_VENTA])
            ->andFilterWhere(['like', 'HESTIM_VENTA', $this->HESTIM_VENTA])
            ->andFilterWhere(['like', 'TIPO_VENTA', $this->TIPO_VENTA])
            ->andFilterWhere(['like', 'ESTADO_VENTA', $this->ESTADO_VENTA]);

        if(isset ($this->FECHA_INI)&&$this->FECHA_INI!='') {
            $query->andFilterWhere(['between','FECHA_VENTA', $this->FECHA_INI, $this->FECHA_FIN]);
            $this->FECHA_VENTA=$this->FECHA_INI.' - '.$this->FECHA_FIN;
        }

        return $dataProvider;
    }
}
