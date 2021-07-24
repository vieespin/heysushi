<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_COMPRA') ?>

    <?= $form->field($model, 'ID_PRODUCTO') ?>

    <?= $form->field($model, 'ID_VENTA') ?>

    <?= $form->field($model, 'CANTIDAD_REQUIERE') ?>

    <?= $form->field($model, 'MONTOEXTRA_COMPRA') ?>

    <?php // echo $form->field($model, 'OBSERBACION_COMPRA') ?>

    <?php // echo $form->field($model, 'TOTAL_COMPRA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
