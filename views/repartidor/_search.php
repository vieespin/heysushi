<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepartidorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repartidor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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
                    <?= $form->field($model, 'RUT_REPARTIDOR')->label('Rut') ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <?= $form->field($model, 'NOMBRE_REPARTIDOR')->label('Nombre') ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <?= $form->field($model, 'TELEFONO_REPARTIDOR')->label('Teléfono') ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <?= $form->field($model, 'VIGENTE_REPARTIDOR')->dropDownList([1=>'Si', 0=>'No'], ['prompt'=>'Todos'])->label('Vigente') ?>
                </div>
                <div class="pull-right">
                    <div class="form-group" style="margin-right: 15px; margin-top: 25px">
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a("Quitar filtos", ['repartidor/index'], ['class' => 'btn btn-default']);?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
