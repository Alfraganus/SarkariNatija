<?php

namespace app\modules\admin\models;

use Yii;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "fileuploads".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 */
class Fileuploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fileuploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'url','path','avatar'], 'safe'],
            [['name'], 'unique'],
        ];
    }

    public $avatar;

    /**
     * {@inheritdoc}
     */

    public function behaviors() {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'avatar',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => false,
            ],
           
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
        ];
    }
}
