<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $name
 * @property integer $number
 * @property string $street
 * @property integer $district_id
 * @property integer $link_map
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file_image;
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'street', 'district_id', 'link_map'], 'required'],
            [['number', 'district_id', 'link_map', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name', 'street'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'number' => 'Number',
            'street' => 'Street',
            'district_id' => 'District ID',
            'link_map' => 'Link Map',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
     public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }
      public function getRestaurant()
    {
        return $this->hasMany(Restaurant::className(), ['address_id' => 'id']);
    }
     public static function listAddress(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
