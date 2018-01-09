<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180108_234203_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(64),
            'last_name' => $this->string(64),
            'email' => $this->string(64),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'created_at' => $this->timestamp(),
            'role' => "ENUM('admin', 'guest') DEFAULT 'guest'",
            'status' => "tinyint(4) DEFAULT NULL",
            'password_hash' => $this->string(255),
            'auth_key' => $this->string(255),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
