<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "tags_child_category".
 *
 * @property int $id
 * @property int $child_category
 * @property int $tag_id
 */
class TagsChildCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags_child_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['child_category', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'child_category' => 'Child Category',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
    
}
