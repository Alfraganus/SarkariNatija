<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\FileuploadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fileuploads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fileuploads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fileuploads', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'path',
            'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
