<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Compra */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="compra-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Agregar Producto</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'ID_PRODUCTO')->widget(Select2::classname(), [
                        'data' =>$producto,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Selecciona producto', 'onchange'=>'simular()'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Producto');
                    ?> 

                    <?php 
                    $back = Yii::$app->getUser()->getReturnUrl(null);
                    if (strpos($back, '&id_venta=') !== false) {
                        $id_venta = urldecode(explode('&id_venta=', $back)[1]);
                        echo $form->field($model, 'ID_VENTA')->hiddenInput(['value'=>empty($model->ID_VENTA)?$id_venta:$model->ID_VENTA])->label(false);
                        }
                    ?>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                   <div style="margin-top: 20px;" id='descripcion'></div>

                </div>

            </div>

            <div class="row">
                <div style="margin-bottom:15px;" class="col-lg-12" id="ingredientes"></div>                
            </div>

            <!--<div class="row">-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--         <?= $form->field($model, 'BASE_COMPRA')->dropDownList([], ['prompt' => 'Seleccione la Carne']) ?>-->
            <!--    </div>-->

            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--         <?= $form->field($model, 'AGREGADOA_COMPRA')->dropDownList([], ['prompt' => 'Selecciona agregado A']) ?>-->

            <!--    </div>-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--            <?= $form->field($model, 'AGREGADOB_COMPRA')->dropDownList([], ['prompt' => 'Selecciona agregado B']) ?>-->

            <!--    </div>-->


            <!--</div>-->
            <!--<div class="row" >-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--        <?= $form->field($model, 'SALSAS_COMPRA')->dropDownList([], ['prompt' => 'Selecciona agregado B']) ?>-->

            <!--    </div>-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--        <?= $form->field($model, 'AGREGADOA2_COMPRA')->dropDownList([], ['prompt' => 'Selecciona agregado B']) ?>-->

            <!--    </div>-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--        <?= $form->field($model, 'AGREGADOB2_COMPRA')->dropDownList([], ['prompt' => 'Selecciona agregado B']) ?>-->
            <!--    </div>-->
            <!--</div>-->

            <!--<div  id="salsas_papas" class="row" >-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--        <?= $form->field($model, 'SALSAA_COMPRA')->dropDownList([], ['prompt' => 'Selecciona la salsa']) ?>-->

            <!--    </div>-->
            <!--    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
            <!--        <?= $form->field($model, 'SALSAB_COMPRA')->dropDownList([], ['prompt' => 'Selecciona la salsa']) ?>-->

            <!--    </div>-->
            <!--</div>-->

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'CANTIDAD_REQUIERE')->textInput(['value'=>empty($model->CANTIDAD_REQUIERE)?1:$model->CANTIDAD_REQUIERE, 'onchange'=>'total()', 'type'=>'number']) ?>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'MONTOEXTRA_COMPRA')->textInput(['value'=>empty($model->MONTOEXTRA_COMPRA)?0:$model->MONTOEXTRA_COMPRA,'onchange'=>'total()']) ?>

                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php // echo $form->field($model, 'OBSERBACION_COMPRA')->textArea(['maxlength' => true, 'rows'=>3]) ?>

                </div> -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'TOTAL_COMPRA')->textInput(['readonly'=>'readonly']) ?>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'OBSERBACION_COMPRA')->textArea(['maxlength' => true, 'rows'=>3]) ?>

                </div>
            </div>
            
            
        </div>
    </div>


    <div class="form-group">
        <?= Html::a('Cancelar', ['site/index'], ['class' => 'btn btn-default btn-block']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Agregar', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <input type="hidden" id="total" value="0" disabled>
    <input type="hidden" id="tipo" value="0" disabled>

</div>


<script>


    $(document).ready(function() {
        $("#total").hide();
        $("#tipo").hide();
        $('#ingredientes').hide();

        //re-obtener si productos es de tipo bowl en update
        var id=$('#compra-id_producto').val();
        if(id==71 || id==72 || id==73 || id==74 || id==75){
            console.log('no es nulo, es bowl '+id);
            $('.field-compra-base_compra').show();
            $('.field-compra-agregadoa_compra').show();
            $('.field-compra-agregadob_compra').show();
            
            // Mostrar campos extras solo si tiene id 73->Sandwich
            if(id==73){
                $('.field-compra-salsas_compra').show();
                $('.field-compra-agregadoa2_compra').show();
                $('.field-compra-agregadob2_compra').show();
            }else{
                $('.field-compra-salsas_compra').hide();
                $('.field-compra-agregadoa2_compra').hide();
                $('.field-compra-agregadob2_compra').hide();
            }

            // ocultar de papas
            $('.field-compra-salsaa_compra').hide();
            $('.field-compra-salsab_compra').hide();
            // 

            bowl(id,function(){
                // AUTOSELECT EN UPDATE
                var base='<?=$model->BASE_COMPRA?>';
                $('#compra-base_compra').val(base);
                $('#compra-base_compra').trigger("change");

                var a='<?=$model->AGREGADOA_COMPRA?>';
                $('#compra-agregadoa_compra').val(a);
                $('#compra-agregadoa_compra').trigger("change");

                var b='<?=$model->AGREGADOB_COMPRA?>';
                $('#compra-agregadob_compra').val(b);
                $('#compra-agregadob_compra').trigger("change");

                var salsa='<?=$model->SALSAS_COMPRA?>';
                $('#compra-salsas_compra').val(salsa);
                $('#compra-salsas_compra').trigger("change");
                
                var a2='<?=$model->AGREGADOA2_COMPRA?>';
                $('#compra-agregadoa2_compra').val(a2);
                $('#compra-agregadoa2_compra').trigger("change");

                var b2='<?=$model->AGREGADOB2_COMPRA?>';
                $('#compra-agregadob2_compra').val(b2);
                $('#compra-agregadob2_compra').trigger("change");

            });
        }else if(id==90){
            console.log('no es nulo, es papa '+id);
            $('.field-compra-base_compra').show();
            $('.field-compra-agregadoa_compra').show();
            $('.field-compra-agregadob_compra').show();
            $('.field-compra-salsaa_compra').show();
            $('.field-compra-salsab_compra').show();

            // ocultar de bowl
            $('.field-compra-salsas_compra').hide();
            $('.field-compra-agregadoa2_compra').hide();
            $('.field-compra-agregadob2_compra').hide();
            // 
            papas(id,function(){
                console.log('autoselect');

                var carne='<?=$model->BASE_COMPRA?>';
                $('#compra-base_compra').val(carne);
                $('#compra-base_compra').trigger("change");

                var agrega='<?=$model->AGREGADOA_COMPRA?>';
                $('#compra-agregadoa_compra').val(agrega);
                $('#compra-agregadoa_compra').trigger("change");

                var agregb='<?=$model->AGREGADOB_COMPRA?>';
                $('#compra-agregadob_compra').val(agregb);
                $('#compra-agregadob_compra').trigger("change");

                var salsaa='<?=$model->SALSAA_COMPRA?>';
                $('#compra-salsaa_compra').val(salsaa);
                $('#compra-salsaa_compra').trigger("change");

                var salsab='<?=$model->SALSAB_COMPRA?>';
                $('#compra-salsab_compra').val(salsab);
                $('#compra-salsab_compra').trigger("change");
            });

        }else{
        // 
            $(".field-compra-base_compra").hide();
            $('.field-compra-agregadoa_compra').hide();
            $('.field-compra-agregadob_compra').hide();
            $('.field-compra-salsas_compra').hide();
            $('.field-compra-agregadoa2_compra').hide();
            $('.field-compra-agregadob2_compra').hide();
            $('.field-compra-salsaa_compra').hide();
            $('.field-compra-salsab_compra').hide();
        }

        // recalcular precio en update
        var cantidad=$('#compra-cantidad_requiere').val();
        var extra=$('#compra-montoextra_compra').val();
        var total=$('#compra-total_compra').val();
        var limpio=eval(total-extra);
        var precio=eval(limpio/cantidad);
        $('#total').val(precio);
        console.log(precio);
        // 
    });

    function simular(){

    var id=$('#compra-id_producto').val();

    $.ajax({
        type: "POST",
        url: '<?= Url::to(['producto/precio'])?>'+'&id='+id,
        data: {},
        dataType: 'json',
        beforeSend: function() {
        },     
        success: function(datos) {
            console.log(datos);
            $('#compra-total_compra').val(datos.precio);
            $('#descripcion').html(datos.descripcion);
            $('#compra-cantidad_requiere').val(1);
            $('#compra-montoextra_compra').val(0);
            $('#total').val(datos.precio);
            $('#tipo').val(datos.tipo);

            // Si es bowl hay que mostrar Base + A + B + Ensalada
            if (datos.tipo==1 || datos.tipo==2 ||datos.tipo==3 ||datos.tipo==4
                && id==71 || id==72 || id==73 || id==74 || id==75) {

                $('.field-compra-base_compra').show();
                $('.field-compra-agregadoa_compra').show();
                $('.field-compra-agregadob_compra').show();
                // if(id==73){
                //     $('.field-compra-salsas_compra').show();
                //     $('.field-compra-agregadoa2_compra').show();
                //     $('.field-compra-agregadob2_compra').show();
                // }else{
                //     $('.field-compra-salsas_compra').hide();
                //     $('.field-compra-agregadoa2_compra').hide();
                //     $('.field-compra-agregadob2_compra').hide();
                // }
                bowl(id,function(){});
            }else if(datos.tipo==5 && id==90) {
                $('.field-compra-base_compra').show();
                $('.field-compra-agregadoa_compra').show();
                $('.field-compra-agregadob_compra').show();
                $('.field-compra-salsaa_compra').show();
                $('.field-compra-salsab_compra').show();
                papas(id,function(){});
            }
            else{
                $(".field-compra-base_compra").hide();
                $('.field-compra-agregadoa_compra').hide();
                $('.field-compra-agregadob_compra').hide();
                $('.field-compra-salsas_compra').hide();
                $('.field-compra-agregadoa2_compra').hide();
                $('.field-compra-agregadob2_compra').hide();
                $('.field-compra-salsaa_compra').hide();
                $('.field-compra-salsab_compra').hide();

            }
             
            
            console.log($('#total').val());
        },
        error: function(xhr, ajaxOptions, thrownError) {
            //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

    function bowl(id, callback){

        $.ajax({
            // type: "POST",
            url: '<?= Url::to(['requiere/ajaxbowl'])?>'+'&id_producto='+id,
            data: {},
            dataType: 'json',
            beforeSend: function() {
            },     
            success: function(array) {
                console.log(array);
                $('#compra-base_compra').html(array.base);
                $('#compra-agregadoa_compra').html(array.a);
                $('#compra-agregadob_compra').html(array.b);
                $('#compra-salsas_compra').html(array.salsa);
                $('#compra-agregadoa2_compra').html(array.a2);
                $('#compra-agregadob2_compra').html(array.b2);
                console.log('PASO 2');
                callback();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function papas(id, callback){
        $.ajax({
            // type: "POST",
            url: '<?= Url::to(['requiere/ajaxpapas'])?>'+'&id_producto='+id,
            data: {},
            dataType: 'json',
            beforeSend: function() {
            },     
            success: function(array) {
                console.log(array);
                $('#compra-base_compra').html(array.carne);
                $('#compra-agregadoa_compra').html(array.agregados);
                $('#compra-agregadob_compra').html(array.agregados);
                $('#compra-salsaa_compra').html(array.salsas);
                $('#compra-salsab_compra').html(array.salsas);
                callback();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });  
    }


    function total(){
    var cantidad=$('#compra-cantidad_requiere').val();
    var precio=$('#total').val();
    console.log(precio);
    var extra=$('#compra-montoextra_compra').val();

    $('#compra-total_compra').val(eval(precio*cantidad) + eval(extra));
}
</script>