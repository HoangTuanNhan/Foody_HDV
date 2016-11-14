<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rate".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $restaurant_id
 * @property integer $point
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'restaurant_id', 'point'], 'required'],
            [['user_id', 'restaurant_id', 'point', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'restaurant_id' => 'Restaurant ID',
            'point' => 'Point',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
