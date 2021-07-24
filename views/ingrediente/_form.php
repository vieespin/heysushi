<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ingrediente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingrediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE_INGREDIENTE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMCORTO_INGREDIENTE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UNIDMEDIDA_INGREDIENTE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIPO_INGREDIENTE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
