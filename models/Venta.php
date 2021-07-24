<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property int $ID_VENTA
 * @property string $RUT_REPARTIDOR
 * @property string $FECHA_VENTA
 * @property string $DIRECCION_VENTA
 * @property string $TELEFONO_VENTA
 * @property string $VENDEDOR_VENTA
 * @property string $OBSERVACION_VENTA
 * @property string $MEDIOPAGO_VENTA
 * @property string $ESTADO_VENTA
 * @property int $TOTAL_VENTA
 *
 * @property Compra[] $compras
 * @property Repartidor $rUTREPARTIDOR
 */
class Venta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venta';
    }

    // ALTER TABLE `venta`  ADD `COMPRADOR_VENTA` VARCHAR(100) NULL  AFTER `VENDEDOR_VENTA`;
    // ALTER TABLE `venta` ADD `TIPO_VENTA` VARCHAR(100) NULL AFTER `HESTIM_VENTA`;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['MEDIOPAGO_VENTA'], 'required'],
            [['MEDIOPAGO_VENTA'],'default', 'value'=>'Efectivo'],
            // [['TIPO_VENTA'],'default', 'value'=>'Local'],
            [['FECHA_VENTA', 'HESTIM_VENTA'], 'safe'],
            [['TOTAL_VENTA'], 'integer'],
            [['TOTAL_VENTA'], 'default', 'value'=> 0],
            [['RUT_REPARTIDOR'],'default', 'value'=>null],
            [['RUT_REPARTIDOR'], 'string', 'max' => 10],
            [['DIRECCION_VENTA'], 'string', 'max' => 250],
            [['TELEFONO_VENTA'], 'string', 'max' => 20],
            [['VENDEDOR_VENTA', 'COMPRADOR_VENTA', 'TIPO_VENTA'], 'string', 'max' => 100],
            [['OBSERVACION_VENTA'], 'string', 'max' => 300],
            [['MEDIOPAGO_VENTA', 'ESTADO_VENTA'], 'string', 'max' => 50],
            [['ESTADO_VENTA'], 'default', 'value'=> 'Cocina'],
            [['RUT_REPARTIDOR'], 'exist', 'skipOnError' => true, 'targetClass' => Repartidor::className(), 'targetAttribute' => ['RUT_REPARTIDOR' => 'RUT_REPARTIDOR']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_VENTA' => 'Id Venta',
            'RUT_REPARTIDOR' => 'Rut Repartidor',
            'FECHA_VENTA' => 'Fecha ',
            'DIRECCION_VENTA' => 'Dirección ',
            'TELEFONO_VENTA' => 'Teléfono ',
            'VENDEDOR_VENTA' => 'Vendedor',
            'COMPRADOR_VENTA' => 'Comprador',
            'OBSERVACION_VENTA' => 'Observación ',
            'MEDIOPAGO_VENTA' => 'Medio de pago ',
            'HESTIM_VENTA'=> 'Hora Estimada',
            'TIPO_VENTA' => 'Tipo',
            'ESTADO_VENTA' => 'Estado',
            'TOTAL_VENTA' => 'Total ($)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['ID_VENTA' => 'ID_VENTA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUTREPARTIDOR()
    {
        return $this->hasOne(Repartidor::className(), ['RUT_REPARTIDOR' => 'RUT_REPARTIDOR']);
    }
}
