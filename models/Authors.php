<?php

namespace app\models;

use Yii; 

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 */
class Authors extends \yii\db\ActiveRecord
{ 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }
 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 100]
        ];
    }


    /**
     * @inheritdoc
     */
    public function getFullName()
    {     
        return  $this->firstname . " " . $this->lastname;  
    }
    

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'fullName' => Yii::t('app', 'Full Name')
        ];
    }
}
