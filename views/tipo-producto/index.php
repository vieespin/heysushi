<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tipo Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_TPRODUCTO',
            'NOMBRE_TPRODUCTO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
