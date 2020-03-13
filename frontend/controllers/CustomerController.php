<?php

namespace frontend\controllers;

use frontend\models\UploadSingleForm;
use Yii;
use frontend\models\Customer;
use frontend\models\CustomerSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
                        'actions' => ['create', 'update', 'view'],
                        'roles' => ['@', 'manageProfile'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Customer models.
     * @return mixed
     */
    /* public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } */

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $uploadSingleFile = new UploadSingleForm();

        if ($model->load(Yii::$app->request->post())) {
            $uploadSingleFile->imageFile = UploadedFile::getInstance($uploadSingleFile, 'imageFile');

            //print_r($pos);die();
            //Upload file
            $picture = $uploadSingleFile->upload();
            //var_dump($picture);die();
            if ($picture) {
                //Uploaded successfully
                $model->picture = $picture;
                $model->user_id = Yii::$app->user->id;
                //var_dump($model->picture);die();
                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
            var_dump($model);
            die();
        }


        return $this->render('create', [
            'model' => $model,
            'imageModel' => $uploadSingleFile,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadSingleFile = new UploadSingleForm();

        if ($model->load(Yii::$app->request->post())) {

            $uploadSingleFile->imageFile = UploadedFile::getInstance($uploadSingleFile, 'imageFile');

            $picture = $uploadSingleFile->upload();
            if ($picture) {
                //Uploaded successfully
                $model->picture = $picture;
                //var_dump($model->picture);die();

            }
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);


            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imageModel' => $uploadSingleFile,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
