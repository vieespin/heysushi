<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Requiere */

$this->title = $model->ID_PRODUCTO;
$this->params['breadcrumbs'][] = ['label' => 'Requieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="requiere-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_PRODUCTO' => $model->ID_PRODUCTO, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_PRODUCTO' => $model->ID_PRODUCTO, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE], [
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
            'ID_PRODUCTO',
            'ID_INGREDIENTE',
            'CANTIDAD_REQUIERE',
        ],
    ]) ?>

</div>
