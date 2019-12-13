<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MainCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Main Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Main Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'false'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'is_mantatory',
            'short_desc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
