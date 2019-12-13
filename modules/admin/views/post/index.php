<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\TagAssign;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads'.str_replace( '\\', '/', $data['image']),
                        ['width' => '80px']);
                },
            ],
           
            'title',
            'short_desc:ntext',
            //'file',
            [
                'attribute'=>'mainCat.name',
                'header'=>'Main category',
            ],
            [
                'attribute'=>'childCat.name',
                'header'=>'Child category',
            ],
            [
                'attribute'=>'date',
                'value' => function ($model) {
                    if(!empty($model->date))
                    {
                        return Yii::$app->formatter->asDateTime($model->date, 'php:d/M/Y');
                    } else {
                        return "not set";
                    }
                },
            ],
            [
                'attribute'=>'Status',
                'header'=>'Status',
                'filter' => ['1'=>'Active', '0'=>'Deactive'],
                'format'=>'raw',
                'value' => function($model, $key, $index)
                {
                    if($model->status == 1)
                    {
                        return '<div class="alert alert-success">active</div>';
                    }
                    else
                    {
                        return '<div class="alert alert-danger">Inactive</div>';
                    }
                },
            ],

            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
