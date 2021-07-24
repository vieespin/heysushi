<?php
use yii\helpers\Html;

$this->title="Boleta Nº ".$model->ID_VENTA;
?>

<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" id="seleccion">
        <div class="box box-primary" style="font-family:courier new; font-weight: 600;">
            <p class="text-center"><b>HEY SUSHI DELIVERY TALCAHUANO</b></p>
            <p>RUT: 77.161.382-9 <br>
            DIRECCIÓN: Las palmeras 656 Talcahuano <br>
            GIRO: Ventas de alimentos y bebidas <br>
            TELÉFONO: +56 9 6440 4006 
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
                            <td style="padding-top: 0px; font-weight: 600; border-bottom: 1px solid black;"><?=$compra->pRODUCTO->NOMBRE_PRODUCTO?></td>
                            
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

                            <td style="padding-top: 0px; font-weight: 600; border-bottom: 1px solid black;"><?=$compra->OBSERBACION_COMPRA?></td>
                            <td style="padding-top: 0px; font-weight: 600; border-bottom: 1px solid black;"><?=$compra->CANTIDAD_REQUIERE?></td>
                            <!-- <td style="padding-top: 0px; font-weight: 600;  border-bottom: 1px solid black;">$<?=$compra->TOTAL_COMPRA?></td> -->
                        </tr>
                        <?php }  ?>
                      <tr>
                          <td colspan="3" class="text-right"><b>TOTAL</b></td>
                          <td><b>$<?= $model->TOTAL_VENTA?></b>.-</td>
                      </tr>
                </tbody>
            </table>
            <!--<p id="hora"><?php echo "Hora estimada: ".date('H:i',strtotime($model->HESTIM_VENTA))?>-->
            <!--</p>-->
            <p id="nombre"><?php echo "Nombre: ".$model->COMPRADOR_VENTA?>
            </p>
            <?php if($model->TIPO_VENTA=='Delivery'):?>
	            <p class="text-center" id="reparto"><b>DATOS DELIVERY</b></p>


	            <table class="table" id="adicionales" style="font-weight: 600">
	                <thead>
	                    
	                </thead>
	                <tbody>
	                    <tr>
	                        <td ><b>Dirección:</b><td id="dir"><?= $model->DIRECCION_VENTA?></td></td>
	                    </tr>
	                    <tr>
	                        <td><b>Telefono:</b><td id="tel"><?= $model->TELEFONO_VENTA?></td></td>
	                    </tr>
	                    <tr>
	                        <td><b>Observaciones:</b><td id="obs"><?= $model->OBSERVACION_VENTA?></td></td>
	                    </tr>
	                    <tr>
	                        <td><b>Medio de pago:</b> <td id="pay"><?= $model->MEDIOPAGO_VENTA?></td></td>
	                    </tr>
	                    <!-- <tr>
	                        <td><b>Hora estimada:</b> <td id="hora"></td></td>
	                    </tr> -->
	                </tbody>
	            </table>
	            
        	<?php endif ?>
            <p class="text-center">www.smartbitsoluciones.cl</p>
             <!--<a href="javascript:imprSelec('seleccion')"><i class="fa fa-print"></i>Imprimir esta página</a> -->

        </div>
    </div>
</div>