<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ChildCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-categories-form">

    <?php $form = ActiveForm::begin(); ?>
  <?php $childCategories = \yii\helpers\ArrayHelper::map(app\modules\admin\models\MainCategories::find()->all(),'id','name') ?>


    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'parent_category')->dropDownList($childCategories) ?>
    <label for="male">Key words</label>
    <?php
   if (!$model->isNewRecord) {
        $tags = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\TagsChildCategory::find()->where(['child_category'=>$model->id])->all(),'id','tag.name');
        $tags_str = implode(',',$tags);
    }else{
        $tags_str = '';
    }
    echo \dosamigos\selectize\SelectizeTextInput::widget([
        'name' => 'ChildCategories[tag]',
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

    <?= $form->field($model, 'short_desc')->textarea(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
