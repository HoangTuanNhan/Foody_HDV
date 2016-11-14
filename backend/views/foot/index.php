<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Food', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'detail:ntext',
            'image',
            // 'food_category_id',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
