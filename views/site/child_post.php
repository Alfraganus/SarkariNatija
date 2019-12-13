<?php 	$category = Yii::$app->request->get('category');
	$categoryslug = \app\modules\admin\models\MainCategories::find()->where(['id'=>$category])->one();
?>
<?php foreach ($post as $model) { ?>
	<a href="<?=\yii\helpers\Url::to(['site/detail','id'=>$model->id])?>">
		<!--		<img src="--><?//=Yii::$app->homeUrl?><!--uploads/--><?//=$model->image?><!--" >-->
		<div class="post-info">
			<div class="post-basic-info">
				<h3><a href="<?=\yii\helpers\Url::to(['site/detail','slug'=>$model->slug,'catslug'=>$categoryslug->slug,'category'=>$category])?>"><?= $model->title?></a></h3>
				<p><?= $model->short_desc?></p>
			</div>
		</div>
	</a>
<?php } ?>