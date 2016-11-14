<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $core
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['core', 'name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['core', 'name'], 'string', 'max' => 255],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'core' => 'Core',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
     public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'city_id']);
    }
     public static function listCity(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
