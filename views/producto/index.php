<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_PRODUCTO',
            'ID_TPRODUCTO',
            'NOMBRE_PRODUCTO',
            'NUMSUB_PRODUCTO',
            'DESCRIPCION_PRODUCTO',
            //'NUMPROT_PRODUCTO',
            //'NUMVEG_PRODUCTO',
            //'NUMSALSAS_PRODUCTO',
            //'PRECIO_PRODUCTO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
