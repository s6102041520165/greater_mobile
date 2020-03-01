<?php

namespace backend\controllers;

use backend\models\Cart;
use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use backend\models\Product;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
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
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        //$cart = new Cart();
        
        $provider = new ActiveDataProvider([
            'query' => Cart::find()->where(['created_by' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);



        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model->barcode);die();
            $product = $this->findBarcode($model->barcode);

            //Search model with product_id
            $cart = Cart::findOne(['product_id' => $product->id]);
            
            if($cart!== null){
                $cart->product_id = $product->id;
                $cart->id =  $cart->id;
                //Added previous quantity
                $cart->quantity = $cart->quantity += 1;
            } else {
                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->quantity = 1;
            }
            
            $cart->save();
            return $this->redirect(['create']);
        }

        return $this->render('create', [
            'model' => $model,
            'cart' => $provider,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findBarcode($barcode)
    {
        if (($model = Product::findOne(['barcode' => $barcode])) !== null) {
            return $model;
        }
    }

}
