<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repartidor".
 *
 * @property string $RUT_REPARTIDOR
 * @property string $NOMBRE_REPARTIDOR
 * @property string $TELEFONO_REPARTIDOR
 * @property int $VIGENTE_REPARTIDOR
 *
 * @property Venta[] $ventas
 */
class Repartidor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'repartidor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RUT_REPARTIDOR'], 'required'],
            [['VIGENTE_REPARTIDOR'], 'integer'],
            [['RUT_REPARTIDOR'], 'string', 'max' => 10],
            [['NOMBRE_REPARTIDOR'], 'string', 'max' => 150],
            [['TELEFONO_REPARTIDOR'], 'string', 'max' => 12],
            [['RUT_REPARTIDOR'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RUT_REPARTIDOR' => 'Rut Repartidor',
            'NOMBRE_REPARTIDOR' => 'Nombre Repartidor',
            'TELEFONO_REPARTIDOR' => 'Teléfono Repartidor',
            'VIGENTE_REPARTIDOR' => 'Vigente (Si/No)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['RUT_REPARTIDOR' => 'RUT_REPARTIDOR']);
    }
}
