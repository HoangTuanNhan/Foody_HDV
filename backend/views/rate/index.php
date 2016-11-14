<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'restaurant_id',
            'point',
            'created_at',
            // 'updated_at',
            // 'deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
