<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ChildCategories;
use app\modules\admin\models\ChildCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagsChildCategory;

/**
 * ChildCategoriesController implements the CRUD actions for ChildCategories model.
 */
class ChildCategoriesController extends Controller
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
     * Lists all ChildCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChildCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChildCategories model.
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
     * Creates a new ChildCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

	protected function findModelBySlug($slug)
	{
		if (($model = ChildCategories::findOne(['slug' => $slug])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException();
		}
	}

    public function actionCreate()
    {
        $model = new ChildCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (isset($model->tag) and !empty($model->tag)) {
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagsChildCategory();
                        $model2->child_category = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagsChildCategory();
                        $model2->child_category = $model->id;
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
     * Updates an existing ChildCategories model.
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
                TagsChildCategory::deleteAll(['child_category'=>$model->id]);
                $tags = explode(',',$model->tag);
                foreach ($tags as $tag) {
                    $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                    if($check_tag!==null){
                        $model2 = new TagsChildCategory();
                        $model2->child_category = $model->id;
                        $model2->tag_id = $check_tag->id;
                        $model2->save(false);
                    }else{
                        $model3 = new Tag();
                        $model3->name = $tag;
                        $model3->save(false);

                        $model2 = new TagsChildCategory();
                        $model2->child_category = $model->id;
                        $model2->tag_id = $model3->id;
                        $model2->save(false);
                    }
                }
            }else{
                TagsChildCategory::deleteAll(['child_category'=>$model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ChildCategories model.
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
     * Finds the ChildCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChildCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChildCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
