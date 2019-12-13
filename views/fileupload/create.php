<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Fileuploads */

$this->title = 'Create Fileuploads';
$this->params['breadcrumbs'][] = ['label' => 'Fileuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fileuploads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
