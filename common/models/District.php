<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;



/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $core
 * @property string $name
 * @property integer $city_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['core', 'name', 'city_id'], 'required'],
            [['city_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['core', 'name'], 'string', 'max' => 255],
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
            'city_id' => 'City ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
       public function getCity()
    {
        return $this->hasMany(City::className(), ['city_id' => 'id']);
    }
      public function getAddress()
    {
        return $this->hasMany(Address::className(), ['district_id' => 'id']);
    }
     public static function listDistrict(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
