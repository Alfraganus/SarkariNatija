<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Post;
use Yii;
use app\modules\admin\models\MainCategories;
use app\modules\admin\models\MainCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagsParentCategory;
use yii\filters\VerbFilter;

/**
 * MainCategoryController implements the CRUD actions for MainCategories model.
 */
class MainCategoryController extends Controller
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

    /**
     * Lists all MainCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MainCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MainCategories model.
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

	protected function findModelBySlug($slug)
	{
		if (($model = MainCategories::findOne(['slug' => $slug])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException();
		}
	}

    /**
     * Creates a new MainCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MainCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (isset($model->tag) and !empty($model->tag)) {
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagsParentCategory();
                        $model2->parent_cat = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagsParentCategory();
                        $model2->parent_cat = $model->id;
                        $model2->tag_id = $model3->id;
                        $model2->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing MainCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (isset($model->tag) and !empty($model->tag)) {
                TagsParentCategory::deleteAll(['parent_cat'=>$model->id]);
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagsParentCategory();
                        $model2->parent_cat = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagsParentCategory();
                        $model2->parent_cat = $model->id;
                        $model2->tag_id = $model3->id;
                        $model2->save(false);
                    }
                }
            }else{
                TagAssign::deleteAll(['parent_cat'=>$model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MainCategories model.
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
     * Finds the MainCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MainCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
