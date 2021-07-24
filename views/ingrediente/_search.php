<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngredienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingrediente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_INGREDIENTE') ?>

    <?= $form->field($model, 'NOMBRE_INGREDIENTE') ?>

    <?= $form->field($model, 'UNIDMEDIDA_INGREDIENTE') ?>

    <?= $form->field($model, 'TIPO_INGREDIENTE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
