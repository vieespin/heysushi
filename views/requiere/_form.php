<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Requiere */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requiere-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_PRODUCTO')->textInput() ?>

    <?= $form->field($model, 'ID_INGREDIENTE')->textInput() ?>

    <?= $form->field($model, 'CANTIDAD_REQUIERE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
