<?php

namespace app\controllers;

use app\modules\admin\models\ChildCategories;
use app\modules\admin\models\Post;
use app\modules\admin\models\PostSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CategoryController extends Controller{







	public function actionAbout()
	{
		return $this->render('about');
	}

}


