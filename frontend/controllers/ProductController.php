<?php

namespace frontend\controllers;

use common\models\Product;
use Exception;
use frontend\models\Cart;
use frontend\models\ProductSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ProductController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['cart', 'confirm'],
                'rules' => [
                    /* [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ], */
                    [
                        'actions' => ['cart', 'confirm'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex($category = null)
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCart($id)
    {
        $modelProduct = $this->findModel($id);
        $model = new Cart();


        try {
            //ค้นหาตะกร้าสินค้าจาก product_id 
            $cart = Cart::findOne(['product_id' => $modelProduct->id]);
            //ถ้าพบสินค้าชิ้นเดียวกับรหัสบาร์โค๊ดให้ทำในเงื่อนไข
            if ($cart !== null) {
                $cart->product_id = $modelProduct->id;
                $cart->id =  $cart->id;
                //เพิ่มจำนวนขึ้นทีละ 1
                $cart->quantity = $cart->quantity += 1;
            } else {
                //กรณีเพิ่มสินค้านี้เป็นชิ้นแรก
                $cart = new Cart();
                $cart->product_id = $modelProduct->id;
                $cart->quantity = 1;
            }

            $cart->save();
        } catch (Exception $e) {
            Yii::$app->session->setFlash('warning', 'ไม่พบสินค้า ' . $modelProduct->barcode);
        }

        return $this->redirect(['/cart/index']);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
