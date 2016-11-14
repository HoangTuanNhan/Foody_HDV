<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;
use common\models\Category;
use kartik\file\FileInput;
use common\components\Util;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'] // important
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'file_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
            'initialPreview' => [
                Html::img(Util::getUrlImage($model->image))
            ],
            'overwriteInitial' => true,
            'showUpload' => false,
            'showCaption' => false,
        ]
    ]);
    ?>
    <?= $form->field($model, 'restaurant_category_id')->dropDownList(\common\models\RestaurantCategory::listCategoryRestaurant()) ?>

    <?= $form->field($model, 'address_id')->dropDownList(\common\models\Address::listAddress()) ?>
   
    <label class="control-label">Open Time</label>;
    <?=
    TimePicker::widget([
        'name' => 'time_open',
        'value' => '00:00 AM',
        'pluginOptions' => [
            'showSeconds' => true
        ]
    ]);
    ?>
    <label class="control-label">Close Time</label>;
     <?=
    TimePicker::widget([
        'name' => 'time_close',
        'value' => '00:00 AM',
        'pluginOptions' => [
            'showSeconds' => true
        ]
    ]);
    ?>
   

    <?= $form->field($model, 'price_min')->textInput() ?>

    <?= $form->field($model, 'price_max')->textInput() ?>

    <?= $form->field($model, 'point')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
