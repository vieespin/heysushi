<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contiene */

$this->title = $model->ID_COMPRA;
$this->params['breadcrumbs'][] = ['label' => 'Contienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contiene-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_COMPRA' => $model->ID_COMPRA, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_COMPRA' => $model->ID_COMPRA, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE], [
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
            'ID_COMPRA',
            'ID_INGREDIENTE',
            'SUB_UNIDAD',
        ],
    ]) ?>

</div>
