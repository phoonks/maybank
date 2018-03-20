<?php

use yii\db\Migration;

/**
 * Handles the creation of table `insertaccount`.
 */
class m180320_085124_create_insertaccount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('account', [
            'user_id' => 1,
            'account_number' => '10001',
            'account_type' => 'Saving Account',
            'available_balance' => 10000000,
            'current_balance' => 10000020,
            'is_deleted' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('account', ['id' => 1]);
    }
}
