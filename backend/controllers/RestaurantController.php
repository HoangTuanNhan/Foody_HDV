<?php

namespace backend\controllers;

use Yii;
use common\models\Restaurant;
use common\models\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Util;
use yii\web\UploadedFile;
/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Restaurant();

         if ($model->load(Yii::$app->request->post())) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');
            if ($model->file_image) {
                $model->image = Yii::$app->security->generateRandomString() . '.' . $model->file_image->extension;
            }
            if ($model->save()) {
                if (!empty($model->image)) {
                    Util::uploadFile($model->file_image, $model->image);
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
          $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');
            $old_image = "";
            if ($model->file_image) {
                $old_image = $model->image;
                $model->image = Yii::$app->security->generateRandomString() . '.' . $model->file_image->extension;
            }
            if ($model->save()) {
                if (!empty($model->file_image)) {
                    Util::deleteFile($old_image);
                    Util::uploadFile($model->file_image, $model->image);
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
