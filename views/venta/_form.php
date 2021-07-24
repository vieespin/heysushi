<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\daterange\DateRangePicker;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
        <div class="box box-primary ">
    <div class="box-header with-border">
              <h3 class="box-title">Venta: Nº: <?=$model->ID_VENTA ?></h3>
              <div class="pull-right box-tools">
              </div>
    </div>
        <div class="box-body">
        <div class="venta-form">

            <?php $form = ActiveForm::begin(['id'=>'venta-boleta']); ?>

            <?= $form->field($model, 'TIPO_VENTA')->radioList(['Local'=>'Local', 'Retira'=> 'Retira', 'Delivery'=>'Delivery'], [/*'separator' => '<br>',*/ 'onchange' => "ajustar()"]); ?>

            <?= $form->field($model, 'COMPRADOR_VENTA')->textInput(['maxlength' => true, 'onchange'=>'nombre()']) ?>

            <?= $form->field($model, 'RUT_REPARTIDOR')->widget(Select2::classname(), [
                    'data' =>$repartidores,
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['placeholder' => 'Selecciona Repartidor'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Repartidor');
                ?>             

<!--             <?= $form->field($model, 'FECHA_VENTA')->textInput() ?> -->

            <?= $form->field($model, 'DIRECCION_VENTA')->textInput(['maxlength' => true, 'onchange'=> 'direccion()']) ?>

            <?= $form->field($model, 'TELEFONO_VENTA')->textInput(['maxlength' => true, 'onchange'=> 'telefono()']) ?>

<!--             <?= $form->field($model, 'VENDEDOR_VENTA')->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'OBSERVACION_VENTA')->textArea(['maxlength' => true, 'onchange'=> 'observaciones()', 'rows'=>3]) ?>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- <?= $form->field($model, 'HESTIM_VENTA')->textInput(['type'=>'time', 'value'=>empty($model->HESTIM_VENTA)? date('H:i', strtotime('60 minute')):$model->HESTIM_VENTA, 'onchange'=> 'hora()']) ?> -->
            <?= $form->field($model, 'HESTIM_VENTA')->textInput(['type'=>'time', 'onchange'=> 'hora()']) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'MEDIOPAGO_VENTA')->dropDownList(['Efectivo'=>'Efectivo', 'Redcompra'=>'Redcompra', 'Transferencia'=>'Transferencia',] ,['onchange'=> 'mediodepago()', 'prompt' => 'Selecciona']) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'ESTADO_VENTA')->dropDownList(['Cocina'=>'Cocina', 'Reparto'=>'Reparto', 'Terminado'=>'Terminado', 'Rechazado'=>'Rechazado'],['prompt' => 'Selecciona el estado']) ?>
            </div>

            <?= $form->field($model, 'TOTAL_VENTA')->textInput(['readonly'=>'readonly']) ?>

            <div class="form-group">
                <?= Html::a('Cancelar', ['site/index'], ['class' => 'btn btn-default btn-block']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Finalizar', ['class' => 'btn btn-success btn-block']) ?>
            </div>
            <div class="form-group">
   <!--               <a href="javascript:imprSelec('seleccion')" onclick="document.getElementById('venta-boleta').submit();"><div class="btn btn-primary btn-block"><i class="fa fa-print"></i>Finalizar e Imprimir</div></a> -->
              
                 <a onclick="javascript:imprSelec('seleccion')">
                 <div class="btn btn-primary btn-block"><i class="fa fa-print"></i>Imprimir</div></a>
              

               <!--   <a href="javascript:print('<?=Url::to(['venta/boletaprint', 'id'=>$model->ID_VENTA])?>')" onclick="document.getElementById('venta-boleta').submit();"><div class="btn btn-primary btn-block"><i class="fa fa-print"></i>Finalizar e Imprimir</div></a>  -->
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" id="seleccion">
        <div class="box box-primary" style="font-family:courier new; font-weight: 600;">
            <p class="text-center"><b>Hey Sushi Delivery</b></p>
            <p>RUT: 77.161.382-9 <br>
            DIRECCIÓN:  Las palmeras 656 Talcahuano <br>
            GIRO: Comida rápida <br>
            TELÉFONO: +569 6440 4006
            </p>
            <p class="text-center"><b>FECHA:<?= date('d-m-Y')?>   PEDIDO Nº<?= $model->ID_VENTA?></b></p>
            <table class="table">
                <thead>
                  <tr>
                    <th style="border-bottom: 1px solid black;">PRODUC</th>
                    <th style="border-bottom: 1px solid black;">DETALLE</th>
                    <th style="border-bottom: 1px solid black;">OBSERV</th>
                    <th style="border-bottom: 1px solid black;">CANT</th>
                    <!-- <th style="border-bottom: 1px solid black;">PRECIO</th> -->
                  </tr>
                </thead>
                <tbody style="padding-top: 0px;">
                        <?php foreach ($productos as $compra) { ?>  
                        <tr>
                            <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;"><?=$compra->pRODUCTO->NOMBRE_PRODUCTO?></td>
                            
                            <!-- V2 -->
                            <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;">
                                <?= $compra->BASE_COMPRA?> 
                                <?= empty($compra->AGREGADOA_COMPRA)?'':' + '.$compra->AGREGADOA_COMPRA?>
                                <?= empty($compra->AGREGADOB_COMPRA)?'':' + '.$compra->AGREGADOB_COMPRA?>
                                <?= empty($compra->SALSAS_COMPRA)?'':', '.$compra->SALSAS_COMPRA?>
                                <?= empty($compra->AGREGADOA2_COMPRA)?'':' + '.$compra->AGREGADOA2_COMPRA?>
                                <?= empty($compra->AGREGADOB2_COMPRA)?'':' + '.$compra->AGREGADOB2_COMPRA?>
                                <?= empty($compra->SALSAA_COMPRA)?'':' + '.$compra->SALSAA_COMPRA?>
                                <?= empty($compra->SALSAB_COMPRA)?'':' + '.$compra->SALSAB_COMPRA?>
                            </td>

                            <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;"><?=$compra->OBSERBACION_COMPRA?></td>
                            <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;"><?=$compra->CANTIDAD_REQUIERE?></td>
                            <!-- <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;">$<?=$compra->TOTAL_COMPRA?></td> -->
                        </tr>
                        <?php }  ?>
                      <tr>
                          <td colspan="3" class="text-right"><b>TOTAL</b></td>
                          <td><b>$<?= $model->TOTAL_VENTA?></b>.-</td>
                      </tr>
                </tbody>
            </table>
            <p id="hora">
            <p>
            <p id="nombre">
                
            </p>
            <p class="text-center" id="reparto"><b>DATOS ADICIONALES</b></p>


            <table class="table" id="adicionales" style="font-weight: 600">
                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td ><b>Dirección:</b><td id="dir"></td></td>
                    </tr>
                    <tr>
                        <td><b>Telefono:</b><td id="tel"></td></td>
                    </tr>
                    <tr>
                        <td><b>Observaciones:</b><td id="obs"></td></td>
                    </tr>
                    <tr>
                        <td><b>Medio de pago:</b> <td id="pay"></td></td>
                    </tr>
                    <!-- <tr>
                        <td><b>Hora estimada:</b> <td id="hora"></td></td>
                    </tr> -->
                </tbody>
            </table>
            <p class="text-center">www.smartbitsoluciones.cl</p>
            <!-- <a href="javascript:imprSelec('seleccion')"><i class="fa fa-print"></i>Imprimir esta página</a> -->
        </div>
    </div>
</div>


<script>
    $( document ).ready(function() {
        var tipo = $("input[name='Venta[TIPO_VENTA]']:checked").parent().text();
        if (tipo.match(/local/gi)) {
            ocultarvarios();
        }
        if (tipo.match(/retira/gi)) {
            ocultarvarios();
        }
        if (tipo.match(/delivery/gi)) {
            mostrarvarios();
        }
        direccion();
        nombre();
        telefono();
        observaciones();
        mediodepago();
        hora();
    });


    function ajustar() {
        var tipo = $("input[name='Venta[TIPO_VENTA]']:checked").parent().text();
        if (tipo.match(/local/gi)) {
            console.log('local');
            ocultarvarios();
            // hora estimda 10 min
            var newhr = '<?php echo empty($model->FECHA_VENTA)? date('H:i', strtotime('10 minute')):date('H:i',strtotime('10 minute',strtotime($model->FECHA_VENTA)))?>';
            console.log(newhr);
            $('#venta-hestim_venta').val(newhr);
            hora();
        }
        if (tipo.match(/retira/gi)) {
            console.log('retira');
            ocultarvarios();
            // hora estimda 10 min
            var newhr = '<?php echo empty($model->FECHA_VENTA)? date('H:i', strtotime('30 minute')):date('H:i',strtotime('30 minute',strtotime($model->FECHA_VENTA)))?>';
            console.log(newhr);
            $('#venta-hestim_venta').val(newhr);
            hora();
        }
        if (tipo.match(/delivery/gi)) {
            console.log('delivery');
            mostrarvarios();
            // hora estimda 10 min
            var newhr = '<?php echo empty($model->FECHA_VENTA)? date('H:i', strtotime('60 minute')):date('H:i',strtotime('60 minute',strtotime($model->FECHA_VENTA)))?>';
            console.log(newhr);
            $('#venta-hestim_venta').val(newhr);
            hora();
        }
    }

    function direccion(){
          var id=$('#venta-direccion_venta').val();
          $('#dir').html(id);
    }
    function nombre(){
          var id=$('#venta-comprador_venta').val();
          $('#nombre').html("Nombre: "+id);
    }
    function telefono(){
          var id=$('#venta-telefono_venta').val();
          $('#tel').html(id);
    } 
    function observaciones(){
          var id=$('#venta-observacion_venta').val();
          $('#obs').html(id);
    } 
    function mediodepago(){
          var id=$('#venta-mediopago_venta').val();
          $('#pay').html(id);
    } 
    function hora(){
          var id=$('#venta-hestim_venta').val();
          $('#hora').html("Hora estimada: "+id);
    }
    function mostrarvarios(){
        // mostrar repartidor
        $('.field-venta-rut_repartidor').show();
        // mostrar direccion
        $('.field-venta-direccion_venta').show();
        // mostrar telefono
        $('.field-venta-telefono_venta').show();
        // mostrar observacion
        $('.field-venta-observacion_venta').show();
        $('#reparto').show();
        $('#adicionales').show();
    }
    function ocultarvarios(){
        // ocultar y limpiar repartidor
        $('#venta-rut_repartidor').val("").change();
        $('.field-venta-rut_repartidor').hide();
        // ocultar y limpiar direccion
        $('#venta-direccion_venta').val("");
        $('.field-venta-direccion_venta').hide();
        // ocultar y limpiar telefono
        $('#venta-telefono_venta').val("");
        $('.field-venta-telefono_venta').hide();
        // ocultar y limpiar observacion
        $('#venta-observacion_venta').val("");
        $('.field-venta-observacion_venta').hide();
        $('#reparto').hide();
        $('#adicionales').hide();
    }
    function imprSelec(nombre) {
      var ficha = document.getElementById(nombre);
      var ventimp = window.open('', 'popimpr');
      ventimp.document.write(ficha.innerHTML);
      // ventimp.document.close();
      ventimp.print();
      // ventimp.print();
      // ventimp.close();
      // ventimp.close();
      // ventimp.close();
    }

    // function print(url) {
    //     console.log("print");
    //     var printWindow = window.open(url, 'popimpr');
    //     printWindow.addEventListener('load', function(){
    //         printWindow.print();
    //         printWindow.close();
    //     }, true);
    // }

    // function imprimir2(url) {
    //     console.log("print");
    //     var printWindow = window.open(url, 'popimpr');
    //     printWindow.addEventListener('load', function(){
    //         setTimeout(function(){ 
    //         printWindow.print();
    //         printWindow.print();
    //         printWindow.close();
    //         }, 1);
    //     },);
    // }


</script>