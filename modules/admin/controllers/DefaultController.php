<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\admin\models\Post;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Default controller for the `modules` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'ruleConfig' => [
					'class' => 'app\components\AccessRule'
				],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['Admin'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

    public function actionIndex()
    {
        $latestPosts = Post::find()->where(['status'=>1])->limit(19)->orderBy('id DESC')->all();
        return $this->render('index',compact(
            'latestPosts'
        ));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public  function actionCreateStudent()
    {
        $user = new User();
        $alternativeUser->password_hash = Yii::$app->security->generatePasswordHash($alternativeUser->password_hash);
    }
}
