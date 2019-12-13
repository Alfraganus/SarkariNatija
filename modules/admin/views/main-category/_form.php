<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MainCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'short_desc')->textarea(['maxlength' => true]) ?>
	<?= $form->field($model, 'is_mantatory')->dropDownList(['true' => 'true','false'=>'false']) ?>
    <label for="male">Key words</label>
    <?php
   if (!$model->isNewRecord) {
        $tags = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\TagsParentCategory::find()->where(['parent_cat'=>$model->id])->all(),'id','tag.name');
        $tags_str = implode(',',$tags);
    }else{
        $tags_str = '';
    }
    echo \dosamigos\selectize\SelectizeTextInput::widget([
        'name' => 'MainCategories[tag]',
        'loadUrl' => ['tag/list'],
        'value' =>$tags_str,
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'keyword',
            'labelField' => 'keyword',
            'searchField' => ['keyword'],
            'create' => true,
            'delimiter' => ',',
            'persist' => false,
            'createOnBlur' => true,
            'preload'=> false,
        ]
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
