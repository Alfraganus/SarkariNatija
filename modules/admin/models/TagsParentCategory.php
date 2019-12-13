<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "tags_parent_category".
 *
 * @property int $id
 * @property int $parent_cat
 * @property int $tag_id
 */
class TagsParentCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags_parent_category';
    }
   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_cat', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_cat' => 'Parent Cat',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
    
}
