<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\OrderDetail;
use frontend\models\Orders;
use frontend\models\Product;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error',],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['check-order'],
                        'allow' => true,
                        //'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    //'check-order' => ['post']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionCheckOrder()
    {
        //Query เฉพาะรายการที่เคยสั่งซื้อไปแล้วมากกว่า 3 วัน และยังไม่ชำระเงิน
        $sql = "SELECT * ,FROM_UNIXTIME(created_at,'%Y-%m-%d %H:%i:%s') AS duetime
        FROM `orders` 
        WHERE CURRENT_TIMESTAMP() > DATE_ADD(FROM_UNIXTIME(created_at,'%Y-%m-%d %H:%i:%s'),INTERVAL 3 DAY) AND status=9; ";

        $params = [];
        //$order = new Orders();

        $kw = Yii::$app->db->createCommand($sql, $params)->queryAll();

        $response = null;
        if ($kw !== NULL) {
            for ($i = 0; $i < count($kw); $i++) {
                //array_push($arrs, $kw[$i]['id']);
                Orders::findOne(['id' => $kw[$i]['id']])->delete();

                $orderDetail = OrderDetail::findOne(['orders_id' => $kw[$i]['id']]);
                foreach ($orderDetail as $model) {

                    //คืน Stock
                    $product = Product::findOne(['id' => $model->product_id]);
                    $product->setAttribute('stock', $model->quantity + $product->stock);
                    $product->save();
                }
                if ($orderDetail->delete()) {
                    $response->status = 'delete successfully!';
                } else {
                    $response->status = 'cannot delete orders!';
                }
            }
        } else
            $response->status = 'Orders is empty!';


        echo json_encode($response);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
