<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Repartidor */

$this->title = 'Actualizar Repartidor: ' . $model->NOMBRE_REPARTIDOR;
$this->params['breadcrumbs'][] = ['label' => 'Repartidores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="repartidor-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
