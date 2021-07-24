<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\User;


/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                  'class' => AccessControl::className(),
                  'only' => ['index', 'update', 'delete'],
                  'rules' => [
                    [
                                //El administrador tiene permisos sobre las siguientes acciones
                      'actions' => ['index', 'update', 'delete'],
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
                     'actions' => ['index'],
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (User::isUserAdmin(Yii::$app->user->identity->id)){
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }


    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if (User::isUserAdmin(Yii::$app->user->identity->id)){

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (User::isUserAdmin(Yii::$app->user->identity->id)){
        $this->layout = 'mainAdmin';
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
