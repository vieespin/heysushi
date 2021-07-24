<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use app\models\Venta;
use app\models\Compra;
use app\models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Repartidor;
use yii\helpers\ArrayHelper;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;

/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                  'class' => AccessControl::className(),
                  'only' => ['index', 'view', 'imprimir', 'update', 'delete', 'borrar', 'estados', 'boleta', 'boletaprint'],
                  'rules' => [
                    [
                                //El administrador tiene permisos sobre las siguientes acciones
                      'actions' => ['index', 'view', 'imprimir', 'update', 'delete', 'borrar', 'estados', 'boleta', 'boletaprint'],
                                //Esta propiedad establece que tiene permisos
                      'allow' => true,
                                //Usuarios autenticados, el signo ? es para invitados
                      'roles' => ['@'],
                                //Este método nos permite crear un filtro sobre la identidad del usuario
                                //y así establecer si tiene permisos o no
                      'matchCallback' => function ($rule, $action) {
                                    //Llamada al método que comprueba si es un administrador
                        return User::isUserAdmin(Yii::$app->user->identity->id);
                      },
                    ],
                    [
                               //Los usuarios simples tienen permisos sobre las siguientes acciones
                     'actions' => ['index', 'view', 'imprimir', 'update', 'delete', 'borrar', 'estados', 'boleta', 'boletaprint'],
                               //Esta propiedad establece que tiene permisos
                     'allow' => true,
                               //Usuarios autenticados, el signo ? es para invitados
                     'roles' => ['@'],
                               //Este método nos permite crear un filtro sobre la identidad del usuario
                               //y así establecer si tiene permisos o no
                     'matchCallback' => function ($rule, $action) {
                                  //Llamada al método que comprueba si es un usuario simple
                      return User::isUserSimple(Yii::$app->user->identity->id);
                    },
                  ],
                ],
              ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    // 'borrar' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Venta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['FECHA_VENTA' => 'DESC']];

        $repartidores=Repartidor::find()->where(['VIGENTE_REPARTIDOR'=>1])->all();
        $repartidores=ArrayHelper::map($repartidores, 'RUT_REPARTIDOR', 'NOMBRE_REPARTIDOR');
        $ventas=Venta::find()->all();
        $telefono=ArrayHelper::map($ventas, 'TELEFONO_VENTA', 'TELEFONO_VENTA');
        $vendedor=ArrayHelper::map($ventas, 'VENDEDOR_VENTA', 'VENDEDOR_VENTA');
        $medio_pago=ArrayHelper::map($ventas, 'MEDIOPAGO_VENTA', 'MEDIOPAGO_VENTA');



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'repartidores'=> $repartidores,
            'telefono'=> $telefono,
            'vendedor'=> $vendedor,
            'medio_pago'=>$medio_pago,

        ]);
    }

    /**
     * Displays a single Venta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionImprimir()
    {   
        for ($i=0; $i<1; $i++) { 
            $connector = new WindowsPrintConnector("EPSON_TM-T88III");
            $printer = new Printer($connector);
            // $printer -> close();
            /* Information for the receipt */
            $items = array("Example item #1", "4.00","Another thing", "3.50","Something else", "1.00","A final item", "4.45");
            $subtotal = ['Subtotal', '12.95'];
            $tax = ['A local tax', '1.30'];
            $total = ['Total', '14.25', true];
            /* Date is kept the same for testing */
            // $date = date('l jS \of F Y h:i:s A');
            $date = "25-09-2019 13:56:25 Boleta Nº 101";
            /* Start the printer */
            // $logo = EscposImage::load("files/kimagure.jpeg", false);
            $printer = new Printer($connector);
            /* Print top logo */
            $printer -> setJustification(Printer::JUSTIFY_CENTER);//texto centrado
            // $printer -> graphics($logo);
            /* Name of shop */
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);//LETRAS GRANDES
            $printer -> text("Hey! sushi delivery\n");
            $printer -> setJustification(Printer::JUSTIFY_LEFT);//alineado izquierda
            $printer -> selectPrintMode();//letra normal (no grande)
            $printer -> text("RUT: 77.161.382-9\n");
            $printer -> text("DIRECCIÓN: Las palmeras 656 San marcos\n");
            $printer -> text("GIRO: Productos alimenticios\n");
            $printer -> text("TELÉFONO: +569 87654321\n");

            $printer -> feed();//linea de papel en blanco
            $printer -> setJustification(Printer::JUSTIFY_CENTER);//texto centrado
            $printer -> text($date . "\n");
            $printer -> feed();//linea de papel en blanco

            $printer -> setEmphasis(true);
            $printer -> text("PRODUCTO  DETALLE  OBS.  CANT.  PRECIO\n");
            $printer -> setEmphasis(false);
            //DETALLE
            $printer -> selectPrintMode();
            $printer -> text("Promocion 1               2     $12980");


            //DETALLE

            $printer -> setJustification(Printer::JUSTIFY_RIGHT);//alineado DERECHA
            $printer -> setEmphasis(true);
            $printer -> text("\nTOTAL $12920");
            $printer -> setEmphasis(false);
            $printer -> feed();//linea de papel en blanco

            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> setEmphasis(true);
            $printer -> text("DATOS REPARTO \n");
            $printer -> setEmphasis(false);

            $printer -> selectPrintMode();
            $printer -> text("DIRECCIÓN: \n");
            $printer -> text("TELÉFONO: \n");
            $printer -> text("OBSERVACIONES: \n");
            $printer -> text("HORA ESTIMADA: \n");
            $printer -> feed();//linea de papel en blanco

            $printer -> setJustification(Printer::JUSTIFY_CENTER);//texto centrado
            $printer -> text("www.smartbitsoluciones.cl\n");

            $printer -> cut();
            // $printer -> pulse();
            $printer -> close();
        }
        return $this->redirect('index');
    }



    /**
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_VENTA]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // date_default_timezone_set('America/Santiago');

        $compras=Compra::find()->where(['ID_VENTA'=>$id])->all();
        $repartidores=Repartidor::find()->where(['VIGENTE_REPARTIDOR'=>1])->all();
        $repartidores=ArrayHelper::map($repartidores, 'RUT_REPARTIDOR', 'NOMBRE_REPARTIDOR');


        //obtener la suma de las compras
        if($model->TOTAL_VENTA==0){

            foreach ($compras as $compra) {

                $model->TOTAL_VENTA = $model->TOTAL_VENTA + $compra->TOTAL_COMPRA;
                # code...
            }
        }
        //

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
               
            //limpiar url para terminar por completo
            //limpiar solo si la venta actualizada es la misma de la url de memoria
            $back = Yii::$app->getUser()->getReturnUrl(null);
            if (strpos($back, '&id_venta=') !== false) {
                    $id_venta = urldecode(explode('&id_venta=', $back)[1]);
                    if($id_venta==$model->ID_VENTA){
                        $back= '/site/index';
                        Yii::$app->getUser()->setReturnUrl($back);
                    }
            }
            // $back= '/site/index';
            // Yii::$app->getUser()->setReturnUrl($back);

            if (empty($model->FECHA_VENTA)) {
                $model->FECHA_VENTA=date('Y-m-d H:i:s');
            }
            $model->save();

            return $this->redirect(['venta/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'productos' => $compras,
            'repartidores' => $repartidores,
        ]);
    }

    /**
     * Deletes an existing Venta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBorrar($id)
    {

        // $compra=Compra::findOne(['ID_COMPRA'=>$id]);
        $compra=Compra::find()->where(['ID_COMPRA'=>$id])->one();
        $compra->delete();

        return $this->redirect(['site/index']);
    }

    public function actionEstados($id, $estado)
    {
        $venta=Venta::find()->where(['ID_VENTA'=>$id])->one();
        $venta->ESTADO_VENTA=$estado;
        $venta->save();
        $array=true;

        return $this->asJson($array);
    }

    public function actionBoleta($id){
        $venta=Venta::find()->where(['ID_VENTA'=>$id])->one();
        $compras=Compra::find()->where(['ID_VENTA'=>$id])->all();
        // $this->layout=false;
        return $this->render('boleta',[
            'model'=>$venta,
            'productos'=>$compras,
        ]);
    }
    public function actionBoletaprint($id){
        $venta=Venta::find()->where(['ID_VENTA'=>$id])->one();
        $compras=Compra::find()->where(['ID_VENTA'=>$id])->all();
        $this->layout=false;
        return $this->render('boleta',[
            'model'=>$venta,
            'productos'=>$compras,
        ]);
    }

    public function actionPantalla(){
        return $this->render('pantalla');
    }

    public function actionMonitor(){
        $ventas=Venta::find()
        ->where(['ESTADO_VENTA'=>'Cocina'])
        ->andWhere(['not', ['FECHA_VENTA' => null]])
        ->orderBy('FECHA_VENTA asc')
        ->all();

        $this->layout=false;
        return $this->renderPartial('monitor',[
            'model'=>$ventas,
        ]);
    }
}