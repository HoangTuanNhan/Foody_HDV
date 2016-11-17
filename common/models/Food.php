<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "food".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $detail
 * @property string $image
 * @property integer $food_category_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file_image;
    public static function tableName()
    {
        return 'food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'detail', 'image','food_category_id'], 'required'],
            [['price', 'food_category_id',  'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['detail'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
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
            'price' => 'Price',
            'detail' => 'Detail',
            'image' => 'Image',
            'food_category_id' => 'Food Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'food_category_id']);
    }
      public function getComment()
    {
        return $this->hasMany(Comment::className(), ['food_id' => 'id']);
    }
    public static function listFood(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
