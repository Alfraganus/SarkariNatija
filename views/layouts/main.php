<?php
	use app\modules\admin\models\ChildCategories;
	use app\widgets\Alert;
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use app\assets\AppAsset;
	use yii\helpers\Url;


	$category = Yii::$app->request->get('category');
	$display = (Yii::$app->request->get('id') or Yii::$app->request->get('childCategory')?'none':'');
	$categories = \app\modules\admin\models\MainCategories::find()->all();
	$sibebar = ChildCategories::find()->where(['parent_category'=>(empty($category))?1:$category])->all();
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
	<style>
		.panel-default>.panel-heading {
			color: white;
			background-color: darkred;
			border-color: darkred;
			font-size:18px;
			font-weight:bold;
		}
		.panel-heading {
			text-align:center;
			padding: 10px 15px;
			border-bottom: 1px solid transparent;
			border-top-left-radius: 3px;
			border-top-right-radius: 3px;
		}
		.panel-body {
			font-size:18px;
			padding: 15px;

		}
		.panel-default {
			border-color: #ddd;
		}

		.grid {
			/* Grid Fallback */
			display: flex;
			flex-wrap: wrap;

			/* Supports Grid */
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			grid-auto-rows: minmax(150px, auto);
			grid-gap: 1em;
			padding:20px 100px 0 100px;
		}
		.module {
			/* Demo-Specific Styles */
			background: #eaeaea;
			display: flex;
			align-items: center;
			justify-content: center;
			height: auto;

			/* Flex Fallback */
			margin-left: 5px;
			margin-right: 5px;
			flex: 1 1 200px;
		}

		/* If Grid is supported, remove the margin we set for the fallback */
		@supports (display: grid) {
			.module {
				margin: 0;
			}
		}

		/*end css grid*/

		html {
			height: 100%;
		}

		body {
			margin: 0;
			height: 100%;
		}

		#main-container {
			display: table;
			width: 100%;
			height: 100%;
		}

		#sidebar {
			/*display: table-cell;*/
			width: 100%;
			vertical-align: top;
			word-wrap: break-word;
			display:inline-block;
			/*background-color: #8e44ad;*/
		}

		#sidebar a {
			/*display: block;*/
			font-weight:bold;
			padding: 10px;
			color:black;
			margin: 15px 0 0 0;
			text-decoration: none;
			word-wrap: break-word;
			display:inline-block;
		}

		#sidebar a:hover {
			/*background-color:rgba(8, 255, 8, 0.1);*/
			color: mediumblue !important;
		}

		#content {
			display: table-cell;
			width: 85%;
			vertical-align: top;
			padding: 40px 0 0 10px;
		}
		#head-title {
			font-size: x-large;
			text-decoration: none;
			/*padding-top: 20px;*/
			padding-left: 30px;
			font-family: Georgia, nimbus roman no9 l, times new roman, Times, serif;
			color: #fff;
			word-wrap: break-word;
			text-align: center;
			text-transform: uppercase;
		}

		#header
		{
			width: 100%;
			height: 130px;
			border: 1px solid;
			background-color: #ab183d;
			border-color: #000;
		}
		#hmenu {
			height: auto;
			background-color: #8c384d;
			margin-top: 0;
			width: 100%;
			display:inline-block;
		}

		#hmenu ul {
			margin: 0;
			padding: 0;
			list-style: none;
			float: left;
		}


		#hmenu span {
			font: 12px lucida sans unicode,lucida grande,Helvetica,Arial,sans-serif;
			padding-top: 18px;
			color: #fff;
			font-weight: 700;
			text-transform: uppercase;
			display: block;
			cursor: pointer;
			background-repeat: no-repeat;
		}

		#hmenu a {
			position: relative;
			z-index: 10;
			height: 55px;
			display: block;
			float: left;
			padding: 0 10px;
			line-height: 55px;
			text-decoration: none;
		}
		#hmenu ul {
			margin-left: 20px;
		}
		#hmenu ul a:hover span {
			color: #00414e;
		}
		#hmenu li {

			text-align: -webkit-match-parent;
			float: left;
		}
		.container {
			margin:0 100px 0 100px;
		}
		.footer {
			/*position: fixed;*/
			left: 0;
			margin: 0 100px 0 100px;
			bottom: 0;
			/*width: 100%;*/
			height:40px;
			background-color: #8c384d;
			color: white;
			text-align: center;
		}

		.descleft {
			font-weight:bold;
			font-size:18px;
		}
		.descright {
			margin-left:500px;
			font-weight:bold;
			font-size:18px;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			/*border: 1px solid #ddd;*/
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even){background-color: #f2f2f2}
.table1 {
	margin: 2px;
	text-align:center;
	/*width: 98.5%;*/
	height: 60px;
	width: 245px;
	background-color: #868a08;
	font-size: 20px;
	color: #fff;
	font-weight: 700;
}
		@media only screen and (max-width: 600px) {
			#hmenu {
				width:1000px;
			}
			.descright {
				margin-left:140px;
			}

			#main-container p {
				font-size: 14px !important;
				text-align:left !important;
				padding-left:5px;
			}


			#main-container h1 {
				font-size: 16px !important;
 }
			#head-title {

				font-size:18px;
			}
			#main-container {
				width:1000px;
				display: inline-block;
			}
			#header {
				width:1000px;
			}

			.footer {
				margin: 0 0 0 0;
				padding: 0 0 0 0;
				height:60px;
				width:1000px;
				display: inline-block
			}

			.grid {
				flex-wrap: wrap;
				display: grid;
				grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
				grid-auto-rows: minmax(150px, auto);
				grid-gap: 1em;
				padding:1px 1px 0 1px;
			}
			.module {
				background: #eaeaea;
				display: flex;
				align-items: center;
				justify-content: center;
				height: auto;

				/* Flex Fallback */
				margin-left: 1px;
				margin-right: 1px;
				flex: 1 1 200px;
			}


			.container {
				display: inline-block;
				width:100%;
				margin:0 0px 0 0px;
			}


			#content {
				display: inline-block;
				/*display: table-cell;*/
				width: 100%;
				vertical-align: top;
				padding: 0 0 0 0;
			}

		}
	</style>
</head>
<body>

<?php $this->beginBody() ?>

<div class="container">
	<div id="header">
		<div id="head-title">
			<h1 style="font-size: 26px">Sarkari natija</h1>
			<h3>www.sarkarinatija.com</h3>
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

	<div id="main-container">
		<?php if(sizeof($sibebar)>0):?>
			<div id="sidebar">
				<?php foreach($sibebar as $side) : ?>
					<a href="<?=Url::to(['site/sidebar','sideCategory'=>$side->id])?>"><?=$side->name?></a>
				<?php endforeach; ?>
			</div>
		<?php endif;?>

		<div id="content">
			<?=$content?>
		</div>
	</div>
</div>
<div class="footer">
	<p style="vertical-align:middle;padding-top:10px">© <?=date('Y')?> www.sarkarinatija.com All Rights Reserved</p>
</div>


<?php $this->endBody() ?>

<?php $this->endPage() ?>
