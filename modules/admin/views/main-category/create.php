<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MainCategories */

$this->title = 'Create Main Categories';
$this->params['breadcrumbs'][] = ['label' => 'Main Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
