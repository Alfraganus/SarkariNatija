<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\modules\admin\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'main_category', 'child_category', 'file', 'category', 'status', 'user_id'], 'integer'],
            [['title', 'short_desc', 'content', 'image', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'main_category' => $this->main_category,
            'child_category' => $this->child_category,
            'file' => $this->file,
            'date' => $this->date,
            'category' => $this->category,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
