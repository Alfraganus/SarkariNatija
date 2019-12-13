<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use app\modules\admin\models\Fileuploads;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">
<div class="post-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'
        ]
    ]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'language' => 'en',
        ]),
    ]) ?>


    <label for="male">Key words</label>
    <?php
   if (!$model->isNewRecord) {
        $tags = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\TagAssign::find()->where(['post_id'=>$model->id])->all(),'id','tag.name');
        $tags_str = implode(',',$tags);
    }else{
        $tags_str = '';
    }
    echo \dosamigos\selectize\SelectizeTextInput::widget([
        'name' => 'Post[tag]',
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


<div class="row">

<?php 
 $filebase = Fileuploads::find()->all();
  $filenames[] = null;
  foreach ($filebase as $file) {
      $filenames[] = $file->name;
  }
?>
    <div class="col-md-6">
    <?= $form->field($model, 'avatar')->widget(trntv\filekit\widget\Upload::classname(), [
                'url' => ['upload'],
                'maxFileSize' => 20000000000,
            ]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'fileLink')->widget(TypeaheadBasic::classname(), [
    'data' => $filenames,
    'pluginOptions' => ['highlight' => true],
    'options' => ['placeholder' => 'Filter as you type ...'],
])->label('Please enter file name from database'); ?>
         

     </div>
</div>
<?php   if ($model->isNewRecord): ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'main_category')->dropDownList(
                ArrayHelper::map(\app\modules\admin\models\MainCategories::find()->all(), 'id', 'name'),
                [
                    'prompt' => 'Please choose parent category',
                    'id'=>'main_category',
                    'onchange' => '
            $.post(
                "' . Url::toRoute('getoperations') . '", 
                {id: $(this).val()}, 
                function(res){
                    $("#emeliyyatlar").html(res);
                }
            );
        ',

                ]
            );
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'child_category')->dropDownList(
                [],
                [

                    'id' => 'emeliyyatlar'
                ]
            );
            ?>
        </div>
    </div>
	<?php endif;?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([1=>'Publish',0=>'Draft']) ?>
        </div>
    </div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'exam_date')->input('date',['id'=>"date"]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'website')->textInput() ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'total_vacancies')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'last_date_to_apply')->input('date') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'admit_card')->textInput(['id'=>'admincard']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'eligibility')->textInput() ?>
		</div>
	</div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
