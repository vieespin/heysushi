<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Venta Nº'. $model->ID_VENTA;

$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="venta-view">

  

    <p>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ID_VENTA',
                ['attribute' => 'ID_VENTA', 
                // 'value'=>,
                'label'=>'Nº'],
               ['attribute' => 'RUT_REPARTIDOR', 
                // 'value'=>,
                'label'=>'Repartidor'],
            'FECHA_VENTA',
            'DIRECCION_VENTA',
            'TELEFONO_VENTA',
            'VENDEDOR_VENTA',
            'OBSERVACION_VENTA',
            'MEDIOPAGO_VENTA',
            'HESTIM_VENTA',
            'ESTADO_VENTA',
            'TOTAL_VENTA',
        ],
    ]) ?>

</div>
