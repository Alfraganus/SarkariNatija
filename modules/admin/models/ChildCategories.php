<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "child_categories".
 *
 * @property int $id
 * @property int $parent_category
 * @property string $name
 *
 * @property MainCategories $parentCategory
 */
class ChildCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'child_categories';
    }
    public $tag;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_category', 'name'], 'required'],
            [['parent_category'], 'integer'],
            [['name','slug'], 'string', 'max' => 255],
            [['short_desc'],'safe'],
            [['tag'], 'safe'],
            [['parent_category'], 'exist', 'skipOnError' => true, 'targetClass' => MainCategories::className(), 'targetAttribute' => ['parent_category' => 'id']],
        ];
    }
	public function behaviors() {
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
            'parent_category' => 'Parent Category',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentCategory()
    {
        return $this->hasOne(MainCategories::className(), ['id' => 'parent_category']);
    }
}
