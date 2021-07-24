<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingrediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ingrediente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_INGREDIENTE',
            'NOMBRE_INGREDIENTE',
            'NOMCORTO_INGREDIENTE',
            'UNIDMEDIDA_INGREDIENTE',
            'TIPO_INGREDIENTE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
