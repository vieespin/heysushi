<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contiene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contiene-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_COMPRA')->textInput() ?>

    <?= $form->field($model, 'ID_INGREDIENTE')->textInput() ?>

    <?= $form->field($model, 'SUB_UNIDAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
