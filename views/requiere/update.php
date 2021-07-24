<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requiere */

$this->title = 'Update Requiere: ' . $model->ID_PRODUCTO;
$this->params['breadcrumbs'][] = ['label' => 'Requieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PRODUCTO, 'url' => ['view', 'ID_PRODUCTO' => $model->ID_PRODUCTO, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="requiere-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
