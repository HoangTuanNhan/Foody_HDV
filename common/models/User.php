<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $status
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $logged_in_ip
 * @property string $logged_in_at
 * @property string $created_ip
 * @property string $created_at
 * @property string $updated_at
 * @property string $banned_at
 * @property string $banned_reason
 *
 * @property Profile[] $profiles
 * @property Role $role
 * @property UserAuth[] $userAuths
 * @property UserToken[] $userTokens
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
     use \damirka\JWT\UserTrait;
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 2;
    const STATUS_ACTIVE = 1;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'status'], 'required'],
            [['role_id', 'status'], 'integer'],
            [['logged_in_at', 'created_at', 'updated_at', 'banned_at'], 'safe'],
            [['email', 'username', 'password', 'auth_key', 'access_token', 'logged_in_ip', 'created_ip', 'banned_reason'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'status' => 'Status',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'logged_in_ip' => 'Logged In Ip',
            'logged_in_at' => 'Logged In At',
            'created_ip' => 'Created Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'banned_at' => 'Banned At',
            'banned_reason' => 'Banned Reason',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        return $this->hasMany(UserAuth::className(), ['user_id' => 'id']);
    }
     public function getRate()
    {
        return $this->hasMany(Rate::className(), ['user_id' => 'id']);
    }
     public function getComment()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTokens()
    {
        return $this->hasMany(UserToken::className(), ['user_id' => 'id']);
    }
    public static function listUser(){
        return ArrayHelper::map(self::find()->all(), 'id', 'username');
    }
    //findbyName
      public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
         return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
     protected static function getSecretKey() {
        return Yii::$app->params['jwtSecret'];
    }
    protected static function getHeaderToken() {
        return ['exp' => time() + Yii::$app->params['jwtExpire']];
    }
     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
     public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
    

}
