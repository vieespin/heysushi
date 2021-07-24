<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contiene */

$this->title = 'Update Contiene: ' . $model->ID_COMPRA;
$this->params['breadcrumbs'][] = ['label' => 'Contienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_COMPRA, 'url' => ['view', 'ID_COMPRA' => $model->ID_COMPRA, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contiene-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
