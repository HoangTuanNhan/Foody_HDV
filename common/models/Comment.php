<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $food_id
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Comment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'food_id', 'content'], 'required'],
            [['user_id', 'food_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['content'], 'string'],
        ];
    }

    public function getFood() {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }
     public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'food_id' => 'Food ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

}
