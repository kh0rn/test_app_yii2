<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Authors;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>  
    </p>

 <?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
?>
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyCell' => 'Пусто',
        'columns' => [
            'id',
            'name', 
             [
                'label' => 'Превью',
                'format' => 'raw',
                'value' => function($data){ 

                      $this->registerJs("$(function() {
                           $('#popupModalISO".$data->id."').click(function(e) {
                             e.preventDefault();
                             $('#modal').modal('show').find('.modal-content')
                             .load($(this).attr('href')); 
                           });
                           $('#popupModalISO".$data->id."').removeData('modal');
                        });
                    "); 

                    return  Html::a(Html::img("@".$data->preview, [
                        'alt'=>'Нет изображения',
                        'style' => 'width:120px;height:60px;'
                    ]), ['books/view_iso?id='.$data->id], [ 'id' => 'popupModalISO'.$data->id]);  

                     

                },
            ],
          
            // 'preview',
            [
                'attribute'=>'author_id',
                'label'=>'Автор',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getFullName();
                },
                //'filter' => Authors::getFullName()
            ], 
         
                [
                    'attribute' => 'date',           
                     'format' => ['date', 'long']
                ],
                 

                [
                    'attribute' => 'date_create',           
                    'format' => ['date', 'long'],
                    'content'=>function($data){
                        return $data->getToDay();
                    },
                ],
            
    
            //'date_create',
             

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Кнопки действий', 
                'headerOptions' => ['width' => '80'],
                'template' => ' {update} {view} {delete}',
            'buttons' => [
                'update' => function ($url,$model) {

                    //Yii::$app->params['settings'][$val['setting_name']] = Yii::app()->request->url; \
                    Url::remember();     

                    return Html::a(
                    '[ред]', 
                    $url);
                }, 
                  /*'view' => function ($url,$model) {
                    return Html::a(
                    '[просм]', 
                    $url);
             */
                'view' => function ($url,$model) { 
                              $this->registerJs("$(function() {
                                 $('#popupModal".$model->id."').click(function(e) { 
                                 e.preventDefault();
                                 $('#modal').modal('show').find('.modal-content')
                                 .load($(this).attr('href'));
                               });
                            $('a')
                            });"); 

                          return  Html::a('[просм]', ['books/view?id='.$model->id], [ 'id' => 'popupModal'.$model->id]);  
                }, 
                'delete' => function ($url,$model) {
                    return Html::a(
                    '[удл]', 
                    $url);
                }, 
                ],
            ],

        ],
    ]);   

    ?>
 
</div>
