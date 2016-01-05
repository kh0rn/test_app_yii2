<?php

namespace app\models;

use Yii;

use app\models\Authors;
 
use yii\helpers\Html;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 */

class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update', 'preview', 'date', 'author_id'], 'required'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 100] 
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAuthor()
    {
       return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function getFullName()
    {
        $author = $this->author;
     
        return $author ? $author->fullname : '';
    }

    public function getToDay()
    { 
        return $this->today(strtotime($this->date_update));
    }

    public function today($date)
    {
        
        //$apd = CHtml::encode(date("j.m.y H:i", $date));    // полная дата 
   
        $mpd = Html::encode(date("m.y", $date));          // месяц 
        $dpd = Html::encode(date("j", $date));            // день 
        $tpd = Html::encode(date("H:i", $date));          // время 
        $md  = Html::encode(date("m.y"));                 // месяц сегодня
        $dd  = Html::encode(date("j"));                   // день сегодня
 

        $today = false;
        $yesterday = false;
        // Сегодня ?
        if (($mpd == $md) & ($dpd == $dd))
        {
            $today = true;
            $yesterday = false;
            return 'Сегодня';
        }
        // Вчера ?
        if (($mpd == $md) & ($dpd == $dd-1))
        {
            $today = false;
            $yesterday = true;
            return  'Вчера';
        }
        // Не сегодня и не вчера
        if  (($today == false) & ($yesterday == false))
        {
            //return Yii::$app->formatter->format('d.MM.yy HH:mm', date('Y-m-d',$date));
           return date('m-d-Y',$date);
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата обновления',
            'preview' => 'Превью',
            'date' => 'Дата выхода книги', 
            'author_id' => 'Автор', 
            'min_date' => 'Дата выхода книги:', 
            'max_date' => 'до',  
        ];
    }
}
