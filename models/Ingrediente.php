<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingrediente".
 *
 * @property int $ID_INGREDIENTE
 * @property string $NOMBRE_INGREDIENTE
 * @property string $UNIDMEDIDA_INGREDIENTE
 * @property string $TIPO_INGREDIENTE
 *
 * @property Contiene[] $contienes
 * @property Compra[] $cOMPRAs
 * @property Requiere[] $requieres
 * @property Producto[] $pRODUCTOs
 */
class Ingrediente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingrediente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMBRE_INGREDIENTE', 'UNIDMEDIDA_INGREDIENTE', 'TIPO_INGREDIENTE'], 'string', 'max' => 100],
            [['NOMCORTO_INGREDIENTE'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_INGREDIENTE' => 'Id Ingrediente',
            'NOMBRE_INGREDIENTE' => 'Nombre Ingrediente',
            'UNIDMEDIDA_INGREDIENTE' => 'Unidmedida Ingrediente',
            'TIPO_INGREDIENTE' => 'Tipo Ingrediente',
            'NOMCORTO_INGREDIENTE'=> 'Nombre corto ingrediente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContienes()
    {
        return $this->hasMany(Contiene::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOMPRAs()
    {
        return $this->hasMany(Compra::className(), ['ID_COMPRA' => 'ID_COMPRA'])->viaTable('contiene', ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequieres()
    {
        return $this->hasMany(Requiere::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRODUCTOs()
    {
        return $this->hasMany(Producto::className(), ['ID_PRODUCTO' => 'ID_PRODUCTO'])->viaTable('requiere', ['ID_INGREDIENTE' => 'ID_INGREDIENTE']);
    }
}
