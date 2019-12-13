<?php
	use app\modules\admin\models\ChildCategories;
	use yii\helpers\Url;
	$childcategories = ChildCategories::find()->where(['parent_category'=>$parent_category])->all();

?>
<div class="col-xl-8 py-5 px-md-5">
	<div class="row pt-md-4">
			<?php foreach ($posts as $model) : ?>
				<div class="col-md-12">
					<div class="blog-entry ftco-animate d-md-flex">
						<a href="<?= Url::to(['detail','id'=>$model->id,'category'=>$model->main_category])?>" class="img img-2" style="background-image: url('<?=Yii::$app->homeUrl?>uploads<?=str_replace( '\\', '/',$model->image)?>"></a>
						<div class="text text-2 pl-md-4">
							<h3 class="mb-2"><a href="<?= Url::to(['detail','id'=>$model->id,'category'=>$model->main_category])?>"><?=$model->title;?></a></h3>
							<div class="meta-wrap">
								<p class="meta">
									<span><i class="icon-calendar mr-2"></i><?=Yii::$app->formatter->asDate($model->date, 'dd.M.Y');?></span>
									<span><i class="icon-folder-o mr-2"></i><?=$model->mainCat->name;?></span>
								</p>
							</div>
							<p class="mb-4"><?=substr($model->short_desc,0,200)?></p>
							<p><a href="<?= Url::to(['detail','id'=>$model->id,'category'=>$model->main_category])?>" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>


	</div><!-- END-->
</div>

