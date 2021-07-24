<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Registro de usuarios';
?>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => false,
 'enableAjaxValidation' => true,
]);
?>

<div class="box box-primary">
        <div class="box-header with-border">
                  <h3 class="box-title">Formulario</h3>
        </div>
        <div class="box-body">

			<div class="form-group">
			 <?= $form->field($model, "username")->input("text") ?>   
			</div>

			<div class="form-group">
			 <?= $form->field($model, "email")->input("email") ?>   
			</div>

			<div class="form-group">
			<?php $var =['Admin'=> 'Administración', 'Simple'=>'Básico'];
        	echo $form->field($model, "role")->dropDownList($var, ['prompt' => 'Seleccione el nivel de acceso' ])?>
       		</div>

			<div class="form-group">
			 <?= $form->field($model, "password")->input("password") ?>   
			</div>

			<div class="form-group">
			 <?= $form->field($model, "password_repeat")->input("password") ?>   
			</div>
	</div>
</div>

<div class="form-group">
        <?= Html::submitButton("Registrar", ["class" => "btn btn-primary"]) ?>
		<?= Html::a("Cancelar", ['usuario/index'], ['class' => 'btn btn-default'])?>
</div>

<?php $form->end() ?>