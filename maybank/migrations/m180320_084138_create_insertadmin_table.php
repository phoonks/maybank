<?php

use yii\db\Migration;

/**
 * Handles the creation of table `insertadmin`.
 */
class m180320_084138_create_insertadmin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'identity_card' => '990909-01-5581',
            'user_name' => 'admin',
            'password' => 'PhpqP2RwxkfaI',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'position' => 'Admin',
            'is_deleted' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['id' => 1]);
    }
}
