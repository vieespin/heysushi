<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property int $ID_COMPRA
 * @property int $ID_PRODUCTO
 * @property int $ID_VENTA
 * @property int $CANTIDAD_REQUIERE
 * @property int $MONTOEXTRA_COMPRA
 * @property string $OBSERBACION_COMPRA
 * @property int $TOTAL_COMPRA
 *
 * @property Producto $pRODUCTO
 * @property Venta $vENTA
 * @property Contiene[] $contienes
 * @property Ingrediente[] $iNGREDIENTEs
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PRODUCTO', 'ID_VENTA', 'CANTIDAD_REQUIERE', 'MONTOEXTRA_COMPRA'], 'required'],
            [['ID_PRODUCTO', 'ID_VENTA', 'MONTOEXTRA_COMPRA', 'TOTAL_COMPRA'], 'integer'],
            [['CANTIDAD_REQUIERE'], 'integer', 'min'=>1],
            [['BASE_COMPRA','AGREGADOA_COMPRA','AGREGADOB_COMPRA','SALSAS_COMPRA', 'SALSAA_COMPRA', 'SALSAB_COMPRA'], 'string', 'max' => 100],
             [['AGREGADOA2_COMPRA','AGREGADOB2_COMPRA'], 'string', 'max' => 100],
            [['OBSERBACION_COMPRA'], 'string', 'max' => 200],
            [['ID_PRODUCTO'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['ID_PRODUCTO' => 'ID_PRODUCTO']],
            [['ID_VENTA'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['ID_VENTA' => 'ID_VENTA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_COMPRA' => 'Id Compra',
            'ID_PRODUCTO' => 'Id Producto',
            'ID_VENTA' => 'Id Venta',
            'CANTIDAD_REQUIERE' => 'Cantidad',
            'MONTOEXTRA_COMPRA' => 'Monto extra ($)',
            'OBSERBACION_COMPRA' => 'Observación',
            'TOTAL_COMPRA' => 'Total',
            'BASE_COMPRA' => 'Carne',
            'AGREGADOA_COMPRA' => 'Agregado A',
            'AGREGADOB_COMPRA' => 'Agregado B',
            'SALSAS_COMPRA' => 'Carne 2',
            'AGREGADOA2_COMPRA' => 'Agregado A2',
            'AGREGADOB2_COMPRA' => 'Agregado B2',
            'SALSAA_COMPRA' => 'Salsa A',
            'SALSAB_COMPRA' => 'Salsa B',

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
    public function getVENTA()
    {
        return $this->hasOne(Venta::className(), ['ID_VENTA' => 'ID_VENTA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContienes()
    {
        return $this->hasMany(Contiene::className(), ['ID_COMPRA' => 'ID_COMPRA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINGREDIENTEs()
    {
        return $this->hasMany(Ingrediente::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE'])->viaTable('contiene', ['ID_COMPRA' => 'ID_COMPRA']);
    }
}
