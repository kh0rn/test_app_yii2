<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

use yii\helpers\ArrayHelper;
use app\models\Authors;


/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
 
<div id="container">
  <div id="row"> 
    <div id="left">
        <p> 
            <?= 
              $form->field($model, 'author_id')->dropDownList(
                ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'))            
          ?>
        </p>
    </div>

    <div id="middle"> 
        <p>&nbsp;&nbsp;&nbsp;</p>
    </div>

    <div id="right"> 
        <p><?= $form->field($model, 'name') ?></p>
    </div>
    </div>
</div>
 
<div id="container">
  <div id="row"> 
    <div id="left">
       <p>
        <?= $form->field($model, 'min_date')->widget(MaskedInput::className(),[
             'name' => 'min_date',
             'clientOptions' => ['alias' =>  'dd/mm/yyyy']
        ]) ?> 
       </p>
    </div>

    <div id="middle"> 
         <p> 
          <?= $form->field($model, 'max_date')->widget(MaskedInput::className(),[ 
             'name' => 'max_date',
             'clientOptions' => ['alias' =>  'dd/mm/yyyy'],
              
        ]) ?> 
        </p> 
    </div> 
    <div id="right">  
     
    </div> 

    </div>
</div>
       <?= Html::submitButton('искать', array('class' => 'submitClass', 'style' => 'width: 120px; border-radius: 10px; float: right;')); ?>
      <?php ActiveForm::end(); ?>

   <!--  <?= $form->field($model, 'date_create') ?>

    <?= $form->field($model, 'date_update') ?>

    <?= $form->field($model, 'preview') ?>
 -->
    <?php // echo $form->field($model, 'date') ?>


 
    <div class="form-group">
       
      <!--   <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> -->
    </div>


</div>
