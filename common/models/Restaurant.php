<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "restaurant".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property string $image
 * @property integer $restaurant_category_id
 * @property integer $address_id
 * @property string $time_open
 * @property string $time_close
 * @property integer $price_min
 * @property integer $price_max
 * @property integer $point
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property Rate[] $rates
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file_image;
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'detail', 'image', 'restaurant_category_id', 'address_id'], 'required'],
            [['detail'], 'string'],
            [['restaurant_category_id', 'address_id', 'price_min', 'price_max', 'point', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['time_open', 'time_close'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
            [['name'],'unique'],
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
            'detail' => 'Detail',
            'image' => 'Image',
            'restaurant_category_id' => 'Restaurant Category ID',
            'address_id' => 'Address ID',
            'time_open' => 'Time Open',
            'time_close' => 'Time Close',
            'price_min' => 'Price Min',
            'price_max' => 'Price Max',
            'point' => 'Point',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['restaurant_id' => 'id']);
    }
       public function getRestaurantCategory()
    {
        return $this->hasOne(RestaurantCategory::className(), ['id' => 'restaurant_category_id']);
    }
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
     public static function listRestaurant(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
