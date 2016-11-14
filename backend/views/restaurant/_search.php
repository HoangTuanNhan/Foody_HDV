<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RestaurantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'detail') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'restaurant_category_id') ?>

    <?php // echo $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'time_open') ?>

    <?php // echo $form->field($model, 'time_close') ?>

    <?php // echo $form->field($model, 'price_min') ?>

    <?php // echo $form->field($model, 'price_max') ?>

    <?php // echo $form->field($model, 'point') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
