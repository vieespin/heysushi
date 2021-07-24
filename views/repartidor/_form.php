<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Repartidor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repartidor-form">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="box box-primary ">
				<div class="box-header with-border">
					<h3 class="box-title">Formulario</h3>
					<div class="pull-right box-tools">
                <!-- <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ajustar tamaño">
                	<i class="fa fa-plus"></i></button> -->
	                </div>
	            </div>
	            <div class="box-body">

	            	<?php $form = ActiveForm::begin(); ?>

	            	<?= $form->field($model, 'RUT_REPARTIDOR')->textInput(['maxlength' => true]) ?>

	            	<?= $form->field($model, 'NOMBRE_REPARTIDOR')->textInput(['maxlength' => true]) ?>

	            	<?= $form->field($model, 'TELEFONO_REPARTIDOR')->textInput(['maxlength' => true]) ?>

	            	<?= $form->field($model, 'VIGENTE_REPARTIDOR')->dropDownList([1=>'Si', 0=>'No'], ['prompt'=>'Seleccione el estado']) ?>

	            	<div class="form-group">
	            		<?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block']) ?>
	            	</div>

	            	<?php ActiveForm::end(); ?>
	            </div>
	        </div>
	    </div>
	</div>
</div>
