<?php

namespace app\controllers;

use app\modules\admin\models\ChildCategories;
use app\modules\admin\models\Fileuploads;
use app\modules\admin\models\Post;
use app\modules\admin\models\PostSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
//                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'only' => ['logout'],
            ],
           /* 'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */


    public function actionIndex()
    {
    	//$this->layout='homepage';
	    return $this->render('index');
    }

	public function actionSidebar($sideCategory){
		$post = Post::find()->where(['child_category' => $sideCategory])->all();
		return $this->render('child_post', [
			'post' => $post,
		]);
	}

	public function actionPosts($category=null)
	{
		$searchModel = new PostSearch();
		if ($category) {
			$searchModel->main_category = $category;
		}
		$dataProvider = $searchModel->search(null,true);

		return $this->render('posts', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionDownloadFile($id) {
		$model = Fileuploads::find()->where(['id'=>16])->one();
		$path = Yii::getAlias('@webroot') . '/uploads';

		$file = $path . '/'.$model->path;

		if (file_exists($file)) {

			Yii::$app->response->sendFile($file);

		}  else {
			echo "File not found!";
		}
	}


	/*	public function actionIndex()
		{
			return $this->redirect(['index', 'category' => 1,'slug'=>'latest_jobs']);
		}*/

	public function actionPostsByCategory($childCategory,$category)
	{
		$posts = Post::find()->where(['child_category'=>$childCategory])->all();
		$parent_category = ChildCategories::find()->where(['id'=>$childCategory])->one();

		return $this->render('posts_by_category',compact(
			'posts',
					'parent_category'
		));
	}


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout="user-login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionDetail($slug) {

    	$model = Post::find()->where(['slug'=>$slug])->one();
    	return $this->render('detail',compact(
    		'model'
	    ));
    }



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
