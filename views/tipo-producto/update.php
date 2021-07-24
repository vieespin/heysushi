<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = 'Update Tipo Producto: ' . $model->ID_TPRODUCTO;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_TPRODUCTO, 'url' => ['view', 'id' => $model->ID_TPRODUCTO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-producto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
