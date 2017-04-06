<?php

use yii\db\Migration;

class m170406_095205_new_column_migration extends Migration
{
    public function up()
    {
$this->addColumn('attachment_colors', 'color_percentage', $this->string(64));
    }

    public function down()
    {
       
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
