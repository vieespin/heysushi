<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="box box-primary">
        <div class="box-header with-border">
                  <h3 class="box-title">Formulario</h3>
        </div>
        <div class="box-body">

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php $vars =['si' => 'Si', 'no' => 'No'];
        echo $form->field($model, "activate")->dropDownList($vars, ['prompt' => 'Seleccione estado' ]);?> 


    <?php $var =['Admin'=> 'Administración', 'Simple'=>'Básico'];
        echo $form->field($model, "role")->dropDownList($var, ['prompt' => 'Seleccione el nivel de acceso' ]);?>

        </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a("Cancelar", ['usuario/index'], ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
