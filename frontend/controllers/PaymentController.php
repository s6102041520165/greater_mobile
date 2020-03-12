<?php

namespace frontend\controllers;

use backend\models\UploadSingleForm;
use Yii;
use frontend\models\Payment;
use frontend\models\PaymentSearch;
use frontend\models\UploadSlip;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
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
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
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
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payment();
        $uploadSingleFile = new UploadSlip();

        if ($model->load(Yii::$app->request->post())) {

            $uploadSingleFile->imageFile = UploadedFile::getInstance($uploadSingleFile, 'imageFile');

            $picture = $uploadSingleFile->upload();
            if ($picture) {
                //Uploaded successfully
                $model->image = $picture;
                //var_dump($model->picture);die();

                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'imageModel' => $uploadSingleFile
        ]);
    }

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $uploadSingleFile = new UploadSlip();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $uploadSingleFile->imageFile = UploadedFile::getInstance($uploadSingleFile, 'imageFile');

            $picture = $uploadSingleFile->upload();
            if ($picture) {
                //Uploaded successfully
                $model->image = $picture;
                //var_dump($model->picture);die();

                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imageModel' => $uploadSingleFile,
        ]);
    }

    /**
     * Deletes an existing Payment model.
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
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
