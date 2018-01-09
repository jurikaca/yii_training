<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 * Has foreign keys to the tables:
 *
 * - `vendors`
 * - `types`
 */
class m180109_000827_create_items_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('items', [
            'id' => $this->primaryKey(),
            'item_name' => $this->string(64),
            'vendor_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'serial_number' => $this->string(255),
            'price' => $this->decimal(10),
            'wight' => $this->decimal(10),
            'color' => $this->string(64),
            'release_date' => $this->date(),
            'photo' => $this->string(255),
            'tags' => $this->string(255),
            'created_date' => $this->timestamp(),
        ]);

        // creates index for column `vendor_id`
        $this->createIndex(
            'idx-user-vendor_id',
            'items',
            'vendor_id'
        );

        // add foreign key for table `vendors`
        $this->addForeignKey(
            'fk-user-vendor_id',
            'items',
            'vendor_id',
            'vendors',
            'id',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            'idx-user-type_id',
            'items',
            'type_id'
        );

        // add foreign key for table `types`
        $this->addForeignKey(
            'fk-user-type_id',
            'items',
            'type_id',
            'types',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `vendors`
        $this->dropForeignKey(
            'fk-user-vendor_id',
            'items'
        );

        // drops index for column `vendor_id`
        $this->dropIndex(
            'idx-user-vendor_id',
            'items'
        );

        // drops foreign key for table `types`
        $this->dropForeignKey(
            'fk-user-type_id',
            'items'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            'idx-user-type_id',
            'items'
        );

        $this->dropTable('items');
    }
}
