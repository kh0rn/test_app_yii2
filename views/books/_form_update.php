<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
use yii\helpers\ArrayHelper;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
 

?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    $model->date_update = date('Y-m-d', time());
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>
    
    <?= $form->field($model, 'preview')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?=
            $form->field($model, 'author_id')->dropDownList(
            ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'))      
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 