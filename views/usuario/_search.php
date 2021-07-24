<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
              <h3 class="box-title">Buscar</h3>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ajustar tamaño">
                  <i class="fa fa-plus"></i></button>
              </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <?= $form->field($model, 'username') ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <?php $vars =['si' => 'Si', 'no' => 'No'];
                echo $form->field($model, "activate")->dropDownList($vars, ['prompt' => 'Todos' ]);?> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <?php $var =['Admin'=> 'Administración', 'Simple'=>'Básico'];
                    echo $form->field($model, "role")->dropDownList($var, ['prompt' => 'Todos' ]);?>
            </div>        
        </div>
        <div class="row">
        <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10">
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                <?= Html::a("Quitar filtos", ['usuario/index'], ['class' => 'btn btn-default']);?>
            </div>
        </div>
    </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
