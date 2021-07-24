<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <!-- <?= Html::a('Create Venta', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'repartidores'=> $repartidores,
        'telefono'=> $telefono,
        'vendedor'=> $vendedor,
        'medio_pago'=>$medio_pago,

     ]); ?>
    <?php if (Yii::$app->user->identity->role=="Admin"):?>
        <p style="color:#3c8dbc;">
            <b>Exportar</b>
        </p>
        <?php
        $gridColumns = [
                'TIPO_VENTA',
                [
                    'attribute'=>'ID_VENTA',
                    'label'=>'Nº venta',
                ],
                // 'RUT_REPARTIDOR',
                [
                    'attribute'=>'RUT_REPARTIDOR',
                    'value'=>'rUTREPARTIDOR.NOMBRE_REPARTIDOR',
                    'label'=>'Repartidor',
                ],
                'FECHA_VENTA:datetime',
                'DIRECCION_VENTA',
                'TELEFONO_VENTA',
                'VENDEDOR_VENTA',
                'OBSERVACION_VENTA',
                'MEDIOPAGO_VENTA',
                'HESTIM_VENTA',
                'ESTADO_VENTA',
                'TOTAL_VENTA',
                ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'exportConfig' => [ ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_PDF => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ],
            ]);
        ?>
    <?php endif ?>

    <div class="pull-right">
        <?= Html::a('<i class="fa fa-tv"></i> Pantalla de cocina', ['pantalla'], ['class' => 'btn btn-success',  'target'=>'_blank']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'pjax'=>true,
        'headerRowOptions'=>['title'=>'Ordenar asc. o desc.'],
        'responsive'=>true,
        'showPageSummary' => true,
        'hover'=>true,
        // 'rowOptions'=>function($model){
        //     if($model->ESTADO_VENTA=='Cocina'){
        //         return ['class'=>'danger'];
        //     }
        //     if($model->ESTADO_VENTA=='Reparto'){
        //         return ['class'=>'warning'];
        //     }
        //     if($model->ESTADO_VENTA=='Terminado'){
        //         return ['class'=>'success'];
        //     }
        // },
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'ID_VENTA',
            // [
            //     'attribute'=>'ID_VENTA',
            //     'label'=>'Nº venta',
            // ],
            // 'RUT_REPARTIDOR',
            'COMPRADOR_VENTA',
            'TIPO_VENTA',
            [
                'attribute'=>'RUT_REPARTIDOR',
                'value'=>'rUTREPARTIDOR.NOMBRE_REPARTIDOR',
                'label'=>'Repartidor',
            ],
            //'FECHA_VENTA:datetime',
            'DIRECCION_VENTA',
            'TELEFONO_VENTA',
            //'VENDEDOR_VENTA',
            // 'OBSERVACION_VENTA',
            
            // 'ESTADO_VENTA',
            'HESTIM_VENTA:time',
            [
                // 'format'=>'html',
                'format'=>'raw',
                'attribute'=>'ESTADO_VENTA',
                'value'=>function ($model, $key, $index, $column){
                    $color='default';
                    $estado=0;
                    if($model->ESTADO_VENTA=='Cocina'){
                        $color='danger';
                        $estado=1;
                    }
                    if($model->ESTADO_VENTA=='Reparto'){
                        $color='warning';
                        $estado=2;
                    }
                    if($model->ESTADO_VENTA=='Terminado'){
                        $color='success';
                        $estado=3;
                    }
                    if($model->ESTADO_VENTA=='Rechazado'){
                        $color='default';
                        $estado=4;
                    }
                    // return "<a class='btn btn-".$color." btn-md'>".$model->ESTADO_VENTA."</a>";
                    $texto='stringgg';
                    return "<div id='venta".$model->ID_VENTA."' class='btn btn-".$color." btn-md' onclick='botonazo(".$model->ID_VENTA.", ".$estado.")'>".$model->ESTADO_VENTA."</div>";
                },
                'label'=>'Estado',
                'filter'=>false,
                'enableSorting'=>true,
            ],
            //'TOTAL_VENTA:integer',
            [
                'attribute'=>'TOTAL_VENTA',
                'value'=>'TOTAL_VENTA',
                'pageSummary'=>true,
                ],
            'MEDIOPAGO_VENTA',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>"Opción",
            'headerOptions'=>['style'=>'color:#3c8dbc', 'title'=>""],
            'template' => '{view} {update} {imprimir}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return '<a title="Ver" href="'.Url::to(['venta/boleta', 'id'=>$model->ID_VENTA]).'"><i class="glyphicon glyphicon-eye-open"></i></a>';
                },
                'imprimir' => function($url, $model, $key) {     // render your custom button
                    // return '<a title="Imprimir" href="'.Url::to(['venta/boletaprint', 'id'=>$model->ID_VENTA]).'"><i class="fa fa-print"></i></a>';
                    return '<a title="Imprimir" onclick=javascript:imprimir2("'.Url::to(['venta/boletaprint', 'id'=>$model->ID_VENTA]).'") ><i class="fa fa-print"></i></a>';
                },
            ],
            ],
        ],
    ]); ?>


</div>
<script>
    function botonazo(id, estado){
        if (estado==1)
        {
            // $('#venta'+id).html('<a href="#" class="btn btn-warning btn-md">Reparto</a>');   
            $('#venta'+id).replaceWith('<div id="venta'+id+'" class="btn btn-warning btn-md" onclick="botonazo('+id+', 2)">Reparto</div>');
            estado='Reparto';
        }
        if (estado==2)
        {
            // $('#venta'+id).html('<a href="#" class="btn btn-success btn-md">Terminado</a>');
            $('#venta'+id).replaceWith('<div id="venta'+id+'" class="btn btn-success btn-md" onclick="botonazo('+id+', 3)">Terminado</div>');
            estado='Terminado';
        }
        if (estado!=3 && estado!=4) {
            $.ajax({
                type: 'POST', 
                url: '<?= Url::to(['venta/estados'])?>'+'&id='+id+'&estado='+estado,
                data: {},
                dataType: 'json',
                beforeSend: function() {
                },      
                complete: function() {
                },          
                success: function(datos) { 
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    
                }
            });
        }
    }

    function imprimir2(url) {
        console.log("print");
        var printWindow = window.open(url, 'popimpr');
        printWindow.addEventListener('load', function(){
            setTimeout(function(){ 
            printWindow.print();
            printWindow.close();
            }, 1);
        },);
    }

</script>

