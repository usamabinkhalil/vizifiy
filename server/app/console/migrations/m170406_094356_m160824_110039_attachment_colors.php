<?php

use yii\db\Migration;

class m170406_094356_m160824_110039_attachment_colors extends Migration
{
    public function up()
    {
 $this->addColumn('attachment_colors', 'color_percentage', $this->string(64));
    }

    public function down()
    {
        echo "m170406_094356_m160824_110039_attachment_colors cannot be reverted.\n";

        return false;
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
