<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180307_073001_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'identity_card' => $this->string(),
            'user_name' => $this->string(),
            'password' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'name' => $this->string(),
            'country_code' => $this->string(),
            'phone_no' => $this->string(),
            'email' => $this->string(),
            'date_of_birth' => $this->dateTime(),
            'position' => $this->string(),
            'address' => $this->string(),
            'country' => $this->string(),
            'city' => $this->string(),
            'state' => $this->string(),
            'postcode' => $this->integer(),
            'last_logging_time' => $this->dateTime(),
            'created_at' => $this->timestamp()->defaultValue(null),
            "updated_at" => "timestamp null on update CURRENT_TIMESTAMP",
            'is_deleted' => $this->boolean()->defaultvalue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
