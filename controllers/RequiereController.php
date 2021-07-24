<?php

namespace app\controllers;

use Yii;
use app\models\Requiere;
use app\models\RequiereSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequiereController implements the CRUD actions for Requiere model.
 */
class RequiereController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    // 'ajaxbowl'=> ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Requiere models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequiereSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requiere model.
     * @param integer $ID_PRODUCTO
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_PRODUCTO, $ID_INGREDIENTE)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_PRODUCTO, $ID_INGREDIENTE),
        ]);
    }

    /**
     * Creates a new Requiere model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Requiere();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PRODUCTO' => $model->ID_PRODUCTO, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Requiere model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_PRODUCTO
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_PRODUCTO, $ID_INGREDIENTE)
    {
        $model = $this->findModel($ID_PRODUCTO, $ID_INGREDIENTE);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PRODUCTO' => $model->ID_PRODUCTO, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Requiere model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_PRODUCTO
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_PRODUCTO, $ID_INGREDIENTE)
    {
        $this->findModel($ID_PRODUCTO, $ID_INGREDIENTE)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requiere model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_PRODUCTO
     * @param integer $ID_INGREDIENTE
     * @return Requiere the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_PRODUCTO, $ID_INGREDIENTE)
    {
        if (($model = Requiere::findOne(['ID_PRODUCTO' => $ID_PRODUCTO, 'ID_INGREDIENTE' => $ID_INGREDIENTE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxbowl($id_producto)
    {
        $base = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Carne'])->all();

        $a = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Agregado'])->all();

        $b = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Agregado'])->all();

        $salsas = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Salsas'])->all();
        $a2 = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Agregado'])->all();
        $b2 = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Agregado'])->all();

        $array = array();

        $ba =  "<option value=''>Seleciona Carne</option>";
        $aa =  "<option value=''>Seleciona agregado A</option>";
        $bb =  "<option value=''>Seleciona agregado B</option>";
        $sa =  "<option value=''>Seleciona la carne2</option>";
        // $a2 =  "<option value=''>Seleciona agregado A2</option>";
        // $b2 =  "<option value=''>Seleciona agreado B2</option>";



        if($base){
            foreach ($base as $modelo) {
                // $ba .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
                $ba .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $ba .= "<option value=''>Ninguna opción encontrada</option>";
        }

        if($a){
            foreach ($a as $modelo) {
                // $aa .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
                $aa .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $aa .= "<option value=''>Ninguna opción encontrada</option>";
        }

        if($b){
            foreach ($b as $modelo) {
                // $bb .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
                $bb .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $bb.= "<option value=''>Ninguna opción encontrada</option>";
        }

        if($salsas){
            foreach ($salsas as $modelo) {
                // $sa .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
                $sa .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $sa .= "<option value=''>Ninguna opción encontrada</option>";
        }
        // if($a2){
        //     foreach ($b as $modelo) {
        //         // $bb .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
        //         $aa2 .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
        //     }
        // }
        // else{
        //     $aa2.= "<option value=''>Ninguna opción encontrada</option>";
        // }
        // if($b2){
        //     foreach ($b as $modelo) {
        //         // $bb .=  "<option value='$modelo->ID_INGREDIENTE'>".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
        //         $bb2 .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
        //     }
        // }
        // else{
        //     $bb2.= "<option value=''>Ninguna opción encontrada</option>";
        // }


        $array["base"] = $ba;
        $array["a"] = $aa;
        $array["b"] = $bb;
        $array["salsa"] = $ba;
        $array["a2"] = $aa;
        $array["b2"] = $bb;

        return $this->asJson($array);
    }

    public function actionAjaxpromo($id_producto)
    {
        $ingredientes_disp = Requiere::find()
        ->joinWith(['ingrediente'])
        ->where(['ID_PRODUCTO'=>$id_producto])->orderBy('ingrediente.NOMBRE_INGREDIENTE asc')->all();
        $ingrediente="";

        foreach ($ingredientes_disp as $modelo) {
            $ingrediente .=  $modelo->ingredientes->NOMBRE_INGREDIENTE.", ";
        }

        return $this->asJson($ingrediente);
    }

    public function actionAjaxpapas($id_producto)
    {
        $carne = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Carne'])->all();

        $agregados = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Agregado'])->all();

        $salsas = Requiere::find()->where(['ID_PRODUCTO'=>$id_producto, 'DESTINO_REQUIERE'=>'Salsa'])->all();


        $array = array();

        $ba =  "<option value=''>Seleciona Carne</option>";
        $aa =  "<option value=''>Seleciona Agregado</option>";
        $bb =  "<option value=''>Seleciona Salsa</option>";


        if($carne){
            foreach ($carne as $modelo) {
                $ba .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $ba .= "<option value=''>Ninguna opción encontrada</option>";
        }

        if($agregados){
            foreach ($agregados as $modelo) {
                $aa .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $aa .= "<option value=''>Ninguna opción encontrada</option>";
        }

        if($salsas){
            foreach ($salsas as $modelo) {
                $bb .=  "<option value=".$modelo->ingredientes->NOMCORTO_INGREDIENTE.">".$modelo->ingredientes->NOMBRE_INGREDIENTE."</option>";
            }
        }
        else{
            $bb.= "<option value=''>Ninguna opción encontrada</option>";
        }

        

        $array["carne"] = $ba;
        $array["agregados"] = $aa;
        $array["salsas"] = $bb;

        return $this->asJson($array);
    }

}
