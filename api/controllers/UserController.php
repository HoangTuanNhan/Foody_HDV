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
        return $user;
    }

    /**
     * @SWG\Get(path="/user/view",
     *     tags={"user"},
     *     summary="获取用户列表",
     *     description="测试直接返回一个array",
     *     produces={"application/json"},
     *        @SWG\Parameter(
     *        in = "header",
     *        name = "Authorization",
     *        description = "Authorization",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "id",
     *        description = "Authorization",
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
        return $this->findModel($id);
    }

    /**
     * @SWG\Post(path="/user/create",
     *     tags={"user"},
     *     summary="创建用户接口",
     *     description="测试Param是 *query* 类型, 如果设置成 *formData* 类型的就可以使用post获取数据",
     *     produces={"application/json"},
     *    @SWG\Parameter(
     *        in = "header",
     *        name = "Authorization",
     *        description = "Authorization",
     *        required = true,
     *        type = "string"
     *     ),
     * 
     *  @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     * 
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "手机号",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "fullname",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "string",
     *     ),
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "role_id",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "integer",
     *        enum = {1, 2},
     *     ),
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "status",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "integer",
     *        enum = {1, 2},
     *     ),
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

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->save()){
                return $model;
            }
            else{
                return $model->errors;
            }
        }
    }

    /**
     * @SWG\Put(path="/user/update",
     *     tags={"user"},
     *     summary="更新用户接口",
     *     description="*path*类型的参数会放入请求地址地址中",
     *     produces={"application/json"},
     *       @SWG\Parameter(
     *        in = "header",
     *        name = "Authorization",
     *        description = "Authorization",
     *        required = true,
     *        type = "string"
     *     ),
     *       @SWG\Parameter(
     *        in = "query",
     *        name = "id",
     *        description = "用户姓名",
     *        required = true,
     *        type = "integer"
     *     ),
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     * 
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "手机号",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "fullname",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "string",
     *     ),
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "role_id",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "integer",
     *        enum = {1, 2},
     *     ),
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "status",
     *        description = "性别 1. 男 2.女 此项为非必填项.展示成select",
     *        required = true,
     *        type = "integer",
     *        enum = {1, 2},
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
     * @param integer $id
     *
     * @return array
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
         if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->save()){
                return $model;
            }
            else{
                return $model->errors;
            }
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /**
     * @SWG\Put(path="/user/delete",
     *     tags={"user"},
     *     summary="更新用户接口",
     *     description="*path*类型的参数会放入请求地址地址中",
     *     produces={"application/json"},
     *       @SWG\Parameter(
     *        in = "header",
     *        name = "Authorization",
     *        description = "Authorization",
     *        required = true,
     *        type = "string"
     *     ),
     *       @SWG\Parameter(
     *        in = "query",
     *        name = "id",
     *        description = "用户姓名",
     *        required = true,
     *        type = "integer"
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
     * @param integer $id
     *
     * @return array
     */
    public function actionDelete($id)
    {
        

        return $this->findModel($id)->delete();
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