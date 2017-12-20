<?php

use yii\db\Migration;

/**
 * Handles the creation of table `types`.
 */
class m171214_192701_create_types_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('types', [
            'id' => $this->primaryKey(),
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
