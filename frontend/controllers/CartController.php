<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cart;
use app\models\CartSearch;
use frontend\models\Customer;
use frontend\models\CustomerSearch;
use frontend\models\OrderDetail;
use frontend\models\Orders;
use frontend\models\Product;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'confirm'],
                        'roles' => ['@', 'reserveCart'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Cart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
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
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cart();

        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionConfirm()
    {

        $id = Yii::$app->user->id;
        $model = Customer::findOne(['user_id' => $id]); //User 

        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //ถ้ามีการเปลี่ยนแปลงข้อมูลส่วนตัวให้บันทึกข้อมูลก่อน
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //เอาข้อมูลใน Cart มา
            $cart = Cart::find()->joinWith(['product'])->where(['cart.created_by' => Yii::$app->user->id])->all();
            //ราคารวมของ User คนที่สั่งซื้อ
            $sumtotal = 0;
            foreach ($cart as $data) {
                $sumtotal +=  $data->product['price'] * $data->quantity;
            }
            //Saving Order
            $orderModel = new Orders();

            $orderModel->setAttribute('sumtotal', $sumtotal);
            $orderModel->setAttribute('customer_id', $model->id);
            if ($orderModel->save()) {
                foreach ($cart as $data) {
                    /**Orders Detail set values */
                    $orderDetail = new OrderDetail();
                    $orderDetail->setAttribute('orders_id', $orderModel->id);
                    $orderDetail->setAttribute('product_id', $data->product_id);
                    $orderDetail->setAttribute('quantity', $data->quantity);
                    /**Insert order detail table */
                    $orderDetail->save();

                    /**Decrement stock and update product table*/
                    $modelProduct = Product::findOne(['id' => $data->product_id]);
                    $modelProduct->setAttribute('stock', (int) ($modelProduct->stock - $data->quantity));
                    $modelProduct->save();

                    /**Deleted all product in cart */
                    Cart::deleteAll(['cart.created_by' => Yii::$app->user->id]);
                }

                Yii::$app->session->setFlash('success', 'บันทึกรายการที่คุณสั่งซื้อสำเร็จ');
            }
            return $this->redirect(['/orders/index']);
        }

        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = Product::findOne(['id' => $model->product_id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->quantity <= $product->stock) {
                if ($model->save())
                    return $this->redirect(['index']);
            }
        }

        Yii::$app->session->setFlash('danger', 'จำนวนรายการต้องไม่มากกว่า ' . $product->stock);


        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Cart model.
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
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
