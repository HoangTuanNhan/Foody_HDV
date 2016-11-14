<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
       public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                
            ],
           
        ];
    }
    public static function tableName()
    {
        return 'category';
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
    public function getFoods()
    {
        return $this->hasMany(Food::className(), ['food_category_id' => 'id']);
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
      public static function listCategory(){
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
