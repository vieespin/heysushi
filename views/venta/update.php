<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Finalizar';
$this->params['breadcrumbs'][] = ['label' => 'Venta'];
$this->params['breadcrumbs'][] = 'Finalizar';
$this->params['breadcrumbs'][] = ['label' => $model->ID_VENTA];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="venta-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'productos' =>$productos,
        'repartidores' => $repartidores,
    ]) ?>

</div>
