<?php

use yii\db\Migration;

/**
 * Handles the creation of table `addcolstatus`.
 */
class m180320_052833_create_addcolstatus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'status', 'VARCHAR(64) AFTER email');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'status');
    }
}
