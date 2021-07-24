<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepartidorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repartidores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repartidor-index">

    <p>
        <?= Html::a('Registrar Repartidor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'RUT_REPARTIDOR',
            'NOMBRE_REPARTIDOR',
            'TELEFONO_REPARTIDOR',
            // 'VIGENTE_REPARTIDOR',
            ['attribute'=>'VIGENTE_REPARTIDOR',
            'value'=>function ($model, $key, $index, $column){
                    if($model->VIGENTE_REPARTIDOR===0){
                        return "No";
                    }
                    else if($model->VIGENTE_REPARTIDOR===1){
                        return "Si";
                    }
                    else{
                        return "";
                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
            'header'=>"Opción",
            'headerOptions'=>['style'=>'color:#3c8dbc', 'title'=>""],
            'template' => '{update}',
            'visible'=> Yii::$app->user->identity->role==='Admin'? true:false,
            ],
        ],
    ]); ?>


</div>
