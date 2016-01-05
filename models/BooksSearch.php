<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;
use app\models\Authors;



/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $min_date;
    public $max_date;
    public $fullName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['id', 'author_id'], 'integer'],
        [['name', 'date_create', 'date_update', 'preview', 'date'], 'safe'],
        [['min_date', 'max_date'], 'safe'],
        [['fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        

        $query->andFilterWhere([
            'id' => $this->id,
            //'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'date' => $this->date,
            'author_id' => $this->author_id,
            ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        
        

        if ($this->min_date != '01/01/1970' && $this->min_date != '1970-01-01')
            $query->andFilterWhere(['>=', 'date_create', date('Y-m-d', strtotime(str_replace('/', '-', $this->min_date)))]);
        
       //if ($this->max_date != '01/01/1970') $query->andFilterWhere(['<', 'date_create', date('Y-m-d', strtotime(str_replace('/', '-', $this->max_date)))]);  
        if ($this->max_date != '01/01/1970' && $this->max_date != '1970-01-01' && $this->max_date != '01-01-1970'){
            
            if ( date('Y-m-d', strtotime(str_replace('/', '-', $this->max_date))) != '1970-01-01')
               $query->andFilterWhere(['<', 'date_create', date('Y-m-d', strtotime(str_replace('/', '-', $this->max_date)))]);
       }


       return $dataProvider;
   }
}
