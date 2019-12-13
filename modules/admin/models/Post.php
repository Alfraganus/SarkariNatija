<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\Response;
use trntv\filekit\behaviors\UploadBehavior;
use app\modules\admin\models\Fileuploads;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property int $main_category
 * @property int $child_category
 * @property string $image
 * @property string $file
 * @property string $date
 * @property int $category
 * @property int $status
 * @property int $user_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }
    public $tag;
    public $avatar;
    public $fileLink;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_desc', 'content', 'main_category'], 'required'],
            [['short_desc', 'content'], 'string'],
            [['main_category','total_vacancies', 'child_category', 'category', 'status', 'user_id','file'], 'integer'],
            [['date','exam_date','last_date_to_apply','admit_card','eligibility'], 'safe'],
            [['tag','avatar','fileLink','image'], 'safe'],
            [['title','slug','website'], 'string', 'max' => 255],
             

        ];
    }

    public function behaviors() {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'avatar',
                'pathAttribute' => 'image',
                'baseUrlAttribute' => false,
            ],
            [
	            'class' => SluggableBehavior::className(),
	            'attribute' => 'title',
            ],


           
        ];
    }
    

    



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_desc' => 'Short Desc',
            'content' => 'Content',
            'main_category' => 'Main Category',
            'child_category' => 'Child Category',
            'image' => 'Image',
            'avatar' => 'Image',
            'file' => 'File',
            'date' => 'Date',
            'category' => 'Category',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }

    public function actionSend()
    {
        $image = $this->image;

    }

    public function uploadimage()
    {
        if ($this->validate() and $this->image->baseName) {
            $this->image->saveAs(Yii::$app->basePath.'/uploads/'.time().$this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

    public function uploadfile()
    {
        if ($this->validate() and $this->file->baseName) {
            $this->file->saveAs(Yii::$app->basePath.'/uploads/'.time().$this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getMainCat()
    {
        return $this->hasOne(MainCategories::className(), ['id' => 'main_category']);
    }

	public function getUserName()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

    public function getChildCat()
    {
        return $this->hasOne(ChildCategories::className(), ['id' => 'child_category']);
    }

	public function getPostName()
	{
		return $this->hasOne(Fileuploads::className(), ['id' => 'file']);
	}

}
