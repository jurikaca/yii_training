<?php

use yii\db\Migration;

/**
 * Handles the creation of table `types`.
 */
class m180109_000109_create_types_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('types');
    }
}
