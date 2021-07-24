<?php
use app\models\Compra;
?>
    <?php foreach ($model as $venta) { ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
            <div class="box box-primary" style="font-family:courier new; font-weight: 600;">
                <p class="text-center"><b>PEDIDO Nº<?= $venta->ID_VENTA?></b></p>
                <table class="table">
                    <thead>
                      <tr>
                        <th style="border-bottom: 1px solid black;">PRODUC</th>
                        <th style="border-bottom: 1px solid black;">DETALLE</th>
                        <th style="border-bottom: 1px solid black;">OBSERV</th>
                        <th style="border-bottom: 1px solid black;">CANT</th>
                      </tr>
                    </thead>
                    <tbody style="padding-top: 0px;">
                            <?php 
                            $productos=Compra::find()->where(['ID_VENTA'=>$venta->ID_VENTA])->all();
                            foreach ($productos as $compra) { ?>  
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
                            </tr>
                            <?php }  ?>
                    </tbody>
                </table>
                <p id="nombre"><?php echo "Tipo: ".$venta->TIPO_VENTA?>
                </p>
                <p id="hora"><?php echo "Hora estimada: ".date('H:i',strtotime($venta->HESTIM_VENTA))?>
                </p>
                <p id="nombre"><?php echo "Nombre: ".$venta->COMPRADOR_VENTA?>
                </p>
            </div>
        </div>
    <?php }  ?>