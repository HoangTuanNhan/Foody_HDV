<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "restaurant_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class RestaurantCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file_image;
    public static function tableName()
    {
        return 'restaurant_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
     public function getRestaurant()
    {
        return $this->hasMany(Restaurant::className(), ['restaurant_category_id' => 'id']);
    }
     public static function listCategoryRestaurant(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
