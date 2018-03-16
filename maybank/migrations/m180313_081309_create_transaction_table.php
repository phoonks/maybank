<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180313_081309_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'from_account' => $this->integer(),
            'to_account' => $this->integer(),
            'name' => $this->string(),
            'amount' => $this->double(),
            'last_balance' => $this->double(),
            'status' => $this->string(),
            'details' => $this->string(),
            'remark' => $this->string(),
            'created_at' => $this->timestamp()->defaultValue(null),
            "updated_at" => "timestamp null on update CURRENT_TIMESTAMP",
            'is_deleted' => $this->boolean()->defaultvalue(false),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-transaction-user_id',
            'transaction',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transaction-user_id',
            'transaction',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-transaction-user_id',
            'transaction'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-transaction-user_id',
            'transaction'
        );

        $this->dropTable('transaction');
    }
}
