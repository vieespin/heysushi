<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Repartidor */

$this->title = $model->RUT_REPARTIDOR;
$this->params['breadcrumbs'][] = ['label' => 'Repartidors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="repartidor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->RUT_REPARTIDOR], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RUT_REPARTIDOR], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'RUT_REPARTIDOR',
            'NOMBRE_REPARTIDOR',
            'TELEFONO_REPARTIDOR',
            'VIGENTE_REPARTIDOR',
        ],
    ]) ?>

</div>
