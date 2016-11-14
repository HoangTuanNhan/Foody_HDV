<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RestaurantCategory */

$this->title = 'Create Restaurant Category';
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
