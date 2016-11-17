<?php
namespace api\controllers;

use api\components\ApiController;

use Yii;

use common\models\RestaurantCategory;

class RestaurantCategoyController extends ApiController
{
        public function behaviors() {
        $behaviors = parent::behaviors();

        return $behaviors;
    }

    /**
     * @SWG\Get(path="/restaurant-categoy/index",
     *     tags={"Restaurant-categoy"},
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
        $category = RestaurantCategory::find()->all();
        
        return   $category;
    }

    /**
     * @SWG\Get(path="/restaurant-categoy/view",
     *     tags={"Restaurant-categoy"},
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
     * @SWG\Post(path="/restaurant-categoy/create",
     *     tags={"Restaurant-categoy"},
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
     *        name = "name",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
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
        $model = new RestaurantCategory();

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
     * @SWG\Put(path="/restaurant-categoy/update",
     *     tags={"Restaurant-categoy"},
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
     *        @SWG\Parameter(
     *        in = "formData",
     *        name = "name",
     *        description = "用户姓名",
     *        required = true,
     *        type = "string"
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
     * @SWG\Put(path="/restaurant-categoy/delete",
     *     tags={"Restaurant-categoy"},
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
        if (($model = RestaurantCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}