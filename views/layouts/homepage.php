<?php
	use app\modules\admin\models\ChildCategories;
	use app\widgets\Alert;
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use app\assets\AppAsset;
	use yii\helpers\Url;

	AppAsset::register($this);
	$category = Yii::$app->request->get('category');
	$display = (Yii::$app->request->get('id') or Yii::$app->request->get('childCategory')?'none':'');
	$categories = \app\modules\admin\models\MainCategories::find()->all();
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<style>

</style>
<body>

<?php $this->beginBody() ?>

<div class="container">
	<div id="header">
		<div id="head-title">
			<h1 style="font-size: 26px">Sarkari natija</h1>
			<h3 style="font-size: 26px">www.sarkarinatija.com</h3>
		</div>
	</div>

	<div id="hmenu">
		<ul class="hmenu">
			<li><a href="<?=\yii\helpers\Url::to(['/'])?>" class="parent"><span>Home</span></a></li>

			<?php foreach($categories as $cat): ?>
				<li><a href="<?=\yii\helpers\Url::to(['site/posts','category'=>$cat->id,'slug'=>$cat->slug])?>" class="parent"><span><?=$cat->name?></span></a></li>
			 <?php endforeach; ?>

		</ul>
	</div>

		</div>


	<div id="main-container">

		<div id="content">
			<h1 style="text-align:center">Categories</h1>
			<div class="grid">
			<?php foreach($categories as $cat): ?>
				<div class="module">
			<?php	$sibebar = ChildCategories::find()->where(['parent_category'=>(empty($category))?1:$category])->all();?>

			<ol type="1"><h3><a href="<?=\yii\helpers\Url::to(['site/posts','category'=>$cat->id,'slug'=>$cat->slug])?>"><?=$cat->name?></a></h3>

					<?php foreach($cat->childCategories as $child) : ?>

						<li><b><span style="padding-top:15px"><a href="<?=Url::to(['site/sidebar','sideCategory'=>$child->id])?>"><?=$child->name;?></a></span></b></li>
					<?php endforeach; ?>
			</ol>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>



<?php $this->endBody() ?>

<?php $this->endPage() ?>
