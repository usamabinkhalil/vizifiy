<?php

use yii\db\Migration;

class m160824_110039_attachment_colors extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attachment_colors}}', [
            'id' => $this->primaryKey(),
            'attachment_id' => $this->integer()->notNull()->defaultValue(0),
            'color_code' => $this->string()->notNull()->defaultValue(0),
/*            'color_percentage' => $this->string()->notNull()->defaultValue(0),
*/            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%attachment_colors}}');
    }

}
