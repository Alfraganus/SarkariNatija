<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\ChildCategories;
use app\modules\admin\models\MainCategories;
use Yii;
use app\modules\admin\models\Post;
use app\modules\admin\models\Fileuploads;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagSearch;
use app\modules\admin\models\TagAssign;
use app\modules\admin\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'deleteRoute' => 'upload-delete'
            ],
            'upload-delete' => [
                'class' => 'trntv\filekit\actions\DeleteAction'
            ],
            'upload-imperavi' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'fileparam' => 'file',
                // 'responseUrlParam'=> 'filelink',
                'multiple' => false,
                'disableCsrf' => true
            ]
        ];
    }


    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tags = TagAssign::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => $tags,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionGetoperations()
    {
        if ($id = Yii::$app->request->post('id')) {
            $operationPosts = MainCategories::find()
                ->where(['id' => $id])
                ->count();

            if ($operationPosts > 0) {
                $operations = ChildCategories::find()
                    ->where(['parent_category' => $id])
                    ->all();
                foreach ($operations as $operation)
                    echo "<option value='" . $operation->id . "'>" . $operation->name . "</option>";
            } else
                echo "<option>Sorry</option>";

        }
    }

    public function actionCreate()
    {
        $model = new Post();

        $filebase = Fileuploads::find()->all();
        $filenames[] = null;
        foreach ($filebase as $file) {
            $filenames[] = $file->name;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	/*checking if choosen category is mandatory for some categories*/
	        $chechMandatory = MainCategories::find()->where(['id'=>$model->main_category])->one();
        	if($chechMandatory->is_mantatory=='true'):
					exit("Sorry, but you haven't filled some mandatory fields");
        	endif;
        	          /*image path*/
            $access_token = (!empty($model->avatar['path'])?$model->avatar['path']:null);
            $model->save(false);
            //var_dump($access_token); die();
            
                $link = $model->fileLink;
                $findfile = Fileuploads::find()->where(['name'=>$link])->exists();
                    //  check if file not exist
                if($link!=="" && !$findfile) {
                    return $this->render('error',compact('link'));
                }
                 else {
                    $fileName = Fileuploads::find()->where(['name'=>$link])->one();
                    $fileName= (!empty($fileName->id)?$fileName->id:null);
                    $model->file = $fileName;
                    $model->save(false);
							/*placing tags*/
            if (isset($model->tag) and !empty($model->tag)) {
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagAssign();
                        $model2->post_id = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagAssign();
                        $model2->post_id = $model->id;
                        $model2->tag_id = $model3->id;
                        $model2->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        } else {
            return $this->render('create', [
                'model' => $model,
                // 'filenames'=>$filenames
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image;
        $file = $model->file;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $link = $model->fileLink;
            $findfile = Fileuploads::find()->where(['name'=>$link])->exists();
                //  check if file not exist
            if($link!=="" && !$findfile) {
                return $this->render('error',compact('link'));
            }
             else {
                 if(empty($model->file)){
                $fileName = Fileuploads::find()->where(['name'=>$link])->one();
                $fileName= (!empty($fileName->id)?$fileName->id:null);
                $model->file = $fileName;
                $model->save(false);
                 }
                 /*update picture*/
          if(empty($model->image) and !empty($model->avatar)) {
            $access_token = $model->avatar['path'];
            $model->image =$access_token;
            $model->save(false);
        }
                    /*update tags*/
            if (isset($model->tag) and !empty($model->tag)) {
                TagAssign::deleteAll(['post_id'=>$model->id]);
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagAssign();
                        $model2->post_id = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagAssign();
                        $model2->post_id = $model->id;
                        $model2->tag_id = $model3->id;
                        $model2->save(false);
                    }
                }
            }else{
                TagAssign::deleteAll(['post_id'=>$model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } 
    } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

	protected function findModelBySlug($slug)
	{
		if (($model = Post::findOne(['slug' => $slug])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException();
		}
	}



    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
