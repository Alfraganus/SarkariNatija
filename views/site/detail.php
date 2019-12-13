<?php
	use app\modules\admin\models\ChildCategories;
	use yii\helpers\Url;

	$this->title = $model->title;
	$username = (!empty($model->userName->fullname)?$model->userName->fullname:'');
	$childcategories = ChildCategories::find()->where(['parent_category'=>Yii::$app->request->get('category')])->all();
	$tagss = \app\modules\admin\models\TagAssign::find()->all();
	$tags = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\TagAssign::find()->where(['post_id'=>$model->id])->all(),'id','tag.name');
	$tags_str = implode(',',$tags);
	$this->registerMetaTag([ 'name'=>"description", 'content'=>\yii\helpers\Html::encode(\yii\helpers\StringHelper::truncateWords(strip_tags($model->short_desc),30))]);
	$this->registerMetaTag([ 'name'=>"keywords", 'content'=>$tags_str]);
	$this->registerMetaTag([ 'name'=>"author", 'content'=>$username]);

	?>



<div class="col-xl-8 py-5 px-md-5" style="margin-bottom:100px">
<h1 class="text-center" style="text-align:center"><?=$model->title?></h1>
	<span class="desc">Exam Date:<?=$model->exam_date?> </span> <span class="desc" style="margin-left:500px">Official website: <a target="_blank" href="<?=$model->website?>"><?=$model->website?></a></span>
	<div style="clear:both"></div>
	<span class="desc">Total Vacancies:<?=$model->total_vacancies?> </span> <span class="desc" style="margin-left:466px">Last Date to apply: <?=$model->last_date_to_apply?></span>
	<div style="clear:both"></div>
	<span class="desc">Admit card:<?=$model->admit_card?> </span> <span class="desc" style="margin-left:500px">Eligibility: <?=$model->eligibility?></span>
	<div style="clear:both"></div>
	<h4><?=$model->short_desc?></h4>
	<h3 style="text-align:right;"> <?=Yii::$app->formatter->asDate($model->date, 'dd-M-Y')?></h3>

	<center><p style="text-align:center;"><?=$model->content?></p></center>
		<?php if(!empty($model->file)): ?>
	<h3 style="text-align:left">Download: <a href="<?=Url::to(['site/download-file','id'=>$model->file])?>"> <?=$model->postName->name;?></a></h3>
  <?php endif;?>
</div>






