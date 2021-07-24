<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->ID_PRODUCTO;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID_PRODUCTO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID_PRODUCTO], [
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
            'ID_TPRODUCTO',
            'NOMBRE_PRODUCTO',
            'NUMSUB_PRODUCTO',
            'DESCRIPCION_PRODUCTO',
            'NUMPROT_PRODUCTO',
            'NUMVEG_PRODUCTO',
            'NUMSALSAS_PRODUCTO',
            'PRECIO_PRODUCTO',
        ],
    ]) ?>

</div>
