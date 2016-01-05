<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_064444_create_books_table extends Migration
{
    public function up()
    {
    	   $tableOptions = null;
          if ($this->db->driverName === 'mysql') {
              $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_bin ENGINE=InnoDB';
          }
 
          $this->createTable('{{%books}}', [
              'id' => Schema::TYPE_PK,
              'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'date_create' => Schema::TYPE_DATA . ' NOT NULL',
              'date_update' => Schema::TYPE_DATA . ' NOT NULL',
              'preview' => Schema::TYPE_TEXT . ' NOT NULL',
              'date' => Schema::TYPE_DATA . ' NOT NULL',
              'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);
    }

    public function down()
    {
       $this->dropTable('{{%books}}');
    }
}
