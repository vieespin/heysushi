<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model app\models\VentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--     <?= $form->field($model, 'ID_VENTA') ?>
 -->
  

    <?php // echo $form->field($model, 'VENDEDOR_VENTA') ?>

    <?php // echo $form->field($model, 'OBSERVACION_VENTA') ?>

    <?php // echo $form->field($model, 'MEDIOPAGO_VENTA') ?>

    <?php // echo $form->field($model, 'ESTADO_VENTA') ?>

    <?php // echo $form->field($model, 'TOTAL_VENTA') ?>




    <!-- ////////////////////////////////////////////////////////////////////// -->

<div class="box box-primary ">
    <div class="box-header with-border">
              <h3 class="box-title">Buscar</h3>
              <div class="pull-right box-tools">
                <!-- <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ajustar tamaño">
                  <i class="fa fa-plus"></i></button> -->
              </div>
    </div>
        <div class="box-body">
            <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <!-- <?= $form->field($model, 'RUT_REPARTIDOR')->label('Vendedor') ?> -->
                <?= $form->field($model, 'VENDEDOR_VENTA')->widget(Select2::classname(), [
                        'data' =>$vendedor,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Todos'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Vendedor');
                    ?> 
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <!-- <?= $form->field($model, 'RUT_REPARTIDOR')->label('Repartidor') ?> -->
                <?= $form->field($model, 'RUT_REPARTIDOR')->widget(Select2::classname(), [
                        'data' =>$repartidores,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Todos'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Repartidor');
                    ?> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <?= $form->field($model, 'FECHA_VENTA', ['template' => '
                            <div class="col-sm-12">
                                {label}
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {input}
                                    <!-- <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span> -->
                                </div>{error}{hint}
                            </div>'])->widget(DateRangePicker::className(),[
                    'model'=>$model,
                    //'attribute'=>'finicio_prog',
                    //'useWithAddon'=>true,
                    'convertFormat'=>true,
                    'startAttribute'=>'FECHA_INI',
                    'endAttribute'=>'FECHA_FIN',
                    'pluginOptions'=>[
                        // Hora
                        'timePicker'=>true,
                        'timePickerIncrement'=>15,
                        'locale'=>['format'=>'Y-m-d h:i A'],
                        // Hora
                        // 'locale'=>['format' => 'Y-m-d'],
                        'opens'=>'right'
                    ]
                ])->label('Rango de fechas')?>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                 <?= $form->field($model, 'DIRECCION_VENTA') ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
<!--                  <?= $form->field($model, 'TELEFONO_VENTA') ?>
 -->                <?= $form->field($model, 'TELEFONO_VENTA')->widget(Select2::classname(), [
                        'data' =>$telefono,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Teléfono');
                    ?>   
                </div>
            </div>
            
            <div class="row">
                <!-- <div class="col-lg-offset-9 col-md-offset-9 col-sm-offset-10 col-xs-offset-10"> -->
                <div class="pull-left col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <?php echo $form->field($model, 'MEDIOPAGO_VENTA')->dropDownList($medio_pago, ['prompt'=>'Todos']) ?>
                </div>
                <div class="pull-right">
                    <div class="form-group" style="margin-right: 15px; margin-top: 25px">
                        <!-- <?php Pjax::begin(); ?> -->
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                        <!-- <?php Pjax::end(); ?> -->
                        <?= Html::a("Quitar filtos", ['venta/index'], ['class' => 'btn btn-default']);?>
                    </div>
                </div>  
            </div>
            
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
