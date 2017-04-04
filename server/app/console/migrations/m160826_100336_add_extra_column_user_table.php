<?php

use yii\db\Migration;

class m160826_100336_add_extra_column_user_table extends Migration {

    public function up() {
        $this->addColumn('user', 'lastname', 'VARCHAR(150) AFTER `id` ');
        $this->addColumn('user', 'firstname', 'VARCHAR(150) AFTER `id` ');
        $this->addColumn('user', 'phone', 'VARCHAR(150) AFTER `id` ');
        $this->addColumn('user', 'type', 'VARCHAR(11) AFTER `id` ');
    }

    public function down() {
        $this->dropColumn('user', 'firstname');
        $this->dropColumn('user', 'lastname');
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'type');
    }

}
