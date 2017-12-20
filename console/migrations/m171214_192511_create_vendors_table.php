<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vendors`.
 */
class m171214_192511_create_vendors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vendors', [
            'id' => $this->primaryKey(),
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
