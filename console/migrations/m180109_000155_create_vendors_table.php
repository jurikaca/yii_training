<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vendors`.
 */
class m180109_000155_create_vendors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vendors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'logo' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vendors');
    }
}
