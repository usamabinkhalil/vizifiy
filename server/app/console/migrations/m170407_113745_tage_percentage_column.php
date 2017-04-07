<?php

use yii\db\Migration;

class m170407_113745_tage_percentage_column extends Migration
{
    public function up()
    {
        $this->addColumn('attachment_tags', 'tag_percentage', $this->string(64));
    }

    public function down()
    {
        echo "m170407_113745_tage_percentage_column cannot be reverted.\n";

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
