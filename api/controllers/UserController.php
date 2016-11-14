<?php
namespace api\controllers;

use api\components\ApiController;
use common\models\User;
use Yii;
use common\models\Category;

class UserController extends ApiController
{
        public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'] = [
            [
//                'actions' => [''],
                'allow' => true,
                'roles' => [User::ROLE_ADMIN],
            ],
        ];

        return $behaviors;
    }

    /**
     * @SWG\Get(path="/user/index",
     *     tags={"user"},
     *     summary="获取用户列表",
     *     description="测试直接返回一个array",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "header",
     *        name = "Authorization",
     *        description = "Authorization",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = "success"
     *     )
     * )
     *
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $categories = Category::find()->all();
        return $categories;
    }

    /**
     * @SWG\Get(path="/user/view",
     *     tags={"user"},
     *     summary="获取用户列表",
     *     description="测试直接返回一个array",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "id",
     *        description = "user id",
     *        required = true,
     *        type = "integer"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = "success"
     *     )
     * )
     *
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @SWG\Post(path="/users",
     *     tags={"user"},
     *     summary="创建用户接口",
     *     description="测试Param是 *query* 类型, 如果设置成 *formData* 类型的就可以使用post获取数据",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "username",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "phone",
     *        description = "手机号",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "sex",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = false,
     *        type = "integer",
     *        enum = {1, 2}
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "需要重新登陆",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     *
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @SWG\Put(path="/users/{id}",
     *     tags={"user"},
     *     summary="更新用户接口",
     *     description="*path*类型的参数会放入请求地址地址中",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "用户ID",
     *        required = true,
     *        type = "integer"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "phone",
     *        description = "手机号",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "sex",
     *        description = "性别 1. 男 2.女 此项为非必填项.这里指定了一个默认项，那么会默认选中",
     *        required = false,
     *        type = "integer",
     *        default = 1,
     *        enum = {1, 2}
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "job",
     *        description = "这里可以设置默认值",
     *        required = false,
     *        type = "string",
     *      default = "程序猿"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "avatar",
     *        description = "类型设置为`file`则可以展示上传按钮，在后端和普通上传一样处理",
     *        required = false,
     *        type = "file"
     *    ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "需要重新登陆",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     * @param integer $id
     *
     * @return array
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}