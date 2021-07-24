<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingrediente */

$this->title = 'Update Ingrediente: ' . $model->ID_INGREDIENTE;
$this->params['breadcrumbs'][] = ['label' => 'Ingredientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_INGREDIENTE, 'url' => ['view', 'id' => $model->ID_INGREDIENTE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingrediente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
