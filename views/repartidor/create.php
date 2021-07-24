<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Repartidor */

$this->title = 'Registrar Repartidor';
$this->params['breadcrumbs'][] = ['label' => 'Repartidores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repartidor-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
