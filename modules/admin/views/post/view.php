<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'title',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads'.str_replace( '\\', '/', $data['image']),
                        ['width' => '40%','height'=>'500px']);
                },
            ],
            'attributes' => [
                'attribute' => 'content',
                'format' => 'html',
            ],

            'file',
            [
                'attribute'=>'mainCat.name',
                'label'=>'Main category',

            ],
            [
                'attribute'=>'childCat.name',
                'label'=>'Child category',

            ],
            'mainCat.name',
            ['attribute'=>'date',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDateTime($model->date, 'php:d/M/Y');
                },
            ],

        ],
    ]) ?>

</div>

<style>
    .imageview {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
