<?php
namespace api\controllers;


use Yii;
use api\components\ApiController;
use api\models\ApiLoginForm;
use common\models\User;

class SiteController extends ApiController
{
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['login'];
        $behaviors['access']['rules'] = [
            [
                'actions' => ['login'],
                'allow' => true,
                'roles' => ['?'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @SWG\Post(path="/site/login",
     *     tags={"Auth"},
     *     summary="创建用户接口",
     *     description="Login",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "Username",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "Password",
     *        required = true,
     *        type = "string"
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
    public function actionLogin() {
        $model = new ApiLoginForm();
        
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login() != "") {
            return $model->jwt;
        } else {
            return $model->errors;
        }
    }

}
