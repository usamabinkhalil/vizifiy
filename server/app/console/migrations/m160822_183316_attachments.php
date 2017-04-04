<?php

use yii\db\Migration;

class m160822_183316_attachments extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attachments}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'model_name' => $this->string()->notNull(),
            'sort_order' => $this->integer()->notNull(),
            'file_name' => $this->string()->notNull(),
            'file_encrypt_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%attachments}}');
    }

}
