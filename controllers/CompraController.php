<?php

namespace app\controllers;


use Yii;
use app\models\User;
use yii\filters\AccessControl;
use app\models\Compra;
use app\models\CompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Producto;
use yii\helpers\ArrayHelper;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                  'class' => AccessControl::className(),
                  'only' => ['index', 'view', 'update', 'delete', 'create'],
                  'rules' => [
                    [
                                //El administrador tiene permisos sobre las siguientes acciones
                      'actions' => ['index', 'view', 'update', 'delete', 'create'],
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
                     'actions' => ['index', 'view', 'update', 'delete', 'create'],
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
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compra model.
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

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipo, $texto)
    {
        $model = new Compra();

        if($texto==""){

            $producto=ArrayHelper::map(Producto::find()->where(['id_tproducto'=>$tipo])->all(), 'ID_PRODUCTO', 'NOMBRE_PRODUCTO');

        }else {

            $producto=ArrayHelper::map(Producto::find()
                ->where(['id_tproducto'=>$tipo])
                ->andWhere(['like', 'NOMBRE_PRODUCTO', $texto])
                ->all(), 'ID_PRODUCTO', 'NOMBRE_PRODUCTO');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->ID_COMPRA]);
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'producto'=> $producto,
        ]);
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $id_producto)
    {
        $model = $this->findModel($id);

        $producto=ArrayHelper::map(Producto::find()->where(['ID_PRODUCTO'=>$id_producto])->all(), 'ID_PRODUCTO', 'NOMBRE_PRODUCTO');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'producto'=> $producto,
        ]);
    }

    /**
     * Deletes an existing Compra model.
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
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
