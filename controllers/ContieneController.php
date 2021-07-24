<?php

namespace app\controllers;

use Yii;
use app\models\Contiene;
use app\models\ContieneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContieneController implements the CRUD actions for Contiene model.
 */
class ContieneController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Contiene models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContieneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contiene model.
     * @param integer $ID_COMPRA
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_COMPRA, $ID_INGREDIENTE)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_COMPRA, $ID_INGREDIENTE),
        ]);
    }

    /**
     * Creates a new Contiene model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contiene();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_COMPRA' => $model->ID_COMPRA, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contiene model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_COMPRA
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_COMPRA, $ID_INGREDIENTE)
    {
        $model = $this->findModel($ID_COMPRA, $ID_INGREDIENTE);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_COMPRA' => $model->ID_COMPRA, 'ID_INGREDIENTE' => $model->ID_INGREDIENTE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contiene model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_COMPRA
     * @param integer $ID_INGREDIENTE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_COMPRA, $ID_INGREDIENTE)
    {
        $this->findModel($ID_COMPRA, $ID_INGREDIENTE)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contiene model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_COMPRA
     * @param integer $ID_INGREDIENTE
     * @return Contiene the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_COMPRA, $ID_INGREDIENTE)
    {
        if (($model = Contiene::findOne(['ID_COMPRA' => $ID_COMPRA, 'ID_INGREDIENTE' => $ID_INGREDIENTE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
