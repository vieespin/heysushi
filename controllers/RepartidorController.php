<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use app\models\Repartidor;
use app\models\RepartidorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepartidorController implements the CRUD actions for Repartidor model.
 */
class RepartidorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                  'class' => AccessControl::className(),
                  'only' => ['index', 'view', 'update', 'create'],
                  'rules' => [
                    [
                                //El administrador tiene permisos sobre las siguientes acciones
                      'actions' => ['index', 'view', 'update', 'create'],
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
                     'actions' => ['index', 'create'],
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
                ],
            ],
        ];
    }

    /**
     * Lists all Repartidor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepartidorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repartidor model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Repartidor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Repartidor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Repartidor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Repartidor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Repartidor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Repartidor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repartidor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
