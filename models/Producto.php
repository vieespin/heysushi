<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $ID_PRODUCTO
 * @property int $ID_TPRODUCTO
 * @property string $NOMBRE_PRODUCTO
 * @property int $NUMSUB_PRODUCTO
 * @property string $DESCRIPCION_PRODUCTO
 * @property int $NUMPROT_PRODUCTO
 * @property int $NUMVEG_PRODUCTO
 * @property int $NUMSALSAS_PRODUCTO
 * @property int $PRECIO_PRODUCTO
 *
 * @property Compra[] $compras
 * @property TipoProducto $tPRODUCTO
 * @property Requiere[] $requieres
 * @property Ingrediente[] $iNGREDIENTEs
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_TPRODUCTO'], 'required'],
            [['ID_TPRODUCTO', 'NUMSUB_PRODUCTO', 'NUMPROT_PRODUCTO', 'NUMVEG_PRODUCTO', 'NUMSALSAS_PRODUCTO', 'PRECIO_PRODUCTO'], 'integer'],
            [['NOMBRE_PRODUCTO'], 'string', 'max' => 200],
            [['DESCRIPCION_PRODUCTO'], 'string', 'max' => 500],
            [['ID_TPRODUCTO'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['ID_TPRODUCTO' => 'ID_TPRODUCTO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_PRODUCTO' => 'Id Producto',
            'ID_TPRODUCTO' => 'Id Tipo producto',
            'NOMBRE_PRODUCTO' => 'Nombre Producto',
            'NUMSUB_PRODUCTO' => 'Número sub Productos',
            'DESCRIPCION_PRODUCTO' => 'Descripción Producto',
            'NUMPROT_PRODUCTO' => 'Número proteínas Producto',
            'NUMVEG_PRODUCTO' => 'Número vegetales Producto',
            'NUMSALSAS_PRODUCTO' => 'Número salsas Producto',
            'PRECIO_PRODUCTO' => 'Precio Producto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['ID_PRODUCTO' => 'ID_PRODUCTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPRODUCTO()
    {
        return $this->hasOne(TipoProducto::className(), ['ID_TPRODUCTO' => 'ID_TPRODUCTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequieres()
    {
        return $this->hasMany(Requiere::className(), ['ID_PRODUCTO' => 'ID_PRODUCTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINGREDIENTEs()
    {
        return $this->hasMany(Ingrediente::className(), ['ID_INGREDIENTE' => 'ID_INGREDIENTE'])->viaTable('requiere', ['ID_PRODUCTO' => 'ID_PRODUCTO']);
    }
}
