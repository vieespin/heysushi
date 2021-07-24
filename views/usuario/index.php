<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuario-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions'=>function($model) {
            if($model->activate=='inactivo')
            {
                return ['class'=>'danger'];
            }
        },
        'headerRowOptions'=>['title'=>'Ordenar de forma ascendente, descendente'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            //'password',
            //'id',
            //'authKey',
            // 'accessToken',
            'activate',
            'role',

           ['class' => 'yii\grid\ActionColumn', 
           'header'=>"Opc.",
           'headerOptions'=>['style'=>'color:#448aff'],
           'template' => '{update}'],
        ],
    ]); ?>
</div>
