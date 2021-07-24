<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requiere".
 *
 * @property int $ID_PRODUCTO
 * @property int $ID_INGREDIENTE
 * @property int $CANTIDAD_REQUIERE
 *
 * @property Producto $pRODUCTO
 * @property Ingrediente $iNGREDIENTE
 */
class Requiere extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requiere';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PRODUCTO', 'ID_INGREDIENTE'], 'required'],
            [['ID_PRODUCTO', 'ID_INGREDIENTE', 'CANTIDAD_REQUIERE'], 'integer'],
            [['ID_PRODUCTO', 'ID_INGREDIENTE'], 'unique', 'targetAttribute' => ['ID_PRODUCTO', 'ID_INGREDIENTE']],
            [['ID_PRODUCTO'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['ID_PRODUCTO' => 'ID_PRODUCTO']],
            [['ID_INGREDIENTE'], 'exist', 'skipOnError' => true, 'targetClass' => Ingrediente::className(), 'targetAttribute' => ['ID_INGREDIENTE' => 'ID_INGREDIENTE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_PRODUCTO' => 'Id Producto',
            'ID_INGREDIENTE' => 'Id Ingrediente',
            'CANTIDAD_REQUIERE' => 'Cantidad Requiere',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRODUCTO()
    {
        return $this->hasOne(Producto::className(), ['ID_PRODUCTO' => 'ID_PRODUCTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINGREDIENTE()
    {
        return $this->hasOne(Ingrediente::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }

    public function getIngredientes()
    {
        return $this->hasOne(Ingrediente::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }
}
