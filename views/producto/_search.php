<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PRODUCTO') ?>

    <?= $form->field($model, 'ID_TPRODUCTO') ?>

    <?= $form->field($model, 'NOMBRE_PRODUCTO') ?>

    <?= $form->field($model, 'NUMSUB_PRODUCTO') ?>

    <?= $form->field($model, 'DESCRIPCION_PRODUCTO') ?>

    <?php // echo $form->field($model, 'NUMPROT_PRODUCTO') ?>

    <?php // echo $form->field($model, 'NUMVEG_PRODUCTO') ?>

    <?php // echo $form->field($model, 'NUMSALSAS_PRODUCTO') ?>

    <?php // echo $form->field($model, 'PRECIO_PRODUCTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
