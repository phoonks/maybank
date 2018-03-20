<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xxx`.
 */
class m180314_050239_create_xxx_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('account', 'account_type', 'VARCHAR(64) AFTER account_number');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'account_type');
    }
}
