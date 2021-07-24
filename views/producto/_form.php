<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_TPRODUCTO')->textInput() ?>

    <?= $form->field($model, 'NOMBRE_PRODUCTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NUMSUB_PRODUCTO')->textInput() ?>

    <?= $form->field($model, 'DESCRIPCION_PRODUCTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NUMPROT_PRODUCTO')->textInput() ?>

    <?= $form->field($model, 'NUMVEG_PRODUCTO')->textInput() ?>

    <?= $form->field($model, 'NUMSALSAS_PRODUCTO')->textInput() ?>

    <?= $form->field($model, 'PRECIO_PRODUCTO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
