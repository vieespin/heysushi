<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContieneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contienes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contiene-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contiene', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_COMPRA',
            'ID_INGREDIENTE',
            'SUB_UNIDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
