<?php
namespace app\modules\admin\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "main_categories".
 *
 * @property int $id
 * @property string $name
 * @property string $short_desc
 */
class MainCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_categories';
    }
    public $tag;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['short_desc','is_mantatory'],'safe'],
            [['name','slug'], 'string', 'max' => 255],
            [['tag'], 'safe'],
        ];
    }

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'name',
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
            'name' => 'Name',
        ];
    }
	public function getChildCategories()
	{
		return $this->hasMany(ChildCategories::className(), ['parent_category' => 'id']);
	}
}
