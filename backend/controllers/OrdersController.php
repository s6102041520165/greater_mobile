<?php

namespace backend\controllers;

use backend\models\Cart;
use backend\models\OrderDetail;
use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use backend\models\Product;
use Exception;
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
                    'checkout' => ['POST'],
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
                'pageSize' => 5,
            ],
        ]);


        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model->barcode);die();
            $product = $this->findBarcode($model->barcode);

            //ดักไม่ให้เกิด Exception
            try {
                //ค้นหาตะกร้าสินค้าจาก product_id 
                $cart = Cart::findOne(['product_id' => $product->id]);
                //ถ้าพบสินค้าชิ้นเดียวกับรหัสบาร์โค๊ดให้ทำในเงื่อนไข
                if ($cart !== null) {
                    $cart->product_id = $product->id;
                    $cart->id =  $cart->id;
                    //เพิ่มจำนวนขึ้นทีละ 1
                    $cart->quantity = $cart->quantity += 1;
                } else {
                    //กรณีเพิ่มสินค้านี้เป็นชิ้นแรก
                    $cart = new Cart();
                    $cart->product_id = $product->id;
                    $cart->quantity = 1;
                }

                $cart->save();
            } catch (Exception $e) {
                Yii::$app->session->setFlash('warning', 'ไม่พบสินค้ารหัสบาร์โค๊ด ' . $model->barcode);
            }

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
            if ($model->quantity == 0) {
                $this->findModel($model->id)->delete();
            }
            return $this->redirect(['create']);
        }

        return $this->redirect(['create']);
    }

    public function actionCheckout()
    {
        //เอาข้อมูลใน Cart มา
        $cart = Cart::find()->joinWith(['product'])->where(['cart.created_by' => Yii::$app->user->id])->all();
        //ราคารวมของ User คนที่สั่งซื้อ
        $sumtotal = 0;
        foreach ($cart as $data) {
            $sumtotal +=  $data->product['price'] * $data->quantity;
        }
        //Saving Order
        $orderModel = new Orders();

        $orderModel->setAttribute('sumtotal',$sumtotal);
        if ($orderModel->save()) {
            foreach ($cart as $data) {
                $orderDetail = new OrderDetail();
                $orderDetail->setAttribute('orders_id',$orderModel->id);
                $orderDetail->setAttribute('product_id',$data->product_id);
                $orderDetail->setAttribute('quantity',$data->quantity);
                $orderDetail->save();
               //var_dump();die();
            }
        } else {
            var_dump($orderModel);
            die();
        }
        return $this->redirect(['index']);
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

        return $this->redirect(['create']);
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
        if (($model = Cart::findOne($id)) !== null) {
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
