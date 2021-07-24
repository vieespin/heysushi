<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contiene".
 *
 * @property int $ID_COMPRA
 * @property int $ID_INGREDIENTE
 * @property int $SUB_UNIDAD
 *
 * @property Compra $cOMPRA
 * @property Ingrediente $iNGREDIENTE
 */
class Contiene extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contiene';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_COMPRA', 'ID_INGREDIENTE'], 'required'],
            [['ID_COMPRA', 'ID_INGREDIENTE', 'SUB_UNIDAD'], 'integer'],
            [['ID_COMPRA', 'ID_INGREDIENTE'], 'unique', 'targetAttribute' => ['ID_COMPRA', 'ID_INGREDIENTE']],
            [['ID_COMPRA'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::className(), 'targetAttribute' => ['ID_COMPRA' => 'ID_COMPRA']],
            [['ID_INGREDIENTE'], 'exist', 'skipOnError' => true, 'targetClass' => Ingrediente::className(), 'targetAttribute' => ['ID_INGREDIENTE' => 'ID_INGREDIENTE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_COMPRA' => 'Id Compra',
            'ID_INGREDIENTE' => 'Id Ingrediente',
            'SUB_UNIDAD' => 'Sub Unidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOMPRA()
    {
        return $this->hasOne(Compra::className(), ['ID_COMPRA' => 'ID_COMPRA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINGREDIENTE()
    {
        return $this->hasOne(Ingrediente::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }
}
