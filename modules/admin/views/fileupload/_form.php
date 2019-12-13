<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Fileuploads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fileuploads-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Title of file') ?>

    <?= $form->field($model, 'avatar')->widget(trntv\filekit\widget\Upload::classname(), [
                'url' => ['upload'],
                'maxFileSize' => 20000000000,
            ])->label('file'); ?>


 
  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
