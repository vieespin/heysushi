<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */

$this->title = '';
?>
    <div class="row" id="menu">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Venta Nº <?php 
                    $back = Yii::$app->getUser()->getReturnUrl(null);
                    if (strpos($back, '&id_venta=') !== false) {
                        $id_venta = urldecode(explode('&id_venta=', $back)[1]);
                        echo $id_venta; //Venta Nº 69
                        }?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="col-lg-6 col-xs-6" onclick="activar_promos()">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Promos  </h3>

                      <p>Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-6 col-xs-6" onclick="activar_rolls()">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Rolls</h3>

                      <p>Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>3, 'texto'=>'']) ?>">
                  <div class="small-box bg-purple">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color: white">Snack</h3>

                      <p style="color: white">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-happy"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </a>
                </div>

                <div class="col-lg-4 col-xs-6" onclick="activar_handroll()">
                  <!-- small box -->
                  <div class="small-box bg-maroon">
                    <div class="inner">
                      <h3>Handroll</h3>

                      <p>Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>5, 'texto'=>'']) ?>">
                  <div class="small-box bg-gray">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color: black">Ceviches</h3>

                      <p style="color: black">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-spoon"></i>
                    </div>
                    <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </a>
                </div>

                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>6, 'texto'=>'']) ?>">
                  <div class="small-box bg-red">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color: white">Bebidas</h3>

                      <p style="color: white">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-beer"></i>
                    </div>
                    <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </a>
                </div>

                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>7, 'texto'=>'']) ?>">
                  <div class="small-box bg-blue">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color: white">Adicionales</h3>

                      <p style="color: white">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-plus-circled"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </a>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showPageSummary' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'ID_COMPRA',
                        //'ID_PRODUCTO',
                        ['attribute'=> 'ID_PRODUCTO', 
                          'label' => 'Producto',
                          'value' => 'pRODUCTO.NOMBRE_PRODUCTO'],
                        //'ID_VENTA',
                        'CANTIDAD_REQUIERE',
                        'MONTOEXTRA_COMPRA',
                        //'OBSERBACION_COMPRA',
                        //'TOTAL_COMPRA',
                        [
                          'attribute'=>'TOTAL_COMPRA',
                          'pageSummary' => true
                        ],

                        ['class' => 'yii\grid\ActionColumn',
                        'header'=>"Opciones",
                        'headerOptions'=>['style'=>'color:#3c8dbc'],
                        'template' => '{update} {myButton}', 
                        // 'visibleButtons' => [
                        //   'view'=>false,
                        //  ],
                        'buttons' => [
                          'myButton' => function($url, $model, $key) {     // render your custom button
                            return Html::a('', ['venta/borrar', 'id' => $model->ID_COMPRA], [
                                  'class' => 'glyphicon glyphicon-trash',
                                  'title'=>'Eliminar',
                                  'data' => [
                                      'confirm' => 'Seguro que quieres eliminar este producto?',
                                      // 'method' => 'get',
                                  ],
                              ]);
                            }
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                          if ($action === 'update') {
                              $url = Url::to(['compra/update', 'id'=>$model->ID_COMPRA, 'id_producto'=>$model->pRODUCTO->ID_PRODUCTO]);
                              return $url;
                          }
                          // if ($action === 'delete') {
                          //     $url = Url::to(['venta/borrar', 'id'=>$model->ID_COMPRA]);
                          //     return $url;
                          // }

                        }
                        ],
                    ],
                ]); ?>
                <p></p>
                <?php if ($num_ventas>0) {
                  echo Html::a('Finalizar compras', ['site/finalizar'], ['class' => 'btn btn-danger btn-block', 'data' => [
                    'confirm' => '¿Seguro que quieres finalizar esta compra?'],]);
                }
                ?>
              </div>
            </form>
          </div>
        </div>
    </div>
          <!-- /.box -->

    <div class="row" id="promos">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Promos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <a href="<?php echo Url::to(['compra/create', 'tipo'=>1, 'texto'=>'chef']) ?>">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Elección del chef  </h3>

                      <p style="color:white" >Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="<?php echo Url::to(['compra/create', 'tipo'=>1, 'texto'=>'chef']) ?>" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                </a>
                <!-- ./col -->
              <a href="<?php echo Url::to(['compra/create', 'tipo'=>1, 'texto'=>'elige']) ?>">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Elige los ingredientes<sup style="font-size: 20px"></sup></h3>

                      <p style="color:white">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="<?php echo Url::to(['compra/create', 'tipo'=>1, 'texto'=>'elige']) ?>" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div onclick="regresar_promos()" class="btn btn-danger btn-block">regresar</div>
              </div>
            </form>
          </div>
        </div>
    </div>


    <div class="row" id="handroll">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Hand roll</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <a href="<?php echo Url::to(['compra/create', 'tipo'=>2, 'texto'=>'']) ?>">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Elección del chef  </h3>

                      <p style="color:white" >Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                </a>
                <!-- ./col -->
              <a href="<?php echo Url::to(['compra/create', 'tipo'=>2, 'texto'=>'elige']) ?>">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Elige los ingredientes<sup style="font-size: 20px"></sup></h3>

                      <p style="color:white">Nueva Orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div onclick="regresar_handroll()" class="btn btn-danger btn-block">regresar</div>
              </div>
            </form>
          </div>
        </div>
    </div>




    <div class="row" id="rolls">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Rolls</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>5, 'texto'=>'frio']) ?>">
                  <div class="small-box bg-aqua">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Frios </h3>

                      <p style="color:white">Nueva orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="<?php echo Url::to(['compra/create', 'tipo'=>1]) ?>" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>5, 'texto'=>'caliente']) ?>">
                  <div class="small-box bg-red">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:white">Calientes<sup style="font-size: 20px"></sup></h3>

                      <p style="color:white">Nueva orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="<?php echo Url::to(['compra/create', 'tipo'=>1]) ?>" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </a>
                </div>

                <div class="col-lg-6 col-xs-6 col-lg-offset-3">
                  <!-- small box -->
                  <a href="<?php echo Url::to(['compra/create', 'tipo'=>5, 'texto'=>'sin']) ?>">
                  <div class="small-box bg-gray">
                    <div class="inner" style="padding: 10px;">
                      <h3 style="color:black">Sin arroz<sup style="font-size: 20px"></sup></h3>

                      <p style="color:black">Nueva orden</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cutlery"></i>
                    </div>
                    <a href="<?php echo Url::to(['compra/create', 'tipo'=>1]) ?>" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </a>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div onclick="regresar_rolls()" class="btn btn-danger btn-block">regresar</div>
              </div>
            </form>
          </div>
        </div>
    </div>

<script>
  $(document).ready(function() {
    $("#promos").hide();
    $("#bowl").hide();
    $("#rolls").hide();
    $("#handroll").hide();

  });

  function activar_promos(){
    $("#menu").hide();
    $("#promos").show();
  }

  function regresar_promos(){
    $("#promos").hide();
    $("#bowl").hide();
    $("#rolls").hide();
    $("#handroll").hide();
    $("#menu").show();
  }
  function activar_bowl(){
    $("#menu").hide();
    $("#bowl").show();
  }

  function regresar_bowl(){
    $("#promos").hide();
    $("#bowl").hide();
    $("#rolls").hide();
    $("#handroll").hide();
    $("#menu").show();
  }
  function activar_rolls(){
    $("#menu").hide();
    $("#rolls").show();
  }

  function regresar_rolls(){
    $("#promos").hide();
    $("#bowl").hide();
    $("#rolls").hide();
    $("#handroll").hide();
    $("#menu").show();
  }

  function activar_handroll(){
    $("#menu").hide();
    $("#handroll").show();
  }

  function regresar_handroll(){
    $("#promos").hide();
    $("#bowl").hide();
    $("#rolls").hide();
    $("#handroll").hide();
    $("#menu").show();
  }

</script>